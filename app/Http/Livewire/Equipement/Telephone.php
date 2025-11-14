<?php

namespace App\Http\Livewire\Equipement;

use App\Models\Telephone as TelephoneModel;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use League\Csv\Statement;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TelephoneImport;

class Telephone extends Component
{
    use WithPagination, WithFileUploads;

    // Propriétés pour le formulaire
    public $telephoneId;
    public $nom;
    public $entite;
    public $usager;
    public $lieu;
    public $services;
    public $type;
    public $marque;
    public $modele;
    public $numero_serie;
    public $statut = 'En service';
    public $emplacement_actuel;
    public $imei;
    public $selectedTelephones = [];

    // Propriétés pour les filtres et le tri
    public $search = '';
    public $filterStatut = '';
    public $filterType = '';
    public $filterFabricant = '';
    public $perPage = 10;
    public $sortField = 'id';
    public $sortDirection = 'desc';

    // États du composant
    public $showForm = false;
    public $isEditing = false;
    public $showDeleteModal = false;
    public $showModal = false;
    public $confirmingDelete = false;
    public $telephoneToDelete;

    // Propriétés pour l'import
    public $showImportModal = false;
    public $showMappingModal = false;
    public $importFile;
    public $importErrors = [];
    public $importSuccessCount = 0;
    public $importMapping = [];
    public $csvHeaders = [];
    public $csvData = [];
    public $isImporting = false;
    public $showStats = false; // 👈 Définit la variable par défaut

    public function toggleStats()
    {
        $this->showStats = !$this->showStats; // 👈 Inverse la valeur (affiche / masque)
    }

    protected $queryString = [
        'search' => ['except' => ''],
        'filterStatut' => ['except' => ''],
        'filterType' => ['except' => ''],
        'filterFabricant' => ['except' => ''],
    ];

    // Règles de validation
    protected function rules()
    {
        return [
            'nom' => 'required|string|max:100',
            'entite' => 'nullable|string|max:100',
            'usager' => 'nullable|string|max:100',
            'lieu' => 'required|string|max:150',
            'services' => 'nullable|string',
            'type' => 'required|string|in:Téléphone,Tablette',
            'marque' => 'required|string|max:100',
            'modele' => 'required|string|max:100',
            'numero_serie' => [
                'required',
                'string',
                'max:100',
                Rule::unique('telephones_tablettes', 'numero_serie')->ignore($this->telephoneId)
            ],
            'statut' => 'required|in:En service,En stock,Hors service,En réparation',
            'emplacement_actuel' => 'required|string|max:150',
            'imei' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('telephones_tablettes', 'imei')->ignore($this->telephoneId)
            ]
        ];
    }

    public function mount()
    {
        $this->initializeImportMapping();
    }

    // ==================== MÉTHODES DE TRI ET FILTRES ====================

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterStatut()
    {
        $this->resetPage();
    }

    public function updatingFilterType()
    {
        $this->resetPage();
    }

    public function updatingFilterFabricant()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function resetFilters()
    {
        $this->reset([
            'search', 
            'filterStatut', 
            'filterType', 
            'filterFabricant',
            'selectedTelephones'
        ]);
        $this->resetPage();
        session()->flash('success', 'Filtres réinitialisés avec succès.');
    }

    // ==================== MÉTHODES CRUD ====================

    public function create()
    {
        $this->resetForm();
        $this->isEditing = false;
        $this->showForm = true;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $telephone = TelephoneModel::findOrFail($id);

        $this->telephoneId = $telephone->id;
        $this->nom = $telephone->nom;
        $this->entite = $telephone->entite;
        $this->usager = $telephone->usager;
        $this->lieu = $telephone->lieu;
        $this->services = $telephone->services;
        $this->type = $telephone->type;
        $this->marque = $telephone->marque;
        $this->modele = $telephone->modele;
        $this->numero_serie = $telephone->numero_serie;
        $this->statut = $telephone->statut;
        $this->emplacement_actuel = $telephone->emplacement_actuel;
        $this->imei = $telephone->imei;

        $this->isEditing = true;
        $this->showForm = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'nom' => $this->nom,
            'entite' => $this->entite,
            'usager' => $this->usager,
            'lieu' => $this->lieu,
            'services' => $this->services,
            'type' => $this->type,
            'marque' => $this->marque,
            'modele' => $this->modele,
            'numero_serie' => $this->numero_serie,
            'statut' => $this->statut,
            'emplacement_actuel' => $this->emplacement_actuel,
            'imei' => $this->imei,
        ];

        if ($this->isEditing) {
            $telephone = TelephoneModel::find($this->telephoneId);
            $telephone->update($data);
            $message = 'Équipement mis à jour avec succès.';
        } else {
            TelephoneModel::create($data);
            $message = 'Équipement créé avec succès.';
        }

        $this->resetForm();
        $this->showForm = false;
        $this->showModal = false;

        session()->flash('success', $message);
    }

    public function confirmDelete($id)
    {
        $this->telephoneToDelete = $id;
        $this->showDeleteModal = true;
        $this->confirmingDelete = true;
        $this->showModal = true;
    }

    public function delete()
    {
        TelephoneModel::find($this->telephoneToDelete)->delete();

        $this->showDeleteModal = false;
        $this->confirmingDelete = false;
        $this->showModal = false;
        $this->telephoneToDelete = null;

        session()->flash('success', 'Équipement supprimé avec succès.');
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->confirmingDelete = false;
        $this->showModal = false;
        $this->telephoneToDelete = null;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->showForm = false;
        $this->showDeleteModal = false;
        $this->confirmingDelete = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->reset([
            'telephoneId',
            'nom',
            'entite',
            'usager',
            'lieu',
            'services',
            'type',
            'marque',
            'modele',
            'numero_serie',
            'statut',
            'emplacement_actuel',
            'imei'
        ]);
        $this->statut = 'En service';
        $this->resetErrorBag();
    }

    public function closeForm()
    {
        $this->showForm = false;
        $this->showModal = false;
        $this->resetForm();
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
            'usager' => '',
            'lieu' => '',
            'services' => '',
            'type' => '',
            'marque' => '',
            'modele' => '',
            'numero_serie' => '',
            'statut' => '',
            'emplacement_actuel' => '',
            'imei' => ''
        ];
    }

    /**
     * Import des téléphones et tablettes
     */
    public function importTelephones()
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
                Excel::import(new TelephoneImport, $this->importFile);
                
                $this->showImportModal = false;
                $this->isImporting = false;
                $this->resetImport();
                
                session()->flash('success', 'Équipements importés avec succès via Excel.');
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
            $fileName = 'import_telephones_' . time() . '.' . $extension;
            $filePath = $this->importFile->storeAs('imports/telephones', $fileName, 'public');

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
            'nom' => ['nom','name','designation','libelle','equipement','telephone','tablette','identification'],
            'entite' => ['entite','entity','departement','service','department','division'],
            'usager' => ['usager','user','utilisateur','assignation','assigné','personne'],
            'lieu' => ['lieu','location','place','site','batiment','bâtiment'],
            'services' => ['services','plugins','applications','configurations','fonctionnalités'],
            'type' => ['type','typologie','categorie','category'],
            'marque' => ['marque','fabricant','manufacturer','brand','make','constructor'],
            'modele' => ['modele','model','reference','product','produit'],
            'numero_serie' => ['numero_serie','serial','serial_number','sn','no_serie','num_serie'],
            'statut' => ['statut','status','etat','state','situation'],
            'emplacement_actuel' => ['emplacement_actuel','localisation','position','emplacement','current_location'],
            'imei' => ['imei','imei_number','imei_code']
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
            $files = Storage::disk('public')->files('imports/telephones');
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

            session()->flash('success', $this->importSuccessCount . ' équipement(s) importé(s) avec succès.');
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

            if (empty($mappedData['numero_serie'])) {
                $this->importErrors[] = "Ligne {$lineNumber}: Le numéro de série est obligatoire";
                return;
            }

            // Vérifier si le numéro de série existe déjà
            if (TelephoneModel::where('numero_serie', $mappedData['numero_serie'])->exists()) {
                $this->importErrors[] = "Ligne {$lineNumber}: Le numéro de série existe déjà";
                return;
            }

            // Nettoyer et formater les données
            $mappedData = $this->cleanMappedData($mappedData);
            
            // Créer l'équipement
            TelephoneModel::create([
                'nom' => $mappedData['nom'],
                'entite' => $mappedData['entite'] ?? null,
                'usager' => $mappedData['usager'] ?? null,
                'lieu' => $mappedData['lieu'] ?? 'Non spécifié',
                'services' => $mappedData['services'] ?? null,
                'type' => $mappedData['type'] ?? 'Téléphone',
                'marque' => $mappedData['marque'] ?? null,
                'modele' => $mappedData['modele'] ?? null,
                'numero_serie' => $mappedData['numero_serie'],
                'statut' => $mappedData['statut'] ?? 'En stock',
                'emplacement_actuel' => $mappedData['emplacement_actuel'] ?? 'Non spécifié',
                'imei' => $mappedData['imei'] ?? null,
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
                $statutsValides = ['En service', 'En stock', 'Hors service', 'En réparation'];
                if (!in_array($value, $statutsValides)) {
                    $data[$key] = 'En stock'; // Valeur par défaut
                }
            }
            
            // Validation spécifique pour le type
            if ($key === 'type' && !empty($value)) {
                $typesValides = ['Téléphone', 'Tablette'];
                if (!in_array($value, $typesValides)) {
                    $data[$key] = 'Téléphone'; // Valeur par défaut
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
     * Export CSV
     */
    public function exportToCsv()
    {
        $telephones = TelephoneModel::all();

        $fileName = 'telephones-export-' . date('Y-m-d-H-i') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $callback = function() use ($telephones) {
            $file = fopen('php://output', 'w');
            
            // En-têtes CSV
            fputcsv($file, [
                'Nom', 'Entité', 'Usager', 'Lieu', 'Services', 'Type', 
                'Marque', 'Modèle', 'Numéro de série', 'Statut', 
                'Emplacement actuel', 'IMEI', 'Date création'
            ]);

            // Données
            foreach ($telephones as $telephone) {
                fputcsv($file, [
                    $telephone->nom,
                    $telephone->entite ?? '',
                    $telephone->usager ?? '',
                    $telephone->lieu,
                    $telephone->services ?? '',
                    $telephone->type,
                    $telephone->marque,
                    $telephone->modele,
                    $telephone->numero_serie,
                    $telephone->statut,
                    $telephone->emplacement_actuel,
                    $telephone->imei ?? '',
                    $telephone->created_at->format('d/m/Y H:i')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // ==================== MÉTHODES UTILITAIRES ====================

    public function render()
    {
        $query = TelephoneModel::query();

        // Appliquer les filtres
        if ($this->search) {
            $query->where(function($q) {
                $q->where('nom', 'like', '%' . $this->search . '%')
                    ->orWhere('usager', 'like', '%' . $this->search . '%')
                    ->orWhere('numero_serie', 'like', '%' . $this->search . '%')
                    ->orWhere('imei', 'like', '%' . $this->search . '%')
                    ->orWhere('marque', 'like', '%' . $this->search . '%')
                    ->orWhere('modele', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->filterStatut) {
            $query->where('statut', $this->filterStatut);
        }

        if ($this->filterType) {
            $query->where('type', $this->filterType);
        }

        if ($this->filterFabricant) {
            $query->where('marque', $this->filterFabricant);
        }

        // Appliquer le tri
        $query->orderBy($this->sortField, $this->sortDirection);

        $telephones = $query->paginate($this->perPage);

        // Obtenir la liste des fabricants uniques pour le filtre
        $fabricants = TelephoneModel::select('marque')
            ->distinct()
            ->whereNotNull('marque')
            ->where('marque', '!=', '')
            ->orderBy('marque')
            ->pluck('marque');

        // Statistiques
        $stats = [
            'total' => TelephoneModel::count(),
            'enService' => TelephoneModel::where('statut', 'En service')->count(),
            'enStock' => TelephoneModel::where('statut', 'En stock')->count(),
            'horsService' => TelephoneModel::where('statut', 'Hors service')->count(),
            'enReparation' => TelephoneModel::where('statut', 'En réparation')->count(),
        ];

        return view('livewire.equipement.telephone', compact('telephones', 'stats', 'fabricants'));
    }
}