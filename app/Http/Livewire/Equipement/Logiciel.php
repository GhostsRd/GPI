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

    public $showModal = false;
    public $showDeleteModal = false;
    public $showDetailsModal = false; // Ajout de cette propriété
    public $selectedLogiciel; // Pour stocker le logiciel sélectionné pour les détails
    public $modalTitle = 'Ajouter un Logiciel';
    public $editing = false;


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

    // AJOUT DE LA MÉTHODE MANQUANTE
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

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

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

    public function resetFilters()
    {
        $this->reset(['search', 'editeur', 'systeme_exploitation', 'statutFilter']);
        $this->resetPage();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->showDeleteModal = false;
        $this->showDetailsModal = false;
        $this->resetForm();
    }

    // Méthodes pour l'import
    public function openImportModal()
    {
        $this->showImportModal = true;
    }

    public function closeImportModal()
    {
        $this->showImportModal = false;
        $this->reset(['importFile']);
    }

    public function cancelImport()
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
            'importSuccessCount'
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
            'description' => '',
        ];
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
            
            $this->showImportModal = false;
            $this->showMappingModal = true;
            
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la lecture du fichier: ' . $e->getMessage());
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
                            $mappedData[$field] = $row[$csvHeader];
                        }
                    }
                    
                    if (empty($mappedData['nom'])) {
                        $this->importErrors[] = "Ligne " . ($index + 1) . ": Le nom du logiciel est obligatoire";
                        continue;
                    }
                    
                    if (isset($mappedData['nombre_installations'])) {
                        $mappedData['nombre_installations'] = intval($mappedData['nombre_installations']);
                    }
                    
                    if (isset($mappedData['nombre_licences'])) {
                        $mappedData['nombre_licences'] = intval($mappedData['nombre_licences']);
                    }
                    
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

    public function saveImportedData()
    {
        try {
            $importedCount = 0;
            
            foreach ($this->importedData as $data) {
                try {
                    LogicielModel::create([
                        'nom' => $data['nom'],
                        'editeur' => $data['editeur'] ?? null,
                        'version_nom' => $data['version_nom'] ?? null,
                        'version_systeme_exploitation' => $data['version_systeme_exploitation'] ?? null,
                        'nombre_installations' => $data['nombre_installations'] ?? 0,
                        'nombre_licences' => $data['nombre_licences'] ?? 0,
                        'date_achat' => !empty($data['date_achat']) ? $data['date_achat'] : null,
                        'date_expiration' => !empty($data['date_expiration']) ? $data['date_expiration'] : null,
                        'description' => $data['description'] ?? null,
                    ]);
                    
                    $importedCount++;
                    
                } catch (\Exception $e) {
                    $this->importErrors[] = "Erreur lors de l'import de '{$data['nom']}': " . $e->getMessage();
                }
            }
            
            $this->cancelImport();
            
            if ($importedCount > 0) {
                session()->flash('success', $importedCount . ' logiciel(s) importé(s) avec succès.');
            }
            
            if (count($this->importErrors) > 0) {
                session()->flash('warning', 'Import terminé avec ' . count($this->importErrors) . ' erreur(s).');
            }
            
        } catch (\Exception $e) {
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
                'Nom du logiciel',
                'Éditeur',
                'Version',
                'Système d exploitation',
                'Nombre installations',
                'Nombre licences',
                'Date achat',
                'Date expiration',
                'Description'
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
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // Méthodes utilitaires pour la lecture CSV
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

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedLogiciels = $this->logiciels->pluck('id')->toArray();
        } else {
            $this->selectedLogiciels = [];
        }
    }

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
}
