<?php

namespace App\Http\Livewire\Equipement;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Logiciel as LogicielModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\LogicielsImport;
use App\Exports\LogicielsExport;

class Logiciel extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $editeur = '';
    public $systeme_exploitation = '';
    public $statutFilter = '';
    public $perPage = 20;
    public $sortField = 'nom';
    public $sortDirection = 'asc';
    protected $paginationTheme = 'bootstrap';

    // Variables pour le formulaire
    public $logicielId;
    public $nom;
    public $editeur_form;
    public $version_nom;
    public $version_systeme_exploitation;
    public $nombre_installations = 0;
    public $nombre_licences = 0;
    public $description;
    public $date_achat;
    public $date_expiration;

    // États des modals
    public $showModal = false;
    public $showDetailsModal = false;
    public $showDeleteModal = false;
    public $showImportModal = false;
    public $modalTitle = 'Ajouter un logiciel';
    public $editMode = false;
    public $selectedLogiciel = null;
    public $confirmingDelete = false;
    public $selectedLogicielName = '';
    public $isBulkDelete = false;
    public $showStats = false;
    public $stats = [];
    public $selectedLogiciels = [];
    public $selectAll = false;

    // Import avancé avec mapping
    public $importFile;
    public $importErrors = [];
    public $importSuccessCount = 0;
    public $isImporting = false;
    public $showMappingModal = false;
    public $showImportedData = false;
    public $csvHeaders = [];
    public $csvPreview = [];
    public $fieldMapping = [
        'nom' => '',
        'editeur' => '',
        'version_nom' => '',
        'version_systeme_exploitation' => '',
        'nombre_installations' => '',
        'nombre_licences' => '',
        'date_achat' => '',
        'date_expiration' => '',
        'description' => ''
    ];
    public $importedData = [];


    protected $rules = [
        'nom' => 'required|string|max:150',
        'editeur_form' => 'nullable|string|max:150',
        'version_nom' => 'nullable|string|max:100',
        'version_systeme_exploitation' => 'nullable|string|max:100',
        'nombre_installations' => 'nullable|integer|min:0',
        'nombre_licences' => 'nullable|integer|min:0',
        'description' => 'nullable|string',
        'date_achat' => 'nullable|date',
        'date_expiration' => 'nullable|date|after_or_equal:date_achat',
    ];

    public function mount()
    {
        $this->chargerStatistiques();
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['search', 'editeur', 'systeme_exploitation', 'statutFilter', 'perPage'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        $query = LogicielModel::query();

        if ($this->search) {
            $query->where(function($q) {
                $q->where('nom', 'like', "%{$this->search}%")
                  ->orWhere('editeur', 'like', "%{$this->search}%")
                  ->orWhere('version_nom', 'like', "%{$this->search}%");
            });
        }

        if ($this->editeur) {
            $query->where('editeur', $this->editeur);
        }

        if ($this->systeme_exploitation) {
            $query->where('version_systeme_exploitation', 'like', "%{$this->systeme_exploitation}%");
        }

        $query->orderBy($this->sortField, $this->sortDirection);

        $logiciels = $query->paginate($this->perPage);

        $editeurs = LogicielModel::distinct()->whereNotNull('editeur')->pluck('editeur');
        $systemes = LogicielModel::distinct()->whereNotNull('version_systeme_exploitation')->pluck('version_systeme_exploitation');

        return view('livewire.equipement.logiciel', compact('logiciels', 'editeurs', 'systemes'));
    }

    // ==================== CRUD ====================

    public function create()
    {
        $this->resetForm();
        $this->modalTitle = 'Ajouter un logiciel';
        $this->editMode = false;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $logiciel = LogicielModel::findOrFail($id);

        $this->logicielId = $logiciel->id;
        $this->nom = $logiciel->nom;
        $this->editeur_form = $logiciel->editeur;
        $this->version_nom = $logiciel->version_nom;
        $this->version_systeme_exploitation = $logiciel->version_systeme_exploitation;
        $this->nombre_installations = $logiciel->nombre_installations;
        $this->nombre_licences = $logiciel->nombre_licences;
        $this->description = $logiciel->description;
        $this->date_achat = $logiciel->date_achat?->format('Y-m-d');
        $this->date_expiration = $logiciel->date_expiration?->format('Y-m-d');

        $this->modalTitle = 'Modifier le logiciel';
        $this->editMode = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        try {
            $data = [
                'nom' => $this->nom,
                'editeur' => $this->editeur_form,
                'version_nom' => $this->version_nom,
                'version_systeme_exploitation' => $this->version_systeme_exploitation,
                'nombre_installations' => $this->nombre_installations ?? 0,
                'nombre_licences' => $this->nombre_licences ?? 0,
                'description' => $this->description,
                'date_achat' => $this->date_achat ?: null,
                'date_expiration' => $this->date_expiration ?: null,
            ];

            if ($this->editMode) {
                $logiciel = LogicielModel::findOrFail($this->logicielId);
                $logiciel->update($data);
                session()->flash('message', 'Logiciel mis à jour avec succès.');
            } else {
                LogicielModel::create($data);
                session()->flash('message', 'Logiciel créé avec succès.');
            }

            $this->closeModal();
            $this->chargerStatistiques();
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur: ' . $e->getMessage());
        }
    }

    public function confirmDelete($id)
    {
        $this->logicielId = $id;
        $logiciel = LogicielModel::find($id);
        $this->selectedLogicielName = $logiciel ? $logiciel->nom : '';
        $this->isBulkDelete = false;
        $this->confirmingDelete = true;
    }

    public function deleteConfirmed()
    {
        try {
            if ($this->isBulkDelete) {
                $count = LogicielModel::whereIn('id', $this->selectedLogiciels)->delete();
                $this->selectedLogiciels = [];
                $this->selectAll = false;
                session()->flash('message', "{$count} logiciel(s) supprimé(s) avec succès.");
            } else {
                $logiciel = LogicielModel::findOrFail($this->logicielId);
                $logiciel->delete();
                session()->flash('message', 'Logiciel supprimé avec succès.');
            }
            $this->closeDeleteModal();
            $this->chargerStatistiques();
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }

    public function deleteSelected()
    {
        if (empty($this->selectedLogiciels)) {
            session()->flash('warning', 'Aucun logiciel sélectionné.');
            return;
        }

        $this->isBulkDelete = true;
        $this->confirmingDelete = true;
    }

    public function showDetails($id)
    {
        $this->selectedLogiciel = LogicielModel::find($id);
        $this->showDetailsModal = true;
    }

    // ==================== IMPORT AVEC MAPPING ====================

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
            'isImporting',
            'csvHeaders',
            'csvPreview',
            'importedData',
            'showImportedData'
        ]);
        $this->fieldMapping = [
            'nom' => '',
            'editeur' => '',
            'version_nom' => '',
            'version_systeme_exploitation' => '',
            'nombre_installations' => '',
            'nombre_licences' => '',
            'date_achat' => '',
            'date_expiration' => '',
            'description' => ''
        ];
        $this->resetErrorBag();
    }

    public function storeImportFile()
    {
        $this->validate([
            'importFile' => 'required|file|mimes:csv,txt|max:10240'
        ]);

        try {
            $filePath = $this->importFile->storeAs(
                'imports/logiciels',
                'import_' . time() . '.csv',
                'public'
            );

            $this->readCsvFile(storage_path('app/public/' . $filePath));
            $this->showImportModal = false;
            $this->showMappingModal = true;
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur stockage fichier: ' . $e->getMessage());
        }
    }

    private function readCsvFile($filePath)
    {
        try {
            $handle = fopen($filePath, 'r');
            $this->csvHeaders = fgetcsv($handle);
            
            $this->csvPreview = [];
            $count = 0;
            while (($row = fgetcsv($handle)) !== FALSE && $count < 5) {
                $rowData = [];
                foreach ($this->csvHeaders as $index => $header) {
                    $rowData[$header] = $row[$index] ?? '';
                }
                $this->csvPreview[] = $rowData;
                $count++;
            }
            fclose($handle);
            $this->autoMapFields();
        } catch (\Exception $e) {
            $this->importErrors[] = 'Erreur lecture CSV: ' . $e->getMessage();
        }
    }

    private function autoMapFields()
    {
        $fieldPatterns = [
            'nom' => ['nom', 'name', 'logiciel', 'software'],
            'editeur' => ['editeur', 'editor', 'publisher', 'manufacturer'],
            'version_nom' => ['version', 'release', 'edition'],
            'version_systeme_exploitation' => ['systeme', 'os', 'exploitation', 'compatible'],
            'nombre_installations' => ['installation', 'installe', 'used', 'usage'],
            'nombre_licences' => ['licence', 'license', 'total', 'count'],
            'date_achat' => ['achat', 'purchase', 'bought'],
            'date_expiration' => ['expiration', 'expire', 'warranty', 'fin'],
            'description' => ['description', 'note', 'comment', 'detail']
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

    public function processMappedData()
    {
        try {
            $this->importErrors = [];
            $this->importedData = [];

            $files = Storage::disk('public')->files('imports/logiciels');
            if (empty($files)) throw new \Exception('Fichier non trouvé');

            $latestFile = last($files);
            $filePath = storage_path('app/public/' . $latestFile);

            $handle = fopen($filePath, 'r');
            $headers = fgetcsv($handle);
            $lineNumber = 1;

            while (($row = fgetcsv($handle)) !== FALSE) {
                $lineNumber++;
                $record = array_combine($headers, $row);
                $mappedData = [];

                foreach ($this->fieldMapping as $field => $csvHeader) {
                    $mappedData[$field] = !empty($csvHeader) && isset($record[$csvHeader]) ? trim($record[$csvHeader]) : '';
                }

                if (empty($mappedData['nom'])) {
                    $errorMsg = "Ligne {$lineNumber}: Le champ 'Nom' est obligatoire dans votre mapping.";
                    $this->importErrors[] = $errorMsg;
                    return;
                }

                $this->importedData[] = $this->cleanMappedData($mappedData);
            }
            fclose($handle);

            $this->importSuccessCount = count($this->importedData);
            $this->showMappingModal = false;
            $this->showImportedData = true;
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur traitement: ' . $e->getMessage());
        }
    }

    private function cleanMappedData($data)
    {
        foreach ($data as $key => $value) {
            $data[$key] = trim($value);
            if (in_array($key, ['nombre_installations', 'nombre_licences'])) {
                $data[$key] = is_numeric($value) ? intval($value) : 0;
            }
            if (in_array($key, ['date_achat', 'date_expiration'])) {
                $data[$key] = !empty($value) ? $this->parseDate($value) : null;
            }
        }
        return $data;
    }

    public function saveImportedData()
    {
        try {
            DB::beginTransaction();
            $savedCount = 0;
            $errors = [];

            foreach ($this->importedData as $index => $data) {
                try {
                    $existing = LogicielModel::where('nom', $data['nom'])
                                            ->where('editeur', $data['editeur'])
                                            ->first();
                    if ($existing) continue;

                    LogicielModel::create($data);
                    $savedCount++;
                } catch (\Exception $e) {
                    $errors[] = "Ligne " . ($index + 1) . ": " . $e->getMessage();
                }
            }

            DB::commit();
            $this->cleanImportFiles();
            $this->showImportedData = false;
            $this->chargerStatistiques();

            if ($savedCount > 0) session()->flash('message', "{$savedCount} logiciel(s) importé(s) !");
            if (!empty($errors)) $this->importErrors = $errors;
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Erreur sauvegarde: ' . $e->getMessage());
        }
    }

    private function cleanImportFiles()
    {
        $files = Storage::disk('public')->files('imports/logiciels');
        foreach ($files as $file) Storage::disk('public')->delete($file);
    }

    public function cancelImport()
    {
        $this->cleanImportFiles();
        $this->resetImport();
        $this->showMappingModal = false;
        $this->showImportedData = false;
    }

    // ==================== STATISTIQUES ====================

    public function toggleStats()
    {
        $this->showStats = !$this->showStats;
    }

    public function chargerStatistiques()
    {
        $this->stats = [
            'total' => LogicielModel::count(),
            'licences_critiques' => LogicielModel::where('nombre_installations', '>', DB::raw('nombre_licences'))
                                    ->where('nombre_licences', '>', 0)
                                    ->count(),
            'total_installations' => LogicielModel::sum('nombre_installations'),
            'total_licences' => LogicielModel::sum('nombre_licences'),
            'sans_licences' => LogicielModel::where('nombre_licences', 0)->count(),
            'taux_conformite' => LogicielModel::count() > 0 ? 
                round((LogicielModel::where('nombre_installations', '<=', DB::raw('nombre_licences * 0.8')))
                ->count() / LogicielModel::count() * 100) : 0
        ];
    }

    // ==================== UTILITAIRES ====================

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function closeDeleteModal()
    {
        $this->confirmingDelete = false;
    }

    public function closeDetailsModal()
    {
        $this->showDetailsModal = false;
    }

    public function resetForm()
    {
        $this->reset([
            'logicielId', 'nom', 'editeur_form', 'version_nom', 'version_systeme_exploitation',
            'nombre_installations', 'nombre_licences', 'description', 'date_achat', 'date_expiration'
        ]);
    }

    public function resetFilters()
    {
        $this->reset(['search', 'editeur', 'systeme_exploitation', 'statutFilter']);
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedLogiciels = LogicielModel::pluck('id')->toArray();
        } else {
            $this->selectedLogiciels = [];
        }
    }

    public function downloadTemplate()
    {
        $fileName = 'template_logiciels.csv';

        return response()->streamDownload(function () {
            $file = fopen('php://output', 'w');
            
            // En-têtes simples
            fputcsv($file, [
                'nom', 
                'editeur', 
                'version_nom', 
                'systeme_exploitation',
                'installations', 
                'licences', 
                'date_achat',
                'date_expiration', 
                'description'
            ]);

            // Exemples
            fputcsv($file, [
                'Microsoft Office',
                'Microsoft',
                '2021',
                'Windows 10/11',
                '50',
                '100',
                '2024-01-15',
                '2025-01-15',
                'Suite bureautique Microsoft'
            ]);

            fputcsv($file, [
                'Adobe Photoshop',
                'Adobe',
                '2023',
                'Windows/Mac',
                '25',
                '30',
                '2024-02-01',
                '2025-02-01',
                'Logiciel de retouche photo'
            ]);

            fclose($file);
        }, $fileName);
    }

    /**
     * Exporter les logiciels dans différents formats
     */
    public function export($format)
    {
        $date = date('Y-m-d');
        $fileName = "logiciels_{$date}.{$format}";

        try {
            switch ($format) {
                case 'xlsx':
                    return Excel::download(new LogicielsExport, $fileName, \Maatwebsite\Excel\Excel::XLSX);
                case 'csv':
                    return Excel::download(new LogicielsExport, $fileName, \Maatwebsite\Excel\Excel::CSV);
                case 'pdf':
                    return Excel::download(new LogicielsExport, $fileName, \Maatwebsite\Excel\Excel::DOMPDF);
                default:
                    session()->flash('error', "Format d'exportation non supporté.");
                    return null;
            }
        } catch (\Exception $e) {
            session()->flash('error', "Erreur lors de l'exportation: " . $e->getMessage());
            return null;
        }
    }
}