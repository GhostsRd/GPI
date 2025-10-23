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
    public $statsGlobales = [];
    public $stats = [];
    public $statsParEntite = [];
    public $statsParFabricant = [];
    public $statsParType = [];
    // Ajoutez cette propriété dans votre contrôleur Imprimante.php
    public $showDeleteModal = false;

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

    // Données pour les selects
    public $utilisateurs;
    public $statuts = ['En service', 'En maintenance', 'Hors service', 'En stock'];
    public $types = ['Laser', 'Jet d\'encre', 'Multifonction', 'Réseau', 'USB', 'Matricielle'];
    public $fabricants = [];
    public $entites = [];

    // Sélection multiple et tri
    public $selectedImprimantes = [];
    public $selectAll = false;
    public $sortField = 'id';
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

    // Données importées temporaires
    public $importedData = [];
    public $showImportedData = false;

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

    // ==================== MÉTHODES D'IMPORT MANQUANTES ====================

/**
 * Méthode pour l'import simple (sans mapping)
 */
public function importImprimantes()
{
    try {
        $this->isImporting = true;
        $this->importErrors = [];
        $this->importSuccessCount = 0;

        // Validation du fichier
        $this->validate([
            'importFile' => 'required|file|mimes:xlsx,xls,csv|max:10240'
        ]);

        // Si c'est un fichier CSV, passer directement au mapping
        $extension = $this->importFile->getClientOriginalExtension();
        
        if (in_array($extension, ['csv', 'txt'])) {
            $this->storeImportFile();
        } else {
            // Pour les fichiers Excel, utiliser l'import direct
            Excel::import(new ImprimantesImport, $this->importFile);
            
            $this->showImportModal = false;
            $this->isImporting = false;
            $this->resetImport();
            
            $this->chargerStatistiques();
            $this->chargerFabricants();
            $this->chargerEntites();
            
            session()->flash('message', 'Imprimantes importées avec succès via Excel.');
        }

    } catch (\Exception $e) {
        $this->isImporting = false;
        $this->importErrors[] = 'Erreur lors de l\'import: ' . $e->getMessage();
        session()->flash('error', 'Erreur lors de l\'import: ' . $e->getMessage());
    }
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
 * Fermer la modal de suppression
 */
public function closeDeleteModal()
{
    $this->confirmingDelete = false;
    $this->deleteId = null;
    $this->selectedImprimanteName = '';
}

    // ==================== MÉTHODES DE RECHERCHE ET FILTRES ====================

    /**
     * Obtenir la requête de base pour les imprimantes
     */
    private function getImprimantesQuery()
    {
        $query = ImprimanteModel::with(['utilisateur', 'usager']);

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
                  ->orWhere('reseau_ip', 'LIKE', "%{$this->search}%")
                  ->orWhereHas('utilisateur', function ($q) {
                      $q->where('name', 'LIKE', "%{$this->search}%");
                  })
                  ->orWhereHas('usager', function ($q) {
                      $q->where('name', 'LIKE', "%{$this->search}%");
                  });
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

    // ==================== MÉTHODES D'IMPORT AVEC MAPPING ====================

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
            'importedData',
            'showImportedData'
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
     * Stocker le fichier et préparer le mapping
     */
    public function storeImportFile()
    {
        $this->validate([
            'importFile' => 'required|file|mimes:csv,txt,xlsx,xls|max:10240'
        ]);

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
            $this->importedData = [];

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

            $this->importSuccessCount = count($this->importedData);
            $this->showMappingModal = false;
            $this->showImportedData = true;

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

            // Validation des données requises
            if (empty($mappedData['nom'])) {
                $this->importErrors[] = "Ligne {$lineNumber}: Le nom est obligatoire";
                return;
            }

            // Validation de l'adresse IP
            if (!empty($mappedData['reseau_ip']) && !filter_var($mappedData['reseau_ip'], FILTER_VALIDATE_IP)) {
                $this->importErrors[] = "Ligne {$lineNumber}: Adresse IP invalide - {$mappedData['reseau_ip']}";
                return;
            }

            // Nettoyer et formater les données
            $mappedData = $this->cleanMappedData($mappedData);
            
            $this->importedData[] = $mappedData;

        } catch (\Exception $e) {
            $this->importErrors[] = "Ligne {$lineNumber}: " . $e->getMessage();
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
     * Sauvegarder les données importées dans la base
     */
    public function saveImportedData()
    {
        try {
            DB::beginTransaction();

            $savedCount = 0;
            $errors = [];

            foreach ($this->importedData as $index => $data) {
                try {
                    // Vérifier si l'imprimante existe déjà
                    $existing = ImprimanteModel::where('nom', $data['nom'])->first();
                    if ($existing) {
                        $errors[] = "Ligne " . ($index + 1) . ": L'imprimante '{$data['nom']}' existe déjà";
                        continue;
                    }

                    // Vérifier si le numéro de série existe déjà
                    if (!empty($data['numero_serie'])) {
                        $existingSerial = ImprimanteModel::where('numero_serie', $data['numero_serie'])->first();
                        if ($existingSerial) {
                            $errors[] = "Ligne " . ($index + 1) . ": Le numéro de série '{$data['numero_serie']}' existe déjà";
                            continue;
                        }
                    }

                    // Créer l'imprimante
                    ImprimanteModel::create([
                        'nom' => $data['nom'],
                        'entite' => $data['entite'] ?? null,
                        'statut' => $data['statut'] ?? 'En stock',
                        'fabricant' => $data['fabricant'] ?? null,
                        'numero_serie' => $data['numero_serie'] ?? null,
                        'lieu' => $data['lieu'] ?? null,
                        'type' => $data['type'] ?? null,
                        'modele' => $data['modele'] ?? null,
                        'reseau_ip' => $data['reseau_ip'] ?? null,
                        'commentaires' => $data['commentaires'] ?? null,
                    ]);

                    $savedCount++;

                } catch (\Exception $e) {
                    $errors[] = "Ligne " . ($index + 1) . ": " . $e->getMessage();
                }
            }

            DB::commit();

            // Nettoyer les fichiers temporaires
            $this->cleanImportFiles();

            $this->showImportedData = false;
            $this->chargerStatistiques();
            $this->chargerFabricants();
            $this->chargerEntites();

            if ($savedCount > 0) {
                session()->flash('success', $savedCount . ' imprimante(s) importée(s) avec succès !');
            }

            if (!empty($errors)) {
                session()->flash('warning', 'Import terminé avec ' . count($errors) . ' erreur(s).');
                $this->importErrors = $errors;
            }

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Erreur lors de la sauvegarde: ' . $e->getMessage());
        }
    }

    /**
     * Nettoyer les fichiers d'import temporaires
     */
    private function cleanImportFiles()
    {
        try {
            $files = Storage::disk('public')->files('imports/imprimantes');
            foreach ($files as $file) {
                Storage::disk('public')->delete($file);
            }
        } catch (\Exception $e) {
            // Ignorer les erreurs de nettoyage
        }
    }

    /**
     * Annuler l'import
     */
    public function cancelImport()
    {
        $this->cleanImportFiles();
        $this->resetImport();
        $this->showMappingModal = false;
        $this->showImportedData = false;
    }

    /**
     * Télécharger le template d'import
     */
    public function downloadImportTemplate()
    {
        try {
            $fileName = 'template_import_imprimantes.csv';
            $templateContent = "nom,entite,statut,fabricant,numero_serie,lieu,type,modele,reseau_ip,commentaires\n" .
                             "Imprimante Bureau 1,SI,En service,HP,SN123456,Bureau A1,Laser,LaserJet Pro M404dn,192.168.1.100,Imprimante principale\n" .
                             "Imprimante Bureau 2,Commercial,En stock,Canon,SN123457,Stock,Jet d'encre,PIXMA TS5350,,En attente d'affectation\n" .
                             "Imprimante Salle Reunion,Marketing,En service,Epson,SN123458,Salle Réunion,Multifonction,WorkForce WF-2860,192.168.1.101,Équipe marketing";

            return response()->streamDownload(function () use ($templateContent) {
                echo $templateContent;
            }, $fileName, [
                'Content-Type' => 'text/csv; charset=utf-8',
            ]);
            
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors du téléchargement du template: ' . $e->getMessage());
        }
    }

    /**
     * Exporter les imprimantes en CSV
     */
    public function exportToCsv()
    {
        try {
            $query = $this->getImprimantesQuery();
            $imprimantes = $query->get();

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
     * Enregistrer une nouvelle imprimante
     */
    public function store()
    {
        $validatedData = $this->validate();

        try {
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

            $this->showModal = false;
            $this->resetForm();
            $this->chargerStatistiques();
            $this->chargerFabricants();
            $this->chargerEntites();

            session()->flash('success', 'Imprimante créée avec succès.');

        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la création de l\'imprimante: ' . $e->getMessage());
        }
    }

    /**
     * Mettre à jour une imprimante
     */
    public function update()
    {
        $this->validate([
            'nom' => 'required|string|max:100|unique:imprimantes,nom,' . $this->imprimanteId,
            'entite_form' => 'nullable|string|max:100',
            'statut_form' => 'required|in:En service,En maintenance,Hors service,En stock',
            'fabricant_form' => 'nullable|string|max:100',
            'numero_serie' => 'nullable|string|max:100|unique:imprimantes,numero_serie,' . $this->imprimanteId,
            'utilisateur_id' => 'nullable|exists:users,id',
            'usager_id' => 'nullable|exists:users,id',
            'lieu' => 'nullable|string|max:150',
            'type' => 'nullable|string|max:50',
            'modele' => 'nullable|string|max:100',
            'reseau_ip' => 'nullable|ip',
            'commentaires' => 'nullable|string'
        ]);

        try {
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

            $this->showModal = false;
            $this->resetForm();
            $this->chargerStatistiques();
            $this->chargerFabricants();
            $this->chargerEntites();

            session()->flash('success', 'Imprimante mise à jour avec succès.');

        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la mise à jour de l\'imprimante: ' . $e->getMessage());
        }
    }

    /**
     * Supprimer une imprimante
     */
    public function delete($id)
    {
        try {
            ImprimanteModel::findOrFail($id)->delete();
            $this->chargerStatistiques();
            $this->chargerFabricants();
            $this->chargerEntites();

            session()->flash('success', 'Imprimante supprimée avec succès.');

        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la suppression de l\'imprimante: ' . $e->getMessage());
        }
    }

    /**
     * Confirmer la suppression
     */
    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->confirmingDelete = true;
    }

    /**
     * Suppression confirmée
     */
    public function deleteConfirmed()
    {
        if ($this->deleteId) {
            $this->delete($this->deleteId);
            $this->confirmingDelete = false;
            $this->deleteId = null;
        }
    }

    /**
     * Supprimer les imprimantes sélectionnées
     */
    public function deleteSelected()
    {
        try {
            if (empty($this->selectedImprimantes)) {
                session()->flash('warning', 'Aucune imprimante sélectionnée.');
                return;
            }

            $count = ImprimanteModel::whereIn('id', $this->selectedImprimantes)->delete();
            
            $this->selectedImprimantes = [];
            $this->selectAll = false;
            $this->chargerStatistiques();
            $this->chargerFabricants();
            $this->chargerEntites();

            session()->flash('success', $count . ' imprimante(s) supprimée(s) avec succès.');

        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }

    // ==================== GESTION DES FICHIERS ====================

    /**
     * Ouvrir le modal de gestion des fichiers
     */
    public function openFileModal($imprimanteId)
    {
        $this->selectedImprimanteForFiles = ImprimanteModel::find($imprimanteId);
        $this->loadAttachedFiles();
        $this->showFileModal = true;
    }

    /**
     * Fermer le modal des fichiers
     */
    public function closeFileModal()
    {
        $this->showFileModal = false;
        $this->selectedImprimanteForFiles = null;
        $this->uploadedFiles = [];
        $this->attachedFiles = [];
    }

    /**
     * Charger les fichiers attachés
     */
    private function loadAttachedFiles()
    {
        if ($this->selectedImprimanteForFiles) {
            $folder = "imprimantes/{$this->selectedImprimanteForFiles->id}";
            
            if (Storage::disk('public')->exists($folder)) {
                $files = Storage::disk('public')->allFiles($folder);
                
                $this->attachedFiles = collect($files)->map(function($file) {
                    return [
                        'path' => $file,
                        'name' => basename($file),
                        'url' => Storage::disk('public')->url($file),
                        'size' => $this->formatFileSize(Storage::disk('public')->size($file)),
                        'date' => date('d/m/Y H:i', Storage::disk('public')->lastModified($file)),
                    ];
                })->toArray();
            } else {
                $this->attachedFiles = [];
            }
        }
    }

    /**
     * Uploader des fichiers
     */
    public function uploadFiles()
    {
        $this->validate([
            'uploadedFiles.*' => 'file|max:10240|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx,txt'
        ]);

        if ($this->selectedImprimanteForFiles && count($this->uploadedFiles) > 0) {
            $uploadedCount = 0;
            
            foreach ($this->uploadedFiles as $file) {
                try {
                    // Créer le dossier par date
                    $dateFolder = now()->format('Y-m-d');
                    $filePath = $file->storeAs(
                        "imprimantes/{$this->selectedImprimanteForFiles->id}/{$dateFolder}",
                        $file->getClientOriginalName(),
                        'public'
                    );
                    
                    $uploadedCount++;
                    
                } catch (\Exception $e) {
                    session()->flash('error', 'Erreur lors de l\'upload de ' . $file->getClientOriginalName() . ': ' . $e->getMessage());
                }
            }

            $this->uploadedFiles = [];
            $this->loadAttachedFiles();
            
            session()->flash('success', $uploadedCount . ' fichier(s) uploadé(s) avec succès.');
        }
    }

    /**
     * Télécharger un fichier
     */
    public function downloadFile($filePath)
    {
        try {
            return Storage::disk('public')->download($filePath);
        } catch (\Exception $e) {
            session()->flash('error', 'Fichier non trouvé: ' . $e->getMessage());
        }
    }

    /**
     * Supprimer un fichier
     */
    public function deleteFile($filePath)
    {
        try {
            Storage::disk('public')->delete($filePath);
            $this->loadAttachedFiles();
            
            session()->flash('success', 'Fichier supprimé avec succès.');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }

    /**
     * Formater la taille du fichier
     */
    private function formatFileSize($bytes)
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' bytes';
        }
    }

    // ==================== MÉTHODES POUR LES DÉTAILS ====================

    /**
     * Afficher les détails d'une imprimante
     */
    public function showDetails($id)
    {
        $this->selectedImprimante = ImprimanteModel::with(['utilisateur', 'usager'])->find($id);
        if ($this->selectedImprimante) {
            $this->showDetailsModal = true;
        }
    }

    /**
     * Fermer la modal de détails
     */
    public function closeDetailsModal()
    {
        $this->showDetailsModal = false;
        $this->selectedImprimante = null;
    }

    // ==================== MÉTHODES POUR LES STATISTIQUES ====================

    /**
     * Charger les statistiques
     */
    public function chargerStatistiques()
    {
        try {
            // Statistiques globales par statut
            $this->statsGlobales = ImprimanteModel::select('statut', DB::raw('COUNT(*) as count'))
                ->groupBy('statut')
                ->get()
                ->pluck('count', 'statut')
                ->toArray();

            // Pour compatibilité avec le template
            $this->stats = [
                'total' => ImprimanteModel::count(),
                'en_service' => ImprimanteModel::where('statut', 'En service')->count(),
                'en_maintenance' => ImprimanteModel::where('statut', 'En maintenance')->count(),
                'hors_service' => ImprimanteModel::where('statut', 'Hors service')->count(),
                'en_stock' => ImprimanteModel::where('statut', 'En stock')->count(),
            ];

            // Statistiques par entité
            $this->statsParEntite = ImprimanteModel::select('entite', DB::raw('COUNT(*) as count'))
                ->whereNotNull('entite')
                ->groupBy('entite')
                ->orderBy('count', 'desc')
                ->get()
                ->toArray();

            // Statistiques par fabricant
            $this->statsParFabricant = ImprimanteModel::select('fabricant', DB::raw('COUNT(*) as count'))
                ->whereNotNull('fabricant')
                ->groupBy('fabricant')
                ->orderBy('count', 'desc')
                ->get()
                ->toArray();

            // Statistiques par type
            $this->statsParType = ImprimanteModel::select('type', DB::raw('COUNT(*) as count'))
                ->whereNotNull('type')
                ->groupBy('type')
                ->orderBy('count', 'desc')
                ->get()
                ->toArray();

        } catch (\Throwable $e) {
            // En cas d'erreur, initialise les données à vide
            $this->statsGlobales     = [];
            $this->statsParEntite    = [];
            $this->statsParFabricant = [];
            $this->statsParType      = [];

            $this->stats = [
                'total' => 0,
                'en_service' => 0,
                'en_maintenance' => 0,
                'hors_service' => 0,
                'en_stock' => 0,
            ];
        }
    }

    /**
     * Charger la liste des fabricants
     */
    private function chargerFabricants()
    {
        $this->fabricants = ImprimanteModel::whereNotNull('fabricant')
            ->distinct()
            ->pluck('fabricant')
            ->toArray();
    }

    /**
     * Charger la liste des entités
     */
    private function chargerEntites()
    {
        $this->entites = ImprimanteModel::whereNotNull('entite')
            ->distinct()
            ->pluck('entite')
            ->toArray();
    }

    /**
     * Afficher/Masquer les statistiques
     */
    public function toggleStats()
    {
        $this->showStats = !$this->showStats;
        if ($this->showStats) {
            $this->chargerStatistiques();
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

    // ==================== MÉTHODES DE PAGINATION ====================

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatut()
    {
        $this->resetPage();
    }

    public function updatingEntite()
    {
        $this->resetPage();
    }

    public function updatingFabricant()
    {
        $this->resetPage();
    }

    /**
     * Obtenir l'icône pour un statut
     */
    public function getIconeStatut($statut)
    {
        switch($statut) {
            case 'En service': return 'fa-check-circle';
            case 'En maintenance': return 'fa-tools';
            case 'En stock': return 'fa-warehouse';
            case 'Hors service': return 'fa-times-circle';
            default: return 'fa-print';
        }
    }

    /**
     * Obtenir la couleur du badge pour un statut
     */
    public function getBadgeColor($statut)
    {
        switch($statut) {
            case 'En service': return 'success';
            case 'En maintenance': return 'warning';
            case 'En stock': return 'info';
            case 'Hors service': return 'danger';
            default: return 'secondary';
        }
    }
}