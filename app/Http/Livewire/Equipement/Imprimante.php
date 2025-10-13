<?php

namespace App\Http\Livewire\Equipement;

use App\Models\Imprimante as ImprimanteModel;
use Livewire\Component;
use Livewire\WithPagination;

class Imprimante extends Component
{
    use WithPagination;

    public $nom;
    public $entite;
    public $statut;
    public $fabricant;
    public $reseau_ip;
    public $numero_serie;
    public $lieu;
    public $type;
    public $modele;

    public $selectedId;
    public $isEditing = false;
    public $showModal = false;

    // Filtres
    public $search = '';
    public $filterStatut = '';
    public $filterFabricant = '';
    public $filterEntite = '';

    // Tri
    public $sortField = 'updated_at';
    public $sortDirection = 'desc';

    protected $rules = [
        'nom' => 'required|string|max:100',
        'entite' => 'nullable|string|max:100',
        'statut' => 'required|in:En service,En stock,Hors service,En maintenance',
        'fabricant' => 'nullable|string|max:100',
        'reseau_ip' => 'nullable|ipv4',
        'numero_serie' => 'nullable|string|max:100|unique:imprimantes,numero_serie',
        'lieu' => 'nullable|string|max:150',
        'type' => 'nullable|string|max:50',
        'modele' => 'nullable|string|max:100',
    ];

    public function mount()
    {
        $this->resetFilters();
    }

    public function render()
    {
        $query = Imprimante::query();

        // Application des filtres
        if ($this->search) {
            $query->where(function($q) {
                $q->where('nom', 'LIKE', '%'.$this->search.'%')
                  ->orWhere('modele', 'LIKE', '%'.$this->search.'%')
                  ->orWhere('numero_serie', 'LIKE', '%'.$this->search.'%')
                  ->orWhere('reseau_ip', 'LIKE', '%'.$this->search.'%');
            });
        }

        if ($this->filterStatut) {
            $query->where('statut', $this->filterStatut);
        }

        if ($this->filterFabricant) {
            $query->where('fabricant', $this->filterFabricant);
        }

        if ($this->filterEntite) {
            $query->where('entite', $this->filterEntite);
        }

        // Tri
        $query->orderBy($this->sortField, $this->sortDirection);

        $imprimantes = $query->paginate(20);

        // Données pour les filtres
        $fabricants = Imprimante::distinct()->pluck('fabricant')->filter();
        $entites = Imprimante::distinct()->pluck('entite')->filter();
        $statuts = ['En service', 'En stock', 'Hors service', 'En maintenance'];

        // Statistiques
        $stats = [
            'total' => Imprimante::count(),
            'en_service' => Imprimante::where('statut', 'En service')->count(),
            'en_stock' => Imprimante::where('statut', 'En stock')->count(),
            'en_maintenance' => Imprimante::where('statut', 'En maintenance')->count(),
            'hors_service' => Imprimante::where('statut', 'Hors service')->count(),
        ];

        return view('livewire.equipement.imprimante', compact('imprimantes', 'fabricants', 'entites', 'statuts', 'stats'));
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
        $this->isEditing = false;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $imprimante = Imprimante::findOrFail($id);
        
        $this->selectedId = $id;
        $this->nom = $imprimante->nom;
        $this->entite = $imprimante->entite;
        $this->statut = $imprimante->statut;
        $this->fabricant = $imprimante->fabricant;
        $this->reseau_ip = $imprimante->reseau_ip;
        $this->numero_serie = $imprimante->numero_serie;
        $this->lieu = $imprimante->lieu;
        $this->type = $imprimante->type;
        $this->modele = $imprimante->modele;

        $this->isEditing = true;
        $this->showModal = true;
    }

    public function save()
    {
        if ($this->isEditing) {
            $this->rules['numero_serie'] = 'nullable|string|max:100|unique:imprimantes,numero_serie,' . $this->selectedId;
        }

        $this->validate();

        $data = [
            'nom' => $this->nom,
            'entite' => $this->entite,
            'statut' => $this->statut,
            'fabricant' => $this->fabricant,
            'reseau_ip' => $this->reseau_ip,
            'numero_serie' => $this->numero_serie,
            'lieu' => $this->lieu,
            'type' => $this->type,
            'modele' => $this->modele,
        ];

        if ($this->isEditing) {
            Imprimante::find($this->selectedId)->update($data);
            session()->flash('message', 'Imprimante mise à jour avec succès.');
        } else {
            Imprimante::create($data);
            session()->flash('message', 'Imprimante créée avec succès.');
        }

        $this->closeModal();
        $this->resetForm();
    }

    public function delete($id)
    {
        Imprimante::find($id)->delete();
        session()->flash('message', 'Imprimante supprimée avec succès.');
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->reset([
            'nom', 'entite', 'statut', 'fabricant', 'reseau_ip', 
            'numero_serie', 'lieu', 'type', 'modele', 'selectedId', 'isEditing'
        ]);
        $this->resetErrorBag();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'filterStatut', 'filterFabricant', 'filterEntite']);
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterStatut()
    {
        $this->resetPage();
    }

    public function updatingFilterFabricant()
    {
        $this->resetPage();
    }

    public function updatingFilterEntite()
    {
        $this->resetPage();
    }
}
