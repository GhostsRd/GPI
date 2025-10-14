<?php

namespace App\Http\Livewire\Equipement;

use App\Models\Peripherique as PeripheriqueModel;
use Livewire\Component;
use Livewire\WithPagination;

class Peripherique extends Component
{
    use WithPagination;

    public $showForm = false;
    public $editingId = null;

    // Propriétés du formulaire
    public $nom = '';
    public $entite = '';
    public $statut = '';
    public $fabricant = '';
    public $lieu = '';
    public $type = '';
    public $modele = '';
    public $usager = '';

    // Propriétés de recherche
    public $search = '';
    public $filterStatut = '';
    public $filterType = '';
    public $sortField = 'nom';
    public $sortDirection = 'asc';

    // Confirmation suppression
    public $confirmingDelete = null;

    // Options pour les selects
    public $statuts = [];
    public $types = [];

    protected $rules = [
        'nom' => 'required|string|max:100|unique:peripheriques,nom',
        'entite' => 'nullable|string|max:100',
        'statut' => 'required|in:En service,En stock,Hors service,En réparation',
        'fabricant' => 'nullable|string|max:100',
        'lieu' => 'nullable|string|max:150',
        'type' => 'required|string|max:100',
        'modele' => 'nullable|string|max:100',
        'usager' => 'nullable|string|max:100',
    ];

    public function mount()
    {
        $this->statuts = ['En service', 'En stock', 'Hors service', 'En réparation'];
        $this->types = ['Clavier', 'Souris', 'Webcam', 'Casque', 'Écran', 'Imprimante', 'Scanner'];
    }

    // Computed properties pour les statistiques
    public function getTotalPeripheriquesProperty()
    {
        return PeripheriqueModel::count();
    }

    public function getEnServiceCountProperty()
    {
        return PeripheriqueModel::where('statut', 'En service')->count();
    }

    public function getEnStockCountProperty()
    {
        return PeripheriqueModel::where('statut', 'En stock')->count();
    }

    public function getHorsServiceCountProperty()
    {
        return PeripheriqueModel::where('statut', 'Hors service')->count();
    }

    public function getEnReparationCountProperty()
    {
        return PeripheriqueModel::where('statut', 'En réparation')->count();
    }

    public function getPeripheriquesProperty()
    {
        return PeripheriqueModel::query()
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('nom', 'like', '%'.$this->search.'%')
                        ->orWhere('modele', 'like', '%'.$this->search.'%')
                        ->orWhere('fabricant', 'like', '%'.$this->search.'%')
                        ->orWhere('entite', 'like', '%'.$this->search.'%');
                });
            })
            ->when($this->filterStatut, function($query) {
                $query->where('statut', $this->filterStatut);
            })
            ->when($this->filterType, function($query) {
                $query->where('type', $this->filterType);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(20);
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

    public function render()
    {
        return view('livewire.equipement.peripherique', [
            'peripheriques' => $this->peripheriques,
            'totalPeripheriques' => $this->totalPeripheriques,
            'enServiceCount' => $this->enServiceCount,
            'enStockCount' => $this->enStockCount,
            'horsServiceCount' => $this->horsServiceCount,
            'enReparationCount' => $this->enReparationCount,
            'sortField' => $this->sortField,
            'sortDirection' => $this->sortDirection,
        ]);
    }

    public function showForm()
    {
        $this->resetForm();
        $this->showForm = true;
        $this->editingId = null;
    }

    public function edit($id)
    {
        $peripherique = PeripheriqueModel::findOrFail($id);

        $this->editingId = $peripherique->id;
        $this->nom = $peripherique->nom;
        $this->entite = $peripherique->entite;
        $this->statut = $peripherique->statut;
        $this->fabricant = $peripherique->fabricant;
        $this->lieu = $peripherique->lieu;
        $this->type = $peripherique->type;
        $this->modele = $peripherique->modele;
        $this->usager = $peripherique->usager;

        $this->showForm = true;
    }

    public function save()
    {
        if ($this->editingId) {
            $this->rules['nom'] = 'required|string|max:100|unique:peripheriques,nom,' . $this->editingId;
        }

        $this->validate();

        $data = [
            'nom' => $this->nom,
            'entite' => $this->entite,
            'statut' => $this->statut,
            'fabricant' => $this->fabricant,
            'lieu' => $this->lieu,
            'type' => $this->type,
            'modele' => $this->modele,
            'usager' => $this->usager,
        ];

        if ($this->editingId) {
            PeripheriqueModel::find($this->editingId)->update($data);
            $message = 'Périphérique mis à jour avec succès.';
        } else {
            PeripheriqueModel::create($data);
            $message = 'Périphérique créé avec succès.';
        }

        $this->resetForm();
        $this->showForm = false;
        session()->flash('success', $message);
    }

    public function confirmDelete($id)
    {
        $this->confirmingDelete = $id;
    }

    public function delete($id)
    {
        PeripheriqueModel::findOrFail($id)->delete();
        $this->confirmingDelete = null;
        session()->flash('success', 'Périphérique supprimé avec succès.');
    }

    public function resetForm()
    {
        $this->reset([
            'editingId', 'nom', 'entite', 'statut', 'fabricant',
            'lieu', 'type', 'modele', 'usager'
        ]);
        $this->resetErrorBag();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'filterStatut', 'filterType']);
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

    public function updatingFilterType()
    {
        $this->resetPage();
    }
}
