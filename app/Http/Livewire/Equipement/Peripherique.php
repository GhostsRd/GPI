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
        $this->types = ['Clavier', 'Souris', 'Webcam', 'Casque', 'Écran', 'Imprimante'];
    }

    public function render()
    {
        $peripheriques = PeripheriqueModel::query()
            ->when($this->search, function($query) {
                return $query->where('nom', 'like', '%'.$this->search.'%')
                           ->orWhere('modele', 'like', '%'.$this->search.'%')
                           ->orWhere('fabricant', 'like', '%'.$this->search.'%');
            })
            ->when($this->filterStatut, function($query) {
                return $query->where('statut', $this->filterStatut);
            })
            ->when($this->filterType, function($query) {
                return $query->where('type', $this->filterType);
            })
            ->orderBy('nom')
            ->paginate(20);

        return view('livewire.equipement.peripherique', compact('peripheriques'));
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

    public function delete($id)
    {
        PeripheriqueModel::findOrFail($id)->delete();
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