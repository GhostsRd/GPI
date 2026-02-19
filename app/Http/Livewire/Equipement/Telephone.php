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
    public $selectAll = false;

    // Propriétés pour les filtres et le tri
    public $search = '';
    public $filterStatut = '';
    public $filterType = '';
    public $filterFabricant = '';
    public $perPage = 10;
    public $sortField = 'id';
    public $sortDirection = 'desc';

    // États du composant
    public $showModal = false;
    public $showImportModal = false;
    public $showMappingModal = false;
    public $showDetailsModal = false;
    public $showStats = true;

    // Pour gérer le mode (création/édition) et la suppression
    public $isEditing = false;
    public $confirmingDelete = false;
    public $telephoneToDelete = null;
    public $selectedTelephone = null;
    public $isBulkDelete = false;
    public $telephoneName = '';

    // Propriétés pour l'import
    public $importFile;
    public $importErrors = [];
    public $importSuccessCount = 0;
    public $importMapping = [];
    public $csvHeaders = [];
    public $csvData = [];
    public $isImporting = false;

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

        $this->closeModal();
        session()->flash('success', $message);
    }

    public function confirmDelete($id)
    {
        $telephone = TelephoneModel::findOrFail($id);
        $this->telephoneToDelete = $id;
        $this->telephoneName = $telephone->nom;
        $this->isBulkDelete = false;
        $this->confirmingDelete = true;
    }

    public function delete()
    {
        try {
            if ($this->isBulkDelete) {
                $count = TelephoneModel::whereIn('id', $this->selectedTelephones)->delete();
                $this->selectedTelephones = [];
                $this->selectAll = false;
                session()->flash('success', "{$count} équipement(s) supprimé(s) avec succès.");
            } else if ($this->telephoneToDelete) {
                TelephoneModel::find($this->telephoneToDelete)->delete();
                session()->flash('success', 'Équipement supprimé avec succès.');
            }
            
            $this->confirmingDelete = false;
            $this->telephoneToDelete = null;
            $this->telephoneName = '';
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }

    public function cancelDelete()
    {
        $this->confirmingDelete = null;
        $this->telephoneToDelete = null;
    }

    public function confirmBulkDelete()
    {
        if (empty($this->selectedTelephones)) {
            session()->flash('error', 'Aucun équipement sélectionné.');
            return;
        }

        $this->isBulkDelete = true;
        $this->confirmingDelete = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->isEditing = false;
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

    // ==================== MÉTHODES POUR LES DÉTAILS ====================

    public function showDetails($id)
    {
        $this->selectedTelephone = TelephoneModel::find($id);
        if ($this->selectedTelephone) {
            $this->showDetailsModal = true;
        }
    }

    public function closeDetailsModal()
    {
        $this->showDetailsModal = false;
        $this->selectedTelephone = null;
    }

    public function toggleStats()
    {
        $this->showStats = !$this->showStats;
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

   public function importTelephones()
{
    try {
        $this->isImporting = true;
        $this->importErrors = [];
        $this->importSuccessCount = 0;

        $this->validate([
            'importFile' => 'required|file|mimes:csv,txt|max:10240'
        ]);

        // Stocker le fichier
        $filePath = $this->importFile->storeAs(
            'imports/telephones',
            'import_' . time() . '.csv',
            'public'
        );

        // Traiter le fichier directement
        $this->processCSVFile(storage_path('app/public/' . $filePath));
        
        $this->showImportModal = false;
        $this->isImporting = false;

        session()->flash('success', $this->importSuccessCount . ' équipement(s) importé(s) avec succès.');

    } catch (\Exception $e) {
        $this->isImporting = false;
        $this->importErrors[] = 'Erreur lors de l\'import: ' . $e->getMessage();
        session()->flash('error', 'Erreur lors de l\'import: ' . $e->getMessage());
    }
}

private function processCSVFile($filePath)
{
    $file = fopen($filePath, 'r');
    
    // Lire et ignorer les en-têtes
    $headers = fgetcsv($file);
    
    $importedCount = 0;
    $lineNumber = 1;
    $errors = [];

    while (($row = fgetcsv($file)) !== FALSE) {
        $lineNumber++;
        
        try {
            // Format fixe: nom, entite, usager, lieu, services, type, marque, modele, numero_serie, statut, emplacement_actuel, imei
            $data = [
                'nom' => trim($row[0] ?? ''),
                'entite' => isset($row[1]) ? trim($row[1]) : null,
                'usager' => isset($row[2]) ? trim($row[2]) : null,
                'lieu' => isset($row[3]) ? trim($row[3]) : 'Non spécifié',
                'services' => isset($row[4]) ? trim($row[4]) : null,
                'type' => isset($row[5]) ? trim($row[5]) : 'Téléphone',
                'marque' => isset($row[6]) ? trim($row[6]) : null,
                'modele' => isset($row[7]) ? trim($row[7]) : null,
                'numero_serie' => isset($row[8]) ? trim($row[8]) : '',
                'statut' => isset($row[9]) ? trim($row[9]) : 'En stock',
                'emplacement_actuel' => isset($row[10]) ? trim($row[10]) : 'Non spécifié',
                'imei' => isset($row[11]) ? trim($row[11]) : null,
            ];

            // Validation des données requises
            if (empty($data['nom'])) {
                $errors[] = "Ligne $lineNumber: Nom manquant - ignorée";
                continue;
            }

            if (empty($data['numero_serie'])) {
                $errors[] = "Ligne $lineNumber: Numéro de série manquant - ignorée";
                continue;
            }

            // Éviter les doublons
            if (!TelephoneModel::where('numero_serie', $data['numero_serie'])->exists()) {
                TelephoneModel::create($data);
                $importedCount++;
            }

        } catch (\Exception $e) {
            $errors[] = "Ligne $lineNumber: " . $e->getMessage();
        }
    }

    fclose($file);
    
    $this->importSuccessCount = $importedCount;
    $this->importErrors = $errors;
}

public function storeImportFile()
    {
        try {
            $extension = $this->importFile->getClientOriginalExtension();
            $fileName = 'import_telephones_' . time() . '.' . $extension;
            $filePath = $this->importFile->storeAs('imports/telephones', $fileName, 'public');

            $this->readImportFile(storage_path('app/public/' . $filePath), $extension);

            $this->showImportModal = false;
            $this->showMappingModal = true;

        } catch (\Exception $e) {
            $this->importErrors[] = 'Erreur lors du stockage du fichier: ' . $e->getMessage();
            session()->flash('error', 'Erreur lors du stockage du fichier: ' . $e->getMessage());
        }
    }

    private function readImportFile($filePath, $extension)
    {
        try {
            if ($extension === 'csv') {
                $this->readCsvFile($filePath);
            } else {
                $this->readExcelFile($filePath);
            }
            $this->autoMapFields();
        } catch (\Exception $e) {
            $this->importErrors[] = 'Erreur lors de la lecture du fichier: ' . $e->getMessage();
        }
    }

    private function readCsvFile($filePath)
    {
        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setHeaderOffset(0);
        $csv->setDelimiter(',');

        $this->csvHeaders = $csv->getHeader();
        
        $stmt = (new Statement())->limit(5);
        $records = $stmt->process($csv);
        
        $this->csvData = [];
        foreach ($records as $record) {
            $this->csvData[] = $record;
        }
    }

    private function readExcelFile($filePath)
    {
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();
        
        $this->csvHeaders = [];
        $highestColumn = $worksheet->getHighestColumn();
        $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
        
        for ($col = 1; $col <= $highestColumnIndex; ++$col) {
            $value = $worksheet->getCellByColumnAndRow($col, 1)->getValue();
            if ($value) {
                $this->csvHeaders[] = trim($value);
            }
        }
        
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

    public function processMappedData()
    {
        try {
            $this->importErrors = [];
            $this->importSuccessCount = 0;

            $files = Storage::disk('public')->files('imports/telephones');
            if (empty($files)) {
                throw new \Exception('Aucun fichier importé trouvé');
            }

            $latestFile = last($files);
            $filePath = storage_path('app/public/' . $latestFile);
            $extension = pathinfo($latestFile, PATHINFO_EXTENSION);

            if ($extension === 'csv') {
                $this->processCsvFile($filePath);
            } else {
                $this->processExcelFile($filePath);
            }

            $this->showMappingModal = false;
            session()->flash('success', $this->importSuccessCount . ' équipement(s) importé(s) avec succès.');

        } catch (\Exception $e) {
            $this->importErrors[] = 'Erreur lors du traitement des données: ' . $e->getMessage();
            session()->flash('error', 'Erreur lors du traitement des données: ' . $e->getMessage());
        }
    }


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

    private function processDataRow($record, $lineNumber)
    {
        $mappedData = [];

        try {
            foreach ($this->importMapping as $field => $csvHeader) {
                if (!empty($csvHeader) && isset($record[$csvHeader])) {
                    $mappedData[$field] = trim($record[$csvHeader]);
                } else {
                    $mappedData[$field] = '';
                }
            }

            if (empty($mappedData['nom'])) {
                $this->importErrors[] = "Ligne {$lineNumber}: Le nom est obligatoire";
                return;
            }

            if (empty($mappedData['numero_serie'])) {
                $this->importErrors[] = "Ligne {$lineNumber}: Le numéro de série est obligatoire";
                return;
            }

            if (TelephoneModel::where('numero_serie', $mappedData['numero_serie'])->exists()) {
                $this->importErrors[] = "Ligne {$lineNumber}: Le numéro de série existe déjà";
                return;
            }

            $mappedData = $this->cleanMappedData($mappedData);
            
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

    private function cleanMappedData($data)
    {
        foreach ($data as $key => $value) {
            $data[$key] = trim($value);
            
            if ($key === 'statut' && !empty($value)) {
                $statutsValides = ['En service', 'En stock', 'Hors service', 'En réparation'];
                if (!in_array($value, $statutsValides)) {
                    $data[$key] = 'En stock';
                }
            }
            
            if ($key === 'type' && !empty($value)) {
                $typesValides = ['Téléphone', 'Tablette'];
                if (!in_array($value, $typesValides)) {
                    $data[$key] = 'Téléphone';
                }
            }
        }

        return $data;
    }

    public function closeMappingModal()
    {
        $this->showMappingModal = false;
        $this->resetImport();
    }

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
            
            fputcsv($file, [
                'Nom', 'Entité', 'Usager', 'Lieu', 'Services', 'Type', 
                'Marque', 'Modèle', 'Numéro de série', 'Statut', 
                'Emplacement actuel', 'IMEI', 'Date création'
            ]);

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

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedTelephones = $this->getTelephonesQuery()->pluck('id')->toArray();
        } else {
            $this->selectedTelephones = [];
        }
    }

    private function getTelephonesQuery()
    {
        $query = TelephoneModel::query();

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

        return $query;
    }
    // ==================== MÉTHODES MANQUANTES POUR L'IMPORT ====================

/**
 * Télécharger le template d'import
 */
public function downloadTemplate()
{
    $fileName = 'template_import_telephones.csv';

    return response()->streamDownload(function () {
        $file = fopen('php://output', 'w');
        
        // En-têtes du template
        fputcsv($file, [
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

        // Exemples de données
        fputcsv($file, [
            'TEL-IT-001',
            'Direction IT',
            'Jean Dupont',
            'Bureau 101',
            'Email, VPN, Applications métier',
            'Téléphone',
            'Apple',
            'iPhone 14',
            'SN123456789',
            'En service',
            'Bureau 101 - Étage 1',
            '123456789012345'
        ]);

        fputcsv($file, [
            'TAB-ADM-001',
            'Administration',
            'Marie Martin',
            'Bureau 201',
            'Suite bureautique, Lecture PDF',
            'Tablette',
            'Samsung',
            'Galaxy Tab S9',
            'SN987654321',
            'En service',
            'Bureau 201 - Étage 2',
            ''
        ]);

        fclose($file);
    }, $fileName);
}

/**
 * Afficher les données importées (pour preview)
 */
public function showImportedData()
{
    // Cette méthode peut être utilisée pour afficher un aperçu avant import
    if (!empty($this->csvData)) {
        $this->showMappingModal = false;
        // Vous pouvez créer un état pour l'aperçu si nécessaire
    }
}

/**
 * Sauvegarder les données importées
 */
public function saveImportedData()
{
    try {
        DB::beginTransaction();

        $savedCount = 0;
        $errors = [];

        foreach ($this->csvData as $index => $data) {
            try {
                // Appliquer le mapping
                $mappedData = [];
                foreach ($this->importMapping as $field => $csvHeader) {
                    if (!empty($csvHeader) && isset($data[$csvHeader])) {
                        $mappedData[$field] = trim($data[$csvHeader]);
                    } else {
                        $mappedData[$field] = '';
                    }
                }

                // Validation des données requises
                if (empty($mappedData['nom'])) {
                    $errors[] = "Ligne " . ($index + 1) . ": Le nom est obligatoire";
                    continue;
                }

                if (empty($mappedData['numero_serie'])) {
                    $errors[] = "Ligne " . ($index + 1) . ": Le numéro de série est obligatoire";
                    continue;
                }

                // Vérifier les doublons
                if (TelephoneModel::where('numero_serie', $mappedData['numero_serie'])->exists()) {
                    $errors[] = "Ligne " . ($index + 1) . ": Le numéro de série existe déjà";
                    continue;
                }

                // Nettoyer les données
                $mappedData = $this->cleanMappedData($mappedData);

                // Créer l'enregistrement
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

                $savedCount++;

            } catch (\Exception $e) {
                $errors[] = "Ligne " . ($index + 1) . ": " . $e->getMessage();
            }
        }

        DB::commit();

        if ($savedCount > 0) {
            session()->flash('success', $savedCount . ' équipement(s) importé(s) avec succès.');
        }

        if (!empty($errors)) {
            session()->flash('warning', 'Import terminé avec ' . count($errors) . ' erreur(s). ' . $savedCount . ' enregistrement(s) créé(s).');
            $this->importErrors = $errors;
        }

        $this->showMappingModal = false;
        $this->resetImport();

    } catch (\Exception $e) {
        DB::rollBack();
        session()->flash('error', 'Erreur lors de la sauvegarde: ' . $e->getMessage());
    }
}

/**
 * Annuler l'import
 */
public function cancelImport()
{
    $this->showImportModal = false;
    $this->showMappingModal = false;
    $this->resetImport();
}

    public function render()
    {
        $query = $this->getTelephonesQuery();
        $query->orderBy($this->sortField, $this->sortDirection);

        $telephones = $query->paginate($this->perPage);

        $fabricants = TelephoneModel::select('marque')
            ->distinct()
            ->whereNotNull('marque')
            ->where('marque', '!=', '')
            ->orderBy('marque')
            ->pluck('marque');

        $stats = [
            'total' => TelephoneModel::count(),
            'enService' => TelephoneModel::where('statut', 'En service')->count(),
            'enStock' => TelephoneModel::where('statut', 'En stock')->count(),
            'horsService' => TelephoneModel::where('statut', 'Hors service')->count(),
            'enReparation' => TelephoneModel::where('statut', 'En réparation')->count(),
            'telephones' => TelephoneModel::where('type', 'Téléphone')->count(),
            'tablettes' => TelephoneModel::where('type', 'Tablette')->count(),
        ];

        return view('livewire.equipement.telephone', compact('telephones', 'stats', 'fabricants'));
    }
}