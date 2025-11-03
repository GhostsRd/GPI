<?php

namespace App\Http\Livewire\Equipement;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Logiciel as LogicielModel;
use Illuminate\Support\Facades\DB;

class Logiciel extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $editeur = '';
    public $systeme_exploitation = '';
    public $statutFilter = '';
    public $sortField = 'nom';
    public $sortDirection = 'asc';
    public $perPage = 20;

    // Propriétés pour la création/édition
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
       public $showStats = false; // ← ajoute cette ligne

    public $showModal = false;
    public $showDeleteModal = false;
    public $showDetailsModal = false;
    public $showImportModal = false;
    public $showMappingModal = false;
    public $showImportedData = false;
    public $selectedLogiciel;
    public $modalTitle = 'Ajouter un Logiciel';
    public $editing = false;

    // Propriétés pour l'import
    public $importFile;
    public $csvHeaders = [];
    public $csvPreview = [];
    public $fieldMapping = [];
    public $importedData = [];
    public $importErrors = [];
    public $importSuccessCount = 0;

    // Propriétés pour la sélection multiple
    public $selectedLogiciels = [];
    public $selectAll = false;

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

    protected $messages = [
        'nom.required' => 'Le nom du logiciel est obligatoire.',
        'date_expiration.after_or_equal' => 'La date d\'expiration doit être postérieure ou égale à la date d\'achat.',
    ];

    public function mount()
    {
        $this->resetImport();
    }

    /**
     * Réinitialiser complètement l'import
     */
    public function resetImport()
    {
        $this->reset([
            'showImportModal',
            'showMappingModal',
            'showImportedData',
            'importFile',
            'csvHeaders',
            'csvPreview',
            'fieldMapping',
            'importedData',
            'importErrors',
            'importSuccessCount',
        ]);

        // Réinitialiser le mapping des champs
        $this->fieldMapping = [
            'nom' => '',
            'editeur' => '',
            'version_nom' => '',
            'version_systeme_exploitation' => '',
            'nombre_installations' => '',
            'nombre_licences' => '',
            'date_achat' => '',
            'date_expiration' => '',
            'description' => '',
        ];

        $this->resetErrorBag();
    }

    public function render()
    {
        $query = LogicielModel::query();

        // Filtres de recherche
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

        if ($this->statutFilter) {
            if ($this->statutFilter === 'Aucune licence') {
                $query->where('nombre_licences', 0);
            } else {
                $query->where('statut_licences', $this->statutFilter);
            }
        }

        // Tri
        if (in_array($this->sortField, ['nom', 'editeur', 'version_nom', 'nombre_installations', 'nombre_licences', 'statut_licences', 'updated_at'])) {
            $query->orderBy($this->sortField, $this->sortDirection);
        }

        $logiciels = $query->paginate($this->perPage);

        // Statistiques
        $stats = [
            'total' => LogicielModel::count(),
            'licences_critiques' => LogicielModel::licencesCritiques()->count(),
            'total_installations' => LogicielModel::sum('nombre_installations'),
            'total_licences' => LogicielModel::sum('nombre_licences'),
        ];

        $editeurs = LogicielModel::distinct()->whereNotNull('editeur')->pluck('editeur');
        $systemes = LogicielModel::distinct()->whereNotNull('version_systeme_exploitation')->pluck('version_systeme_exploitation');

        return view('livewire.equipement.logiciel', compact('logiciels', 'stats', 'editeurs', 'systemes'));
    }

    // ==================== MÉTHODES POUR LES DÉTAILS ====================

    public function showDetails($id)
    {
        $this->selectedLogiciel = LogicielModel::findOrFail($id);
        $this->showDetailsModal = true;
    }

    public function closeDetailsModal()
    {
        $this->showDetailsModal = false;
        $this->selectedLogiciel = null;
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
        $this->reset(['search', 'editeur', 'systeme_exploitation', 'statutFilter']);
        $this->resetPage();
    }

    // ==================== MÉTHODES CRUD ====================

    public function create()
    {
        $this->resetForm();
        $this->modalTitle = 'Ajouter un Logiciel';
        $this->editing = false;
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

        $this->modalTitle = 'Modifier le Logiciel';
        $this->editing = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

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

        try {
            if ($this->editing) {
                $logiciel = LogicielModel::findOrFail($this->logicielId);
                $logiciel->update($data);
                $message = 'Logiciel mis à jour avec succès.';
            } else {
                LogicielModel::create($data);
                $message = 'Logiciel créé avec succès.';
            }

            $this->showModal = false;
            $this->resetForm();
            session()->flash('success', $message);

        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de l\'enregistrement: ' . $e->getMessage());
        }
    }

    public function confirmDelete($id)
    {
        $this->logicielId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        try {
            $logiciel = LogicielModel::findOrFail($this->logicielId);
            $logiciel->delete();

            $this->showDeleteModal = false;
            session()->flash('success', 'Logiciel supprimé avec succès.');

        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }

    public function deleteSelected()
    {
        try {
            if (empty($this->selectedLogiciels)) {
                session()->flash('warning', 'Aucun logiciel sélectionné.');
                return;
            }

            $count = LogicielModel::whereIn('id', $this->selectedLogiciels)->delete();
            
            $this->selectedLogiciels = [];
            $this->selectAll = false;
            
            session()->flash('success', $count . ' logiciel(s) supprimé(s) avec succès.');

        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }

    public function resetForm()
    {
        $this->reset([
            'logicielId',
            'nom',
            'editeur_form',
            'version_nom',
            'version_systeme_exploitation',
            'nombre_installations',
            'nombre_licences',
            'description',
            'date_achat',
            'date_expiration',
        ]);
        $this->resetErrorBag();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->showDeleteModal = false;
        $this->showDetailsModal = false;
        $this->resetForm();
    }

    // ==================== MÉTHODES POUR L'IMPORT ====================

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

    public function cancelImport()
    {
        $this->resetImport();
    }

    public function storeImportFile()
    {
        $this->validate([
            'importFile' => 'required|file|mimes:csv,txt|max:10240',
        ]);

        try {
            $filePath = $this->importFile->getRealPath();
            
            $this->csvHeaders = $this->getCsvHeaders($filePath);
            $this->csvPreview = $this->getCsvPreview($filePath, 5);
            
            // Mapping automatique
            $this->autoMapFields();
            
            $this->showImportModal = false;
            $this->showMappingModal = true;
            
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la lecture du fichier: ' . $e->getMessage());
        }
    }

    /**
     * Mapping automatique des champs
     */
    private function autoMapFields()
    {
        $fieldPatterns = [
            'nom' => ['nom','name','logiciel','software','application','app','titre','title'],
            'editeur' => ['editeur','editor','publisher','fabricant','manufacturer','company','societe'],
            'version_nom' => ['version_nom','version','version_name','release','build','numero_version'],
            'version_systeme_exploitation' => ['version_systeme_exploitation','systeme_exploitation','os','operating_system','platform','systeme'],
            'nombre_installations' => ['nombre_installations','installations','installs','deployments','count_install','nb_install'],
            'nombre_licences' => ['nombre_licences','licences','licenses','license_count','seats','nb_licences'],
            'date_achat' => ['date_achat','achat','purchase_date','buy_date','acquisition','date_acquisition'],
            'date_expiration' => ['date_expiration','expiration','expiry_date','end_date','valid_until','date_fin'],
            'description' => ['description','desc','notes','commentaires','remarks','note']
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
            $filePath = $this->importFile->getRealPath();
            $data = $this->readCsvData($filePath);
            
            $this->importedData = [];
            $this->importErrors = [];
            $this->importSuccessCount = 0;
            
            foreach ($data as $index => $row) {
                try {
                    $mappedData = [];
                    
                    foreach ($this->fieldMapping as $field => $csvHeader) {
                        if (!empty($csvHeader) && isset($row[$csvHeader])) {
                            $mappedData[$field] = trim($row[$csvHeader]);
                        } else {
                            $mappedData[$field] = '';
                        }
                    }
                    
                    if (empty($mappedData['nom'])) {
                        $this->importErrors[] = "Ligne " . ($index + 1) . ": Le nom du logiciel est obligatoire";
                        continue;
                    }
                    
                    // Nettoyer et formater les données
                    $mappedData = $this->cleanMappedData($mappedData);
                    
                    $this->importedData[] = $mappedData;
                    $this->importSuccessCount++;
                    
                } catch (\Exception $e) {
                    $this->importErrors[] = "Ligne " . ($index + 1) . ": " . $e->getMessage();
                }
            }
            
            $this->showMappingModal = false;
            $this->showImportedData = true;
            
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors du traitement des données: ' . $e->getMessage());
        }
    }

    /**
     * Nettoyer les données mappées
     */
    private function cleanMappedData($data)
    {
        foreach ($data as $key => $value) {
            // Conversion des nombres
            if (in_array($key, ['nombre_installations', 'nombre_licences'])) {
                $data[$key] = is_numeric($value) ? (int)$value : 0;
            }
            
            // Validation des dates
            if (in_array($key, ['date_achat', 'date_expiration']) && !empty($value)) {
                try {
                    $date = \Carbon\Carbon::parse($value);
                    $data[$key] = $date->format('Y-m-d');
                } catch (\Exception $e) {
                    $data[$key] = null;
                }
            }
        }

        return $data;
    }

    public function saveImportedData()
    {
        try {
            DB::beginTransaction();

            $importedCount = 0;
            $errors = [];
            
            foreach ($this->importedData as $index => $data) {
                try {
                    // Vérifier si le logiciel existe déjà
                    $existing = LogicielModel::where('nom', $data['nom'])->first();
                    if ($existing) {
                        $errors[] = "Ligne " . ($index + 1) . ": Le logiciel '{$data['nom']}' existe déjà";
                        continue;
                    }

                    LogicielModel::create([
                        'nom' => $data['nom'],
                        'editeur' => $data['editeur'] ?? null,
                        'version_nom' => $data['version_nom'] ?? null,
                        'version_systeme_exploitation' => $data['version_systeme_exploitation'] ?? null,
                        'nombre_installations' => $data['nombre_installations'] ?? 0,
                        'nombre_licences' => $data['nombre_licences'] ?? 0,
                        'date_achat' => $data['date_achat'] ?? null,
                        'date_expiration' => $data['date_expiration'] ?? null,
                        'description' => $data['description'] ?? null,
                    ]);
                    
                    $importedCount++;
                    
                } catch (\Exception $e) {
                    $errors[] = "Ligne " . ($index + 1) . ": Erreur lors de l'import de '{$data['nom']}': " . $e->getMessage();
                }
            }

            DB::commit();
            
            $this->cancelImport();
            
            if ($importedCount > 0) {
                session()->flash('success', $importedCount . ' logiciel(s) importé(s) avec succès.');
            }
            
            if (!empty($errors)) {
                session()->flash('warning', 'Import terminé avec ' . count($errors) . ' erreur(s).');
                $this->importErrors = $errors;
            }
            
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Erreur lors de l\'importation: ' . $e->getMessage());
        }
    }

    public function downloadImportTemplate()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="template_import_logiciels.csv"',
        ];

        $callback = function() {
            $file = fopen('php://output', 'w');
            
            fputcsv($file, [
                'nom',
                'editeur',
                'version_nom',
                'version_systeme_exploitation',
                'nombre_installations',
                'nombre_licences',
                'date_achat',
                'date_expiration',
                'description'
            ]);
            
            fputcsv($file, [
                'Microsoft Office',
                'Microsoft',
                '2021',
                'Windows',
                '50',
                '100',
                '2023-01-15',
                '2024-01-15',
                'Suite bureautique Microsoft'
            ]);
            
            fputcsv($file, [
                'Adobe Photoshop',
                'Adobe',
                'CC 2023',
                'Windows/macOS',
                '25',
                '30',
                '2023-02-01',
                '2024-02-01',
                'Logiciel de retouche photo'
            ]);
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // ==================== MÉTHODES UTILITAIRES CSV ====================

    private function getCsvHeaders($filePath)
    {
        $file = fopen($filePath, 'r');
        $headers = fgetcsv($file);
        fclose($file);
        
        return $headers ?: [];
    }

    private function getCsvPreview($filePath, $limit = 5)
    {
        $data = [];
        $file = fopen($filePath, 'r');
        $headers = fgetcsv($file);
        
        if (!$headers) {
            fclose($file);
            return [];
        }
        
        $count = 0;
        while (($row = fgetcsv($file)) !== FALSE && $count < $limit) {
            $data[] = array_combine($headers, $row);
            $count++;
        }
        
        fclose($file);
        return $data;
    }

    private function readCsvData($filePath)
    {
        $data = [];
        $file = fopen($filePath, 'r');
        $headers = fgetcsv($file);
        
        if (!$headers) {
            fclose($file);
            return [];
        }
        
        while (($row = fgetcsv($file)) !== FALSE) {
            $data[] = array_combine($headers, $row);
        }
        
        fclose($file);
        return $data;
    }

    // ==================== MÉTHODES POUR LA SÉLECTION MULTIPLE ====================

    public function updatedSelectAll($value)
    {
        if ($value) {
            $query = $this->getLogicielsQuery();
            $this->selectedLogiciels = $query->pluck('id')->toArray();
        } else {
            $this->selectedLogiciels = [];
        }
    }

    /**
     * Obtenir la requête de base pour les logiciels (pour la sélection multiple)
     */
    private function getLogicielsQuery()
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

        if ($this->statutFilter) {
            if ($this->statutFilter === 'Aucune licence') {
                $query->where('nombre_licences', 0);
            } else {
                $query->where('statut_licences', $this->statutFilter);
            }
        }

        return $query;
    }

    // ==================== MÉTHODE D'EXPORT ====================

    public function exportToCsv()
    {
        $logiciels = LogicielModel::all();
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="logiciels_export_' . date('Y-m-d') . '.csv"',
        ];

        $callback = function() use ($logiciels) {
            $file = fopen('php://output', 'w');
            
            fputcsv($file, [
                'Nom',
                'Éditeur',
                'Version',
                'Système d\'exploitation',
                'Installations',
                'Licences',
                'Statut',
                'Date achat',
                'Date expiration',
                'Description'
            ]);
            
            foreach ($logiciels as $logiciel) {
                fputcsv($file, [
                    $logiciel->nom,
                    $logiciel->editeur,
                    $logiciel->version_nom,
                    $logiciel->version_systeme_exploitation,
                    $logiciel->nombre_installations,
                    $logiciel->nombre_licences,
                    $logiciel->statut_licences,
                    $logiciel->date_achat,
                    $logiciel->date_expiration,
                    $logiciel->description
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // ==================== MÉTHODES DE PAGINATION ====================

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingEditeur()
    {
        $this->resetPage();
    }

    public function updatingSystemeExploitation()
    {
        $this->resetPage();
    }

    public function updatingStatutFilter()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }
}