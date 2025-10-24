<?php

namespace App\Http\Livewire\Equipement;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\MaterielReseau as MaterielReseauModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;

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
    public $selectedMateriel = null;

    // Propriétés pour l'import
    public $importFile;
    public $importErrors = [];
    public $importSuccessCount = 0;
    public $importMapping = [];
    public $showMappingModal = false;
    public $csvHeaders = [];
    public $csvData = [];

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
        'deleteConfirmed' => 'deleteMateriel',
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
            'entiteFilter'
        ]);
        $this->resetPage();
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

        $validatedData = $this->validate($rules);

        try {
            if ($this->editMode) {
                $materiel = MaterielReseauModel::findOrFail($this->materielId);
                $materiel->update($validatedData);
                session()->flash('message', 'Matériel réseau modifié avec succès!');
            } else {
                MaterielReseauModel::create($validatedData);
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
        $this->deleteId = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteMateriel()
    {
        if ($this->deleteId) {
            try {
                MaterielReseauModel::findOrFail($this->deleteId)->delete();
                session()->flash('message', 'Matériel réseau supprimé avec succès!');
                $this->deleteId = null;
                $this->emitSelf('refreshComponent');
            } catch (\Exception $e) {
                session()->flash('error', 'Erreur lors de la suppression: ' . $e->getMessage());
            }
        }
    }

    public function deleteSelected()
    {
        if (!empty($this->selectedMateriels)) {
            try {
                MaterielReseauModel::whereIn('id', $this->selectedMateriels)->delete();
                $this->selectedMateriels = [];
                session()->flash('message', 'Matériels réseau sélectionnés supprimés avec succès!');
                $this->emitSelf('refreshComponent');
            } catch (\Exception $e) {
                session()->flash('error', 'Erreur lors de la suppression: ' . $e->getMessage());
            }
        }
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
            'showMappingModal'
        ]);
        $this->initializeImportMapping();
    }

    private function initializeImportMapping()
    {
        $this->importMapping = [
            'nom' => 'Nom',
            'entite' => 'Entité',
            'statut' => 'Statut',
            'fabricant' => 'Fabricant',
            'type' => 'Type',
            'modele' => 'Modèle',
            'numero_serie' => 'Numéro de série',
            'reseau_ip' => 'IP Réseau',
            'lieu' => 'Lieu'
        ];
    }

    public function processImportFile()
    {
        $this->validate([
            'importFile' => 'required|file|mimes:csv,txt,xlsx,xls|max:10240'
        ]);

        try {
            $path = $this->importFile->store('imports');
            $fullPath = Storage::path($path);

            // Lire le fichier CSV
            $file = fopen($fullPath, 'r');
            $this->csvHeaders = fgetcsv($file);
            $this->csvData = [];

            // Lire les premières lignes pour prévisualisation
            $lineCount = 0;
            while (($row = fgetcsv($file)) !== FALSE && $lineCount < 10) {
                $this->csvData[] = $row;
                $lineCount++;
            }
            fclose($file);

            $this->showMappingModal = true;

        } catch (\Exception $e) {
            $this->importErrors[] = 'Erreur lors de la lecture du fichier: ' . $e->getMessage();
        }
    }

    public function importMateriels()
    {
        try {
            $path = $this->importFile->store('imports');
            $fullPath = Storage::path($path);

            $file = fopen($fullPath, 'r');
            $headers = fgetcsv($file);
            
            $importedCount = 0;
            $errorCount = 0;

            while (($row = fgetcsv($file)) !== FALSE) {
                try {
                    $data = [];
                    foreach ($this->importMapping as $field => $header) {
                        $index = array_search($header, $headers);
                        if ($index !== false && isset($row[$index])) {
                            $data[$field] = trim($row[$index]);
                        }
                    }

                    // Validation des données requises
                    if (empty($data['nom']) || empty($data['statut'])) {
                        $errorCount++;
                        continue;
                    }

                    // Vérifier si le numéro de série existe déjà
                    if (!empty($data['numero_serie'])) {
                        $exists = MaterielReseauModel::where('numero_serie', $data['numero_serie'])->exists();
                        if ($exists) {
                            $errorCount++;
                            continue;
                        }
                    }

                    MaterielReseauModel::create($data);
                    $importedCount++;

                } catch (\Exception $e) {
                    $errorCount++;
                }
            }

            fclose($file);

            // Nettoyer le fichier temporaire
            Storage::delete($path);

            $this->importSuccessCount = $importedCount;
            
            if ($importedCount > 0) {
                session()->flash('message', $importedCount . ' matériel(s) réseau importé(s) avec succès!' . ($errorCount > 0 ? ' (' . $errorCount . ' erreurs)' : ''));
            } else {
                session()->flash('error', 'Aucun matériel importé. Vérifiez le format du fichier.');
            }

            $this->closeImportModal();
            $this->emitSelf('refreshComponent');

        } catch (\Exception $e) {
            $this->importErrors[] = 'Erreur lors de l\'importation: ' . $e->getMessage();
        }
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

    public function closeMappingModal()
    {
        $this->showMappingModal = false;
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