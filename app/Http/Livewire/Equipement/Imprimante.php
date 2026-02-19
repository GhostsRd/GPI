<?php

namespace App\Http\Livewire\Equipement;

use App\Models\Imprimante as ImprimanteModel;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use League\Csv\Reader;
use League\Csv\Statement;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImprimantesImport;

class Imprimante extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    // Propriétés pour la recherche et les filtres
    public $search = '';
    public $statut = '';
    public $entite = '';
    public $fabricant = '';
    
    // Propriétés pour les statistiques
    public $stats = [
        'total' => 0,
        'en_service' => 0,
        'en_maintenance' => 0,
        'hors_service' => 0,
        'en_stock' => 0
    ];

    // Propriétés pour le formulaire
    public $imprimanteId;
    public $nom;
    public $entite_form;
    public $statut_form = 'En service';
    public $fabricant_form;
    public $numero_serie;
    public $utilisateur_id;
    public $usager_id;
    public $lieu;
    public $type;
    public $modele;
    public $reseau_ip;
    public $commentaires;

    // États des modals
    public $isEditing = false;
    public $showModal = false;
    public $showStats = true;
    public $showImportModal = false;
    public $showDetailsModal = false;
    public $showFileModal = false;
    public $showMappingModal = false;
    public $confirmingDelete = false;
    public $deleteId = null; 
    public $selectedImprimanteName = '';
    public $isBulkDelete = false;

    // Données pour les selects
    public $utilisateurs;
    public $statuts = ['En service', 'En maintenance', 'Hors service', 'En stock'];
    public $types = ['Laser', 'Jet d\'encre', 'Multifonction', 'Réseau', 'USB', 'Matricielle'];
    public $fabricants = [];
    public $entites = [];

    // Sélection multiple et tri
    public $selectedImprimantes = [];
    public $selectAll = false;
    public $sortField = 'nom';
    public $sortDirection = 'asc';

    // Propriétés pour l'import avec mapping
    public $importFile;
    public $importErrors = [];
    public $importSuccessCount = 0;
    public $isImporting = false;

    // Propriétés pour le mapping
    public $csvHeaders = [];
    public $csvPreview = [];
    public $fieldMapping = [
        'nom' => '',
        'entite' => '',
        'statut' => '',
        'fabricant' => '',
        'numero_serie' => '',
        'lieu' => '',
        'type' => '',
        'modele' => '',
        'reseau_ip' => '',
        'commentaires' => ''
    ];

    // Propriétés pour les détails
    public $selectedImprimante = null;

    // Propriétés pour les fichiers attachés
    public $uploadedFiles = [];
    public $attachedFiles = [];
    public $selectedImprimanteForFiles = null;

    // Règles de validation
    protected $rules = [
        'nom' => 'required|string|max:100',
        'entite_form' => 'nullable|string|max:100',
        'statut_form' => 'required|in:En service,En maintenance,Hors service,En stock',
        'fabricant_form' => 'nullable|string|max:100',
        'numero_serie' => 'nullable|string|max:100',
        'utilisateur_id' => 'nullable|exists:users,id',
        'usager_id' => 'nullable|exists:users,id',
        'lieu' => 'nullable|string|max:150',
        'type' => 'nullable|string|max:50',
        'modele' => 'nullable|string|max:100',
        'reseau_ip' => 'nullable|ip',
        'commentaires' => 'nullable|string'
    ];

    /**
     * Initialisation du composant
     */
    public function mount()
    {
        $this->utilisateurs = User::orderBy('name')->get();
        $this->chargerStatistiques();
        $this->chargerFabricants();
        $this->chargerEntites();
    }

    /**
     * Rendu du composant
     */
    public function render()
    {
        $query = $this->getImprimantesQuery();
        $query->orderBy($this->sortField, $this->sortDirection);

        $imprimantes = $query->paginate(20);

        $fabricantsList = ImprimanteModel::whereNotNull('fabricant')
            ->distinct()
            ->pluck('fabricant')
            ->toArray();

        $entitesList = ImprimanteModel::whereNotNull('entite')
            ->distinct()
            ->pluck('entite')
            ->toArray();

        return view('livewire.equipement.imprimante', compact('imprimantes', 'fabricantsList', 'entitesList'));
    }

    // ==================== MÉTHODES DE RECHERCHE ET FILTRES ====================

    /**
     * Obtenir la requête de base pour les imprimantes
     */
    private function getImprimantesQuery()
    {
        $query = ImprimanteModel::query();

        // Application des filtres
        if ($this->statut) {
            $query->where('statut', $this->statut);
        }

        if ($this->entite) {
            $query->where('entite', $this->entite);
        }

        if ($this->fabricant) {
            $query->where('fabricant', $this->fabricant);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nom', 'LIKE', "%{$this->search}%")
                  ->orWhere('numero_serie', 'LIKE', "%{$this->search}%")
                  ->orWhere('fabricant', 'LIKE', "%{$this->search}%")
                  ->orWhere('modele', 'LIKE', "%{$this->search}%")
                  ->orWhere('lieu', 'LIKE', "%{$this->search}%")
                  ->orWhere('reseau_ip', 'LIKE', "%{$this->search}%");
            });
        }

        return $query;
    }

    /**
     * Réinitialiser les filtres
     */
    public function resetFilters()
    {
        $this->reset(['search', 'statut', 'entite', 'fabricant', 'selectedImprimantes', 'selectAll']);
        $this->resetPage();
        session()->flash('message', 'Filtres réinitialisés avec succès.');
    }

    /**
     * Trier les résultats
     */
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    /**
     * Sélectionner/désélectionner toutes les imprimantes
     */
    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedImprimantes = $this->getImprimantesQuery()->pluck('id')->toArray();
        } else {
            $this->selectedImprimantes = [];
        }
    }

    // ==================== MÉTHODES CRUD ====================

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        $this->resetForm();
        $this->isEditing = false;
        $this->showModal = true;
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit($id)
    {
        $imprimante = ImprimanteModel::findOrFail($id);

        $this->imprimanteId = $imprimante->id;
        $this->nom = $imprimante->nom;
        $this->entite_form = $imprimante->entite;
        $this->statut_form = $imprimante->statut;
        $this->fabricant_form = $imprimante->fabricant;
        $this->numero_serie = $imprimante->numero_serie;
        $this->utilisateur_id = $imprimante->utilisateur_id;
        $this->usager_id = $imprimante->usager_id;
        $this->lieu = $imprimante->lieu;
        $this->type = $imprimante->type;
        $this->modele = $imprimante->modele;
        $this->reseau_ip = $imprimante->reseau_ip;
        $this->commentaires = $imprimante->commentaires;

        $this->isEditing = true;
        $this->showModal = true;
    }

    /**
     * Enregistrer ou mettre à jour une imprimante
     */
    public function save()
    {
        $this->validate();

        try {
            if ($this->isEditing) {
                // Mise à jour
                $imprimante = ImprimanteModel::findOrFail($this->imprimanteId);
                $imprimante->update([
                    'nom' => $this->nom,
                    'entite' => $this->entite_form,
                    'statut' => $this->statut_form,
                    'fabricant' => $this->fabricant_form,
                    'numero_serie' => $this->numero_serie,
                    'utilisateur_id' => $this->utilisateur_id,
                    'usager_id' => $this->usager_id,
                    'lieu' => $this->lieu,
                    'type' => $this->type,
                    'modele' => $this->modele,
                    'reseau_ip' => $this->reseau_ip,
                    'commentaires' => $this->commentaires,
                ]);
                
                $message = 'Imprimante modifiée avec succès.';
            } else {
                // Création
                ImprimanteModel::create([
                    'nom' => $this->nom,
                    'entite' => $this->entite_form,
                    'statut' => $this->statut_form,
                    'fabricant' => $this->fabricant_form,
                    'numero_serie' => $this->numero_serie,
                    'utilisateur_id' => $this->utilisateur_id,
                    'usager_id' => $this->usager_id,
                    'lieu' => $this->lieu,
                    'type' => $this->type,
                    'modele' => $this->modele,
                    'reseau_ip' => $this->reseau_ip,
                    'commentaires' => $this->commentaires,
                ]);
                
                $message = 'Imprimante créée avec succès.';
            }

            $this->showModal = false;
            $this->resetForm();
            $this->refreshTable();

            session()->flash('message', $message);

        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de l\'enregistrement: ' . $e->getMessage());
        }
    }

    /**
     * Confirmer la suppression
     */
    public function confirmDelete($id)
    {
        $imprimante = ImprimanteModel::findOrFail($id);
        $this->deleteId = $id;
        $this->selectedImprimanteName = $imprimante->nom;
        $this->isBulkDelete = false;
        $this->confirmingDelete = true;
    }

    /**
     * Confirmer la suppression groupée
     */
    public function confirmBulkDelete()
    {
        if (empty($this->selectedImprimantes)) {
            session()->flash('warning', 'Veuillez sélectionner au moins une imprimante.');
            return;
        }

        $this->isBulkDelete = true;
        $this->confirmingDelete = true;
    }

    /**
     * Suppression confirmée
     */
    public function deleteConfirmed()
    {
        try {
            if ($this->isBulkDelete) {
                $count = ImprimanteModel::whereIn('id', $this->selectedImprimantes)->delete();
                $this->selectedImprimantes = [];
                $this->selectAll = false;
                session()->flash('message', $count . ' imprimante(s) supprimée(s) avec succès.');
            } else if ($this->deleteId) {
                ImprimanteModel::findOrFail($this->deleteId)->delete();
                session()->flash('message', 'Imprimante supprimée avec succès.');
            }
            
            $this->confirmingDelete = false;
            $this->deleteId = null;
            $this->selectedImprimanteName = '';
            $this->refreshTable();
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }

    /**
     * Fermer la modal de suppression
     */
    public function closeDeleteModal()
    {
        $this->confirmingDelete = false;
        $this->deleteId = null;
        $this->selectedImprimanteName = '';
    }

    /**
     * Supprimer les imprimantes sélectionnées
     */
    public function deleteSelected()
    {
        $this->confirmBulkDelete();
    }

    // ==================== MÉTHODES IMPORT/EXPORT ====================

    /**
     * Ouvrir la modal d'import
     */
    public function openImportModal()
    {
        $this->showImportModal = true;
        $this->resetImport();
    }

    /**
     * Fermer la modal d'import
     */
    public function closeImportModal()
    {
        $this->showImportModal = false;
        $this->resetImport();
    }

    /**
     * Réinitialiser l'import
     */
    private function resetImport()
    {
        $this->reset([
            'importFile', 
            'importErrors', 
            'importSuccessCount',
            'isImporting',
            'csvHeaders',
            'csvPreview',
        ]);
        $this->fieldMapping = [
            'nom' => '',
            'entite' => '',
            'statut' => '',
            'fabricant' => '',
            'numero_serie' => '',
            'lieu' => '',
            'type' => '',
            'modele' => '',
            'reseau_ip' => '',
            'commentaires' => ''
        ];
        $this->resetErrorBag();
    }

    /**
     * Importer les imprimantes
     */
    public function importImprimantes()
    {
        try {
            $this->isImporting = true;
            $this->importErrors = [];
            $this->importSuccessCount = 0;

            // Validation du fichier
            $this->validate([
                'importFile' => 'required|file|mimes:xlsx,xls,csv,txt|max:10240'
            ]);

            // Vérifier que le fichier est valide
            if (!$this->importFile) {
                throw new \Exception('Aucun fichier sélectionné');
            }

            // Obtenir l'extension du fichier
            $extension = strtolower($this->importFile->getClientOriginalExtension());
            
            if (in_array($extension, ['csv', 'txt'])) {
                // Pour les fichiers CSV, passer par le mapping
                $this->storeImportFile();
            } else {
                // Pour les fichiers Excel, utiliser l'import direct
                Excel::import(new ImprimantesImport, $this->importFile);
                
                $this->showImportModal = false;
                $this->isImporting = false;
                $this->resetImport();
                
                $this->refreshTable();
                
                session()->flash('message', 'Imprimantes importées avec succès via Excel.');
            }

        } catch (\Exception $e) {
            $this->isImporting = false;
            $this->importErrors[] = 'Erreur lors de l\'import: ' . $e->getMessage();
            session()->flash('error', 'Erreur lors de l\'import: ' . $e->getMessage());
        }
    }

    /**
     * Stocker le fichier et préparer le mapping
     */
    public function storeImportFile()
    {
        try {
            // Stocker le fichier
            $extension = $this->importFile->getClientOriginalExtension();
            $fileName = 'import_imprimantes_' . time() . '.' . $extension;
            $filePath = $this->importFile->storeAs('imports/imprimantes', $fileName, 'public');

            // Lire le fichier
            $this->readImportFile(storage_path('app/public/' . $filePath), $extension);

            // Passer à l'étape de mapping
            $this->showImportModal = false;
            $this->showMappingModal = true;

        } catch (\Exception $e) {
            $this->importErrors[] = 'Erreur lors du stockage du fichier: ' . $e->getMessage();
            session()->flash('error', 'Erreur lors du stockage du fichier: ' . $e->getMessage());
        }
    }

    /**
     * Lire le fichier d'import pour extraction des en-têtes et preview
     */
    private function readImportFile($filePath, $extension)
    {
        try {
            if ($extension === 'csv') {
                $this->readCsvFile($filePath);
            } else {
                $this->readExcelFile($filePath);
            }

            // Mapping automatique basé sur la similarité des noms
            $this->autoMapFields();

        } catch (\Exception $e) {
            $this->importErrors[] = 'Erreur lors de la lecture du fichier: ' . $e->getMessage();
        }
    }

    /**
     * Lire le fichier CSV
     */
    private function readCsvFile($filePath)
    {
        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setHeaderOffset(0);
        $csv->setDelimiter(',');

        // Obtenir les en-têtes
        $this->csvHeaders = $csv->getHeader();
        
        // Obtenir un aperçu des données (5 premières lignes)
        $stmt = (new Statement())->limit(5);
        $records = $stmt->process($csv);
        
        $this->csvPreview = [];
        foreach ($records as $record) {
            $this->csvPreview[] = $record;
        }
    }

    /**
     * Lire le fichier Excel
     */
    private function readExcelFile($filePath)
    {
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();
        
        // Obtenir les en-têtes (première ligne)
        $this->csvHeaders = [];
        $highestColumn = $worksheet->getHighestColumn();
        $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
        
        for ($col = 1; $col <= $highestColumnIndex; ++$col) {
            $value = $worksheet->getCellByColumnAndRow($col, 1)->getValue();
            if ($value) {
                $this->csvHeaders[] = trim($value);
            }
        }
        
        // Obtenir un aperçu des données (5 premières lignes)
        $this->csvPreview = [];
        $highestRow = min(6, $worksheet->getHighestRow());
        
        for ($row = 2; $row <= $highestRow; $row++) {
            $rowData = [];
            for ($col = 1; $col <= $highestColumnIndex; ++$col) {
                $value = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                $rowData[] = $value;
            }
            $this->csvPreview[] = array_combine($this->csvHeaders, $rowData);
        }
    }

    /**
     * Mapping automatique des champs
     */
    private function autoMapFields()
    {
        $fieldPatterns = [
            'nom'          => ['nom','name','designation','libelle','imprimante','equipement','it identification'],
            'entite'       => ['entite','entity','departement','service','department','division'],
            'statut'       => ['statut','status','etat','state','situation'],
            'fabricant'    => ['fabricant','manufacturer','marque','brand','make','constructor'],
            'numero_serie' => ['numero_serie','serial','serial_number','sn','no_serie','num_serie'],
            'lieu'         => ['lieu','location','place','emplacement','site','localisation'],
            'type'         => ['type','typologie','technology','technologie'],
            'modele'       => ['modele','model','reference','product','produit'],
            'reseau_ip'    => ['reseau_ip','ip','adresse_ip','ip_address','network_ip'],
            'commentaires' => ['commentaires','comments','notes','remarques','note','observation'],
        ];

        foreach ($this->csvHeaders as $header) {
            $headerLower = strtolower(trim($header));
            
            foreach ($fieldPatterns as $field => $patterns) {
                foreach ($patterns as $pattern) {
                    if (str_contains($headerLower, $pattern) && empty($this->fieldMapping[$field])) {
                        $this->fieldMapping[$field] = $header;
                        break 2;
                    }
                }
            }
        }
    }

    /**
     * Traiter les données avec le mapping
     */
    public function processMappedData()
    {
        try {
            $this->importErrors = [];
            $this->importSuccessCount = 0;

            // Trouver le dernier fichier importé
            $files = Storage::disk('public')->files('imports/imprimantes');
            if (empty($files)) {
                throw new \Exception('Aucun fichier importé trouvé');
            }

            $latestFile = last($files);
            $filePath = storage_path('app/public/' . $latestFile);
            $extension = pathinfo($latestFile, PATHINFO_EXTENSION);

            // Lire et traiter le fichier avec le mapping
            if ($extension === 'csv') {
                $this->processCsvFile($filePath);
            } else {
                $this->processExcelFile($filePath);
            }

            $this->showMappingModal = false;
            $this->showImportModal = false;

            // FORCER le rechargement des données
            $this->refreshTable();
            
            // Afficher le message de succès
            if (empty($this->importErrors)) {
                session()->flash('message', $this->importSuccessCount . ' imprimante(s) importée(s) avec succès.');
            } else {
                session()->flash('warning', $this->importSuccessCount . ' imprimante(s) importée(s), ' . count($this->importErrors) . ' erreur(s).');
            }

        } catch (\Exception $e) {
            $this->importErrors[] = 'Erreur lors du traitement des données: ' . $e->getMessage();
            session()->flash('error', 'Erreur lors du traitement des données: ' . $e->getMessage());
        }
    }

    /**
     * Traiter le fichier CSV
     */
    private function processCsvFile($filePath)
    {
        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setHeaderOffset(0);
        $csv->setDelimiter(',');

        $records = $csv->getRecords();
        $lineNumber = 1;

        foreach ($records as $record) {
            $lineNumber++;
            $this->processDataRow($record, $lineNumber);
        }
    }

    /**
     * Traiter le fichier Excel
     */
    private function processExcelFile($filePath)
    {
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();
        
        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();
        $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

        for ($row = 2; $row <= $highestRow; $row++) {
            $record = [];
            for ($col = 1; $col <= $highestColumnIndex; ++$col) {
                $header = $this->csvHeaders[$col - 1] ?? '';
                $value = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                $record[$header] = $value;
            }
            $this->processDataRow($record, $row);
        }
    }

    /**
     * Traiter une ligne de données
     */
   /**
 * Traiter une ligne de données avec meilleur logging
 */
private function processDataRow($record, $lineNumber)
{
    $mappedData = [];

    try {
        // Appliquer le mapping
        foreach ($this->fieldMapping as $field => $csvHeader) {
            if (!empty($csvHeader) && isset($record[$csvHeader])) {
                $mappedData[$field] = trim($record[$csvHeader]);
            } else {
                $mappedData[$field] = '';
            }
        }

        // Log pour debug
        logger("Ligne {$lineNumber} - Données mappées: " . json_encode($mappedData));

        // Validation des données requises
        if (empty($mappedData['nom'])) {
            $errorMsg = "Ligne {$lineNumber}: Le nom est obligatoire";
            logger($errorMsg);
            $this->importErrors[] = $errorMsg;
            return;
        }

        // Validation de l'adresse IP
        if (!empty($mappedData['reseau_ip']) && !filter_var($mappedData['reseau_ip'], FILTER_VALIDATE_IP)) {
            $errorMsg = "Ligne {$lineNumber}: Adresse IP invalide - '{$mappedData['reseau_ip']}'";
            logger($errorMsg);
            $this->importErrors[] = $errorMsg;
            
            // Optionnel: on peut ignorer l'IP invalide et continuer
            $mappedData['reseau_ip'] = null;
        }

        // Vérifier si l'imprimante existe déjà
        $existing = ImprimanteModel::where('nom', $mappedData['nom'])->first();
        if ($existing) {
            $errorMsg = "Ligne {$lineNumber}: Une imprimante avec le nom '{$mappedData['nom']}' existe déjà";
            logger($errorMsg);
            $this->importErrors[] = $errorMsg;
            return;
        }

        // Nettoyer et formater les données
        $mappedData = $this->cleanMappedData($mappedData);
        
        // Créer l'imprimante
        $imprimante = ImprimanteModel::create([
            'nom' => $mappedData['nom'],
            'entite' => $mappedData['entite'] ?? null,
            'statut' => $mappedData['statut'] ?? 'En stock',
            'fabricant' => $mappedData['fabricant'] ?? null,
            'numero_serie' => $mappedData['numero_serie'] ?? null,
            'lieu' => $mappedData['lieu'] ?? null,
            'type' => $mappedData['type'] ?? null,
            'modele' => $mappedData['modele'] ?? null,
            'reseau_ip' => $mappedData['reseau_ip'] ?? null,
            'commentaires' => $mappedData['commentaires'] ?? null,
        ]);

        logger("Ligne {$lineNumber} SUCCÈS: Imprimante '{$mappedData['nom']}' créée avec ID: {$imprimante->id}");
        $this->importSuccessCount++;

    } catch (\Exception $e) {
        $errorMsg = "Ligne {$lineNumber}: " . $e->getMessage();
        logger($errorMsg);
        $this->importErrors[] = $errorMsg;
    }
}

    /**
     * Nettoyer les données mappées
     */
    private function cleanMappedData($data)
    {
        // Nettoyer chaque champ
        foreach ($data as $key => $value) {
            $data[$key] = trim($value);
            
            // Validation spécifique pour le statut
            if ($key === 'statut' && !empty($value)) {
                $statutsValides = ['En service', 'En maintenance', 'Hors service', 'En stock'];
                if (!in_array($value, $statutsValides)) {
                    $data[$key] = 'En stock'; // Valeur par défaut
                }
            }
        }

        return $data;
    }

    /**
     * Fermer le modal de mapping
     */
    public function closeMappingModal()
    {
        $this->showMappingModal = false;
        $this->resetImport();
    }

    /**
     * Exporter les imprimantes en CSV
     */
    public function exportToCsv()
    {
        try {
            $imprimantes = ImprimanteModel::all();

            $fileName = 'imprimantes_export_' . date('Y-m-d_H-i-s') . '.csv';

            return response()->streamDownload(function () use ($imprimantes) {
                $file = fopen('php://output', 'w');

                // En-têtes
                fputcsv($file, [
                    'Nom', 'Entité', 'Statut', 'Fabricant', 'Modèle', 
                    'Numéro de série', 'Adresse IP', 'Lieu', 'Type', 'Commentaires'
                ]);

                // Données
                foreach ($imprimantes as $imprimante) {
                    fputcsv($file, [
                        $imprimante->nom,
                        $imprimante->entite ?? 'N/A',
                        $imprimante->statut,
                        $imprimante->fabricant ?? 'N/A',
                        $imprimante->modele ?? 'N/A',
                        $imprimante->numero_serie ?? 'N/A',
                        $imprimante->reseau_ip ?? 'N/A',
                        $imprimante->lieu ?? 'N/A',
                        $imprimante->type ?? 'N/A',
                        $imprimante->commentaires ?? '',
                    ]);
                }

                fclose($file);
            }, $fileName);

        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de l\'export: ' . $e->getMessage());
        }
    }

    // ==================== MÉTHODES UTILITAIRES ====================

    /**
     * Réinitialiser le formulaire
     */
    private function resetForm()
    {
        $this->reset([
            'imprimanteId', 'nom', 'entite_form', 'statut_form', 'fabricant_form',
            'numero_serie', 'utilisateur_id', 'usager_id', 'lieu', 'type',
            'modele', 'reseau_ip', 'commentaires'
        ]);
        $this->resetErrorBag();
    }

    /**
     * Fermer le modal
     */
    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    /**
     * Afficher les détails
     */
    public function showDetails($id)
    {
        $this->selectedImprimante = ImprimanteModel::find($id);
        $this->showDetailsModal = true;
    }

    /**
     * Fermer les détails
     */
    public function closeDetailsModal()
    {
        $this->showDetailsModal = false;
        $this->selectedImprimante = null;
    }

    /**
     * Basculer l'affichage des filtres
     */
    public function toggleFilters()
    {
        // Implémentation pour basculer l'affichage des filtres sur mobile
    }

    /**
     * Rafraîchir le tableau et les statistiques
     */
    public function refreshTable()
    {
        $this->resetPage();
        $this->chargerStatistiques();
        $this->chargerFabricants();
        $this->chargerEntites();
    }

    // ==================== MÉTHODES POUR LES STATISTIQUES ====================

    /**
     * Charger les statistiques
     */
    public function chargerStatistiques()
    {
        $this->stats['total'] = ImprimanteModel::count();
        $this->stats['en_service'] = ImprimanteModel::where('statut', 'En service')->count();
        $this->stats['en_maintenance'] = ImprimanteModel::where('statut', 'En maintenance')->count();
        $this->stats['hors_service'] = ImprimanteModel::where('statut', 'Hors service')->count();
        $this->stats['en_stock'] = ImprimanteModel::where('statut', 'En stock')->count();
    }

    /**
     * Charger les fabricants
     */
    private function chargerFabricants()
    {
        $this->fabricants = ImprimanteModel::whereNotNull('fabricant')
            ->distinct()
            ->pluck('fabricant')
            ->toArray();
    }

    /**
     * Charger les entités
     */
    private function chargerEntites()
    {
        $this->entites = ImprimanteModel::whereNotNull('entite')
            ->distinct()
            ->pluck('entite')
            ->toArray();
    }

    /**
     * Basculer l'affichage des statistiques
     */
    public function toggleStats()
    {
        $this->showStats = !$this->showStats;
        if ($this->showStats) {
            $this->chargerStatistiques();
        }
    }

    // ==================== MÉTHODES DE PAGINATION ====================

    /**
     * Mise à jour de la recherche
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Mise à jour du statut
     */
    public function updatingStatut()
    {
        $this->resetPage();
    }

    /**
     * Mise à jour de l'entité
     */
    public function updatingEntite()
    {
        $this->resetPage();
    }

    /**
     * Mise à jour du fabricant
     */
    public function updatingFabricant()
    {
        $this->resetPage();
    }
}