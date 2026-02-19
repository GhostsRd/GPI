<?php

namespace App\Http\Livewire\Equipement;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\MaterielReseau as MaterielReseauModel;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use League\Csv\Statement;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MaterielReseauImport;

class MaterielReseau extends Component
{
    use WithPagination, WithFileUploads;

    // Propriétés de recherche et filtrage
    public $search = '';
    public $statutFilter = '';
    public $typeFilter = '';
    public $fabricantFilter = '';
    public $entiteFilter = '';
    public $sortField = 'updated_at';
    public $sortDirection = 'desc';

    // Propriétés pour le formulaire
    public $showForm = false;
    public $editMode = false;
    public $materielId;

    public $nom;
    public $entite;
    public $statut = 'En service';
    public $fabricant;
    public $lieu;
    public $reseau_ip;
    public $type;
    public $modele;
    public $numero_serie;

    // Propriétés pour la sélection multiple
    public $selectedMateriels = [];
    public $selectAll = false;

    // Propriétés pour les modals
    public $showDeleteModal = false;
    public $showImportModal = false;
    public $showDetailsModal = false;
    public $deleteId;
    public $isBulkDelete = false;
    public $selectedMaterielName = '';
    public $selectedMateriel = null;

    // Propriétés pour l'import
    public $importFile;
    public $importErrors = [];
    public $importSuccessCount = 0;
    public $importMapping = [];
    public $showMappingModal = false;
    public $csvHeaders = [];
    public $csvData = [];
    public $isImporting = false;

    // Options pour les selects
    public $statutOptions = [
        'En service',
        'En stock',
        'Hors service',
        'En maintenance'
    ];

    public $typeOptions = [
        'Switch',
        'Routeur',
        'Point d\'accès',
        'Pare-feu',
        'Modem',
        'Contrôleur',
        'Serveur',
        'Câble réseau',
        'Onduleur',
        'Autre'
    ];

    public $fabricantOptions = [
        'Cisco',
        'HP',
        'Dell',
        'MikroTik',
        'Ubiquiti',
        'Huawei',
        'Juniper',
        'Netgear',
        'TP-Link',
        'D-Link',
        'Autre'
    ];

    public $entiteOptions = [
        'Informatique',
        'Administration',
        'Comptabilité',
        'Commercial',
        'Technique',
        'Ressources Humaines',
        'Marketing',
        'Direction',
        'Production'
    ];

    protected $queryString = [
        'search' => ['except' => ''],
        'statutFilter' => ['except' => ''],
        'typeFilter' => ['except' => ''],
        'fabricantFilter' => ['except' => ''],
        'entiteFilter' => ['except' => ''],
    ];

    protected $listeners = [
        'refreshComponent' => '$refresh'
    ];

    // Règles de validation
    protected $rules = [
        'nom' => 'required|string|max:100',
        'entite' => 'nullable|string|max:100',
        'statut' => 'required|in:En service,En stock,Hors service,En maintenance',
        'fabricant' => 'nullable|string|max:100',
        'lieu' => 'nullable|string|max:150',
        'reseau_ip' => 'nullable|ipv4',
        'type' => 'nullable|string|max:100',
        'modele' => 'nullable|string|max:100',
        'numero_serie' => 'nullable|string|max:100',
    ];

    public function mount()
    {
        $this->initializeImportMapping();
    }

    public function render()
    {
        $query = MaterielReseauModel::query();

        // Appliquer les filtres
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nom', 'like', '%' . $this->search . '%')
                  ->orWhere('entite', 'like', '%' . $this->search . '%')
                  ->orWhere('fabricant', 'like', '%' . $this->search . '%')
                  ->orWhere('type', 'like', '%' . $this->search . '%')
                  ->orWhere('modele', 'like', '%' . $this->search . '%')
                  ->orWhere('numero_serie', 'like', '%' . $this->search . '%')
                  ->orWhere('reseau_ip', 'like', '%' . $this->search . '%')
                  ->orWhere('lieu', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->statutFilter) {
            $query->where('statut', $this->statutFilter);
        }

        if ($this->typeFilter) {
            $query->where('type', $this->typeFilter);
        }

        if ($this->fabricantFilter) {
            $query->where('fabricant', $this->fabricantFilter);
        }

        if ($this->entiteFilter) {
            $query->where('entite', $this->entiteFilter);
        }

        $materiels = $query->orderBy($this->sortField, $this->sortDirection)
                           ->paginate(15);

        // Charger les options dynamiques pour les filtres
        $dynamicFabricants = MaterielReseauModel::whereNotNull('fabricant')
            ->distinct()
            ->pluck('fabricant')
            ->toArray();

        $dynamicEntites = MaterielReseauModel::whereNotNull('entite')
            ->distinct()
            ->pluck('entite')
            ->toArray();

        $dynamicTypes = MaterielReseauModel::whereNotNull('type')
            ->distinct()
            ->pluck('type')
            ->toArray();

        // Statistiques
        $stats = [
            'total' => MaterielReseauModel::count(),
            'en_service' => MaterielReseauModel::where('statut', 'En service')->count(),
            'en_maintenance' => MaterielReseauModel::where('statut', 'En maintenance')->count(),
            'hors_service' => MaterielReseauModel::where('statut', 'Hors service')->count(),
            'en_stock' => MaterielReseauModel::where('statut', 'En stock')->count(),
        ];

        return view('livewire.equipement.materiel-reseau', [
            'materiels' => $materiels,
            'stats' => $stats,
            'dynamicFabricants' => $dynamicFabricants,
            'dynamicEntites' => $dynamicEntites,
            'dynamicTypes' => $dynamicTypes,
        ]);
    }

    // ==================== MÉTHODES DE TRI ET FILTRES ====================

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function resetFilters()
    {
        $this->reset([
            'search', 
            'statutFilter', 
            'typeFilter', 
            'fabricantFilter', 
            'entiteFilter',
            'selectedMateriels',
            'selectAll'
        ]);
        $this->resetPage();
        session()->flash('message', 'Filtres réinitialisés avec succès.');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatutFilter()
    {
        $this->resetPage();
    }

    public function updatingTypeFilter()
    {
        $this->resetPage();
    }

    public function updatingFabricantFilter()
    {
        $this->resetPage();
    }

    public function updatingEntiteFilter()
    {
        $this->resetPage();
    }

    // ==================== MÉTHODES CRUD ====================

    public function showCreateForm()
    {
        $this->resetForm();
        $this->showForm = true;
        $this->editMode = false;
    }

    public function showEditForm($id)
    {
        $materiel = MaterielReseauModel::findOrFail($id);

        $this->materielId = $materiel->id;
        $this->nom = $materiel->nom;
        $this->entite = $materiel->entite;
        $this->statut = $materiel->statut;
        $this->fabricant = $materiel->fabricant;
        $this->lieu = $materiel->lieu;
        $this->reseau_ip = $materiel->reseau_ip;
        $this->type = $materiel->type;
        $this->modele = $materiel->modele;
        $this->numero_serie = $materiel->numero_serie;

        $this->showForm = true;
        $this->editMode = true;
    }

    public function saveMateriel()
    {
        // Validation spécifique pour le numéro de série
        $rules = $this->rules;
        if ($this->editMode) {
            $rules['numero_serie'] .= '|unique:materiels_reseau,numero_serie,' . $this->materielId;
        } else {
            $rules['numero_serie'] .= '|unique:materiels_reseau,numero_serie';
        }

        $this->validate($rules);

        try {
            if ($this->editMode) {
                $materiel = MaterielReseauModel::findOrFail($this->materielId);
                $materiel->update([
                    'nom' => $this->nom,
                    'entite' => $this->entite,
                    'statut' => $this->statut,
                    'fabricant' => $this->fabricant,
                    'lieu' => $this->lieu,
                    'reseau_ip' => $this->reseau_ip,
                    'type' => $this->type,
                    'modele' => $this->modele,
                    'numero_serie' => $this->numero_serie,
                ]);
                session()->flash('message', 'Matériel réseau modifié avec succès!');
            } else {
                MaterielReseauModel::create([
                    'nom' => $this->nom,
                    'entite' => $this->entite,
                    'statut' => $this->statut,
                    'fabricant' => $this->fabricant,
                    'lieu' => $this->lieu,
                    'reseau_ip' => $this->reseau_ip,
                    'type' => $this->type,
                    'modele' => $this->modele,
                    'numero_serie' => $this->numero_serie,
                ]);
                session()->flash('message', 'Matériel réseau créé avec succès!');
            }

            $this->resetForm();
            $this->showForm = false;
            $this->emitSelf('refreshComponent');

        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de l\'enregistrement: ' . $e->getMessage());
        }
    }

    public function showDetails($id)
    {
        $this->selectedMateriel = MaterielReseauModel::find($id);
        $this->showDetailsModal = true;
    }

    public function closeDetailsModal()
    {
        $this->showDetailsModal = false;
        $this->selectedMateriel = null;
    }

    public function confirmDelete($id)
    {
        $materiel = MaterielReseauModel::find($id);
        if ($materiel) {
            $this->deleteId = $id;
            $this->selectedMaterielName = $materiel->nom;
            $this->isBulkDelete = false;
            $this->showDeleteModal = true;
        }
    }

    public function deleteConfirmed()
    {
        try {
            if ($this->isBulkDelete) {
                $count = MaterielReseauModel::whereIn('id', $this->selectedMateriels)->delete();
                $this->selectedMateriels = [];
                $this->selectAll = false;
                session()->flash('message', "{$count} matériel(s) réseau supprimé(s) avec succès !");
            } else if ($this->deleteId) {
                MaterielReseauModel::findOrFail($this->deleteId)->delete();
                session()->flash('message', 'Matériel réseau supprimé avec succès !');
            }
            
            $this->showDeleteModal = false;
            $this->deleteId = null;
            $this->selectedMaterielName = '';
            $this->emitSelf('refreshComponent');
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }

    public function confirmBulkDelete()
    {
        if (empty($this->selectedMateriels)) {
            session()->flash('warning', 'Aucun matériel sélectionné.');
            return;
        }

        $this->isBulkDelete = true;
        $this->showDeleteModal = true;
    }

    public function deleteSelected()
    {
        $this->confirmBulkDelete();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedMateriels = MaterielReseauModel::pluck('id')->toArray();
        } else {
            $this->selectedMateriels = [];
        }
    }

    public function resetForm()
    {
        $this->reset([
            'materielId',
            'nom',
            'entite',
            'statut',
            'fabricant',
            'lieu',
            'reseau_ip',
            'type',
            'modele',
            'numero_serie',
            'editMode'
        ]);
        $this->resetErrorBag();
        $this->statut = 'En service';
    }

    public function cancelForm()
    {
        $this->resetForm();
        $this->showForm = false;
    }

    // ==================== MÉTHODES IMPORT/EXPORT ====================

    public function openImportModal()
    {
        $this->showImportModal = true;
        $this->resetImport();
    }

    public function closeImportModal()
    {
        $this->showImportModal = false;
        $this->resetImport();
    }

    private function resetImport()
    {
        $this->reset([
            'importFile', 
            'importErrors', 
            'importSuccessCount',
            'csvHeaders',
            'csvData',
            'showMappingModal',
            'isImporting'
        ]);
        $this->initializeImportMapping();
    }

    private function initializeImportMapping()
    {
        $this->importMapping = [
            'nom' => '',
            'entite' => '',
            'statut' => '',
            'fabricant' => '',
            'type' => '',
            'modele' => '',
            'numero_serie' => '',
            'reseau_ip' => '',
            'lieu' => ''
        ];
    }

    /**
     * Import des matériels réseau
     */
    public function importMateriels()
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
                Excel::import(new MaterielReseauImport, $this->importFile);
                
                $this->showImportModal = false;
                $this->isImporting = false;
                $this->resetImport();
                
                session()->flash('message', 'Matériels réseau importés avec succès via Excel.');
                $this->emitSelf('refreshComponent');
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
            $fileName = 'import_materiel_reseau_' . time() . '.' . $extension;
            $filePath = $this->importFile->storeAs('imports/materiel-reseau', $fileName, 'public');

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
        
        $this->csvData = [];
        foreach ($records as $record) {
            $this->csvData[] = $record;
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
        $this->csvData = [];
        $highestRow = min(6, $worksheet->getHighestRow());
        
        for ($row = 2; $row <= $highestRow; $row++) {
            $rowData = [];
            for ($col = 1; $col <= $highestColumnIndex; ++$col) {
                $value = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                $rowData[] = $value;
            }
            $this->csvData[] = array_combine($this->csvHeaders, $rowData);
        }
    }

    /**
     * Mapping automatique des champs
     */
    private function autoMapFields()
    {
        $fieldPatterns = [
            'nom'          => ['nom','name','designation','libelle','materiel','equipement','it identification'],
            'entite'       => ['entite','entity','departement','service','department','division'],
            'statut'       => ['statut','status','etat','state','situation'],
            'fabricant'    => ['fabricant','manufacturer','marque','brand','make','constructor'],
            'type'         => ['type','typologie','technology','technologie'],
            'modele'       => ['modele','model','reference','product','produit'],
            'numero_serie' => ['numero_serie','serial','serial_number','sn','no_serie','num_serie'],
            'reseau_ip'    => ['reseau_ip','ip','adresse_ip','ip_address','network_ip'],
            'lieu'         => ['lieu','location','place','emplacement','site','localisation'],
        ];

        foreach ($this->csvHeaders as $header) {
            $headerLower = strtolower(trim($header));
            
            foreach ($fieldPatterns as $field => $patterns) {
                foreach ($patterns as $pattern) {
                    if (str_contains($headerLower, $pattern) && empty($this->importMapping[$field])) {
                        $this->importMapping[$field] = $header;
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
            $files = Storage::disk('public')->files('imports/materiel-reseau');
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

            session()->flash('message', $this->importSuccessCount . ' matériel(s) réseau importé(s) avec succès.');
            $this->emitSelf('refreshComponent');

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
            foreach ($this->importMapping as $field => $csvHeader) {
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
            
            // Créer le matériel réseau
            MaterielReseauModel::create([
                'nom' => $mappedData['nom'],
                'entite' => $mappedData['entite'] ?? null,
                'statut' => $mappedData['statut'] ?? 'En stock',
                'fabricant' => $mappedData['fabricant'] ?? null,
                'type' => $mappedData['type'] ?? null,
                'modele' => $mappedData['modele'] ?? null,
                'numero_serie' => $mappedData['numero_serie'] ?? null,
                'reseau_ip' => $mappedData['reseau_ip'] ?? null,
                'lieu' => $mappedData['lieu'] ?? null,
            ]);

            $this->importSuccessCount++;

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
     * Fermer le modal de mapping
     */
    public function closeMappingModal()
    {
        $this->showMappingModal = false;
        $this->resetImport();
    }

    public function exportToCsv()
    {
        $materiels = MaterielReseauModel::all();

        $fileName = 'materiels-reseau-export-' . date('Y-m-d-H-i') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $callback = function() use ($materiels) {
            $file = fopen('php://output', 'w');
            
            // En-têtes CSV
            fputcsv($file, [
                'Nom', 'Entité', 'Statut', 'Fabricant', 'Type', 
                'Modèle', 'Numéro de série', 'IP Réseau', 'Lieu', 'Date création'
            ]);

            // Données
            foreach ($materiels as $materiel) {
                fputcsv($file, [
                    $materiel->nom,
                    $materiel->entite ?? '',
                    $materiel->statut,
                    $materiel->fabricant ?? '',
                    $materiel->type ?? '',
                    $materiel->modele ?? '',
                    $materiel->numero_serie ?? '',
                    $materiel->reseau_ip ?? '',
                    $materiel->lieu ?? '',
                    $materiel->created_at->format('d/m/Y H:i')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // ==================== MÉTHODES UTILITAIRES ====================

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->deleteId = null;
    }

    public function getStatutColor($statut)
    {
        $colors = [
            'En service' => 'success',
            'En maintenance' => 'warning',
            'Hors service' => 'danger',
            'En stock' => 'info'
        ];

        return $colors[$statut] ?? 'secondary';
    }
}