<?php

namespace App\Http\Livewire\Equipement;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\MaterielReseau as MaterielReseauModel;
use Illuminate\Support\Facades\Validator;

class MaterielReseau extends Component
{
    use WithPagination;

    public $search = '';
    public $statutFilter = '';
    public $typeFilter = '';
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
    public $selectedMateriels = [];
    public $showDeleteModal = false;
 // pour stocker l'ID du matériel à supprimer
 // initialise comme tableau vide
    public function create()
    {
        $this->validate([
            'nom' => 'required|string|max:255',
            'entite' => 'required|string|max:255',
            'statut' => 'required|string|max:255',
            'fabricant' => 'required|string|max:255',
            'lieu' => 'required|string|max:255',
            'reseau_ip' => 'nullable|ip',
            'type' => 'required|string|max:255',
            'modele' => 'required|string|max:255',
            'numero_serie' => 'required|string|max:255',
        ]);

        MaterielReseau::create([
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

        session()->flash('message', 'Matériel réseau ajouté avec succès !');
        $this->reset();
    }


    protected $queryString = [
        'search' => ['except' => ''],
        'statutFilter' => ['except' => ''],
        'typeFilter' => ['except' => ''],
    ];

    protected $listeners = ['deleteConfirmed' => 'deleteMateriel'];

    public $deleteId;

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
        'Câble',
        'Autre'
    ];

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
              ->orWhere('reseau_ip', 'like', '%' . $this->search . '%');
        });
    }

    if ($this->statutFilter) {
        $query->where('statut', $this->statutFilter);
    }

    if ($this->typeFilter) {
        $query->where('type', $this->typeFilter);
    }

    $materiels = $query->orderBy($this->sortField, $this->sortDirection)
                       ->paginate(15);

    // Statistiques
    $stats = [
        'total' => MaterielReseauModel::count(),
        'en_service' => MaterielReseauModel::where('statut', 'En service')->count(),
        'en_maintenance' => MaterielReseauModel::where('statut', 'En maintenance')->count(),
        'hors_service' => MaterielReseauModel::where('statut', 'Hors service')->count(),
    ];

    // 🧩 Définir les options pour la vue
    $fabricantOptions = ['Cisco', 'HP', 'Dell', 'MikroTik', 'Ubiquiti', 'Huawei', 'Autre'];
    $entiteOptions = ['Informatique', 'Administration', 'Comptabilité', 'Commercial', 'Technique'];
    $statuts = $this->statutOptions ?? [];

    return view('livewire.equipement.materiel-reseau', [
        'materiels' => $materiels,
        'stats' => $stats,
        'fabricantOptions' => $fabricantOptions,
        'entiteOptions' => $entiteOptions,
        'statuts' => $statuts,
    ]);
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

    public function showCreateForm()
    {
        $this->resetForm();
        $this->showForm = true;
        $this->editMode = false;
    }

    public function showEditForm($id)
    {
        $materiel = MaterielReseau::findOrFail($id);

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
        $rules = [
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

        if ($this->editMode) {
            $rules['numero_serie'] .= '|unique:materiels_reseau,numero_serie,' . $this->materielId;
        } else {
            $rules['numero_serie'] .= '|unique:materiels_reseau,numero_serie';
        }

        $validatedData = $this->validate($rules);

        if ($this->editMode) {
            $materiel = MaterielReseau::findOrFail($this->materielId);
            $materiel->update($validatedData);
            $this->dispatchBrowserEvent('notify', ['message' => 'Matériel modifié avec succès!', 'type' => 'success']);
        } else {
            MaterielReseau::create($validatedData);
            $this->dispatchBrowserEvent('notify', ['message' => 'Matériel créé avec succès!', 'type' => 'success']);
        }

        $this->resetForm();
        $this->showForm = false;
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteMateriel()
    {
        if ($this->deleteId) {
            MaterielReseau::findOrFail($this->deleteId)->delete();
            $this->dispatchBrowserEvent('notify', ['message' => 'Matériel supprimé avec succès!', 'type' => 'success']);
            $this->deleteId = null;
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

    // Méthode pour exporter les données
    public function exportToCsv()
    {
        $materiels = MaterielReseau::all();

        $fileName = 'materiels-reseau-' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $callback = function() use ($materiels) {
            $file = fopen('php://output', 'w');

            // En-têtes CSV
            fputcsv($file, [
                'Nom', 'Entité', 'Statut', 'Fabricant', 'Lieu',
                'IP Réseau', 'Type', 'Modèle', 'Numéro de série', 'Dernière modification'
            ]);

            // Données
            foreach ($materiels as $materiel) {
                fputcsv($file, [
                    $materiel->nom,
                    $materiel->entite,
                    $materiel->statut,
                    $materiel->fabricant,
                    $materiel->lieu,
                    $materiel->reseau_ip,
                    $materiel->type,
                    $materiel->modele,
                    $materiel->numero_serie,
                    $materiel->updated_at->format('d/m/Y H:i')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
