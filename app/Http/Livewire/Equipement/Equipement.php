<?php

namespace App\Http\Livewire\Equipement;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Equipement as EquipementModel;
use Illuminate\Support\Facades\DB;

class Equipement extends Component
{
    use WithPagination;

    public $search = '';
    public $statut = '';
    public $type = '';
    public $emplacement = '';
    public $marque = '';

    // Variables pour la modale de création/édition
    public $showModal = false;
    public $modalTitle = 'Nouvel Équipement';
    public $editingId = null;

    // Champs du formulaire
    public $identification;
    public $nom_public;
    public $emplacement_form;
    public $marque_form;
    public $model_form;
    public $type_form;
    public $numero_serie;
    public $couleur = 'noir';
    public $technologie_impression;
    public $reference_cartouche;
    public $date_entree_stock;
    public $adresse_ip;
    public $statut_form = 'en_stock';
    public $description;

    protected $queryString = [
        'search' => ['except' => ''],
        'statut' => ['except' => ''],
        'type' => ['except' => ''],
        'emplacement' => ['except' => ''],
        'marque' => ['except' => ''],
    ];

    protected $rules = [
        'identification' => 'required|unique:equipements,identification',
        'nom_public' => 'required|string|max:255',
        'emplacement_form' => 'required|string|max:255',
        'marque_form' => 'required|string|max:255',
        'model_form' => 'required|string|max:255',
        'type_form' => 'required|string|max:255',
        'couleur' => 'required|string|max:255',
        'date_entree_stock' => 'required|date',
        'statut_form' => 'required|in:en_stock,en_pret,en_maintenance',
    ];

    public function render()
    {
        // Statistiques
        $stats = [
            'total' => EquipementModel::count(),
            'en_stock' => EquipementModel::where('statut', 'en_stock')->count(),
            'en_pret' => EquipementModel::where('statut', 'en_pret')->count(),
            'en_maintenance' => EquipementModel::where('statut', 'en_maintenance')->count(),
        ];

        // Données pour les filtres
        $types = EquipementModel::distinct()->pluck('type')->filter();
        $emplacements = EquipementModel::distinct()->pluck('emplacement')->filter();
        $marques = EquipementModel::distinct()->pluck('marque')->filter();

        // Équipements filtrés
        $equipements = EquipementModel::when($this->search, function ($query) {
            $query->where(function ($q) {
                $q->where('identification', 'like', '%' . $this->search . '%')
                    ->orWhere('nom_public', 'like', '%' . $this->search . '%')
                    ->orWhere('numero_serie', 'like', '%' . $this->search . '%')
                    ->orWhere('adresse_ip', 'like', '%' . $this->search . '%');
            });
        })
            ->when($this->statut, fn($query) => $query->where('statut', $this->statut))
            ->when($this->type, fn($query) => $query->where('type', $this->type))
            ->when($this->emplacement, fn($query) => $query->where('emplacement', $this->emplacement))
            ->when($this->marque, fn($query) => $query->where('marque', $this->marque))
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.equipement.equipement', compact(
            'stats',
            'equipements',
            'types',
            'emplacements',
            'marques'
        ));
    }

    public function updatingSearch() { $this->resetPage(); }
    public function updatingStatut() { $this->resetPage(); }
    public function updatingType() { $this->resetPage(); }
    public function updatingEmplacement() { $this->resetPage(); }
    public function updatingMarque() { $this->resetPage(); }

    // Ouvrir la modale de création
    public function create()
    {
        $this->resetForm();
        $this->modalTitle = 'Nouvel Équipement';
        $this->showModal = true;
    }

    // Ouvrir la modale d'édition
    public function edit($id)
    {
        $equipement = EquipementModel::findOrFail($id);

        $this->editingId = $id;
        $this->identification = $equipement->identification;
        $this->nom_public = $equipement->nom_public;
        $this->emplacement_form = $equipement->emplacement;
        $this->marque_form = $equipement->marque;
        $this->model_form = $equipement->model;
        $this->type_form = $equipement->type;
        $this->numero_serie = $equipement->numero_serie;
        $this->couleur = $equipement->couleur;
        $this->technologie_impression = $equipement->technologie_impression;
        $this->reference_cartouche = $equipement->reference_cartouche;
        $this->date_entree_stock = $equipement->date_entree_stock->format('Y-m-d');
        $this->adresse_ip = $equipement->adresse_ip;
        $this->statut_form = $equipement->statut;
        $this->description = $equipement->description;

        $this->modalTitle = 'Modifier l\'Équipement';
        $this->showModal = true;
    }

    // Sauvegarder (création ou édition)
    public function save()
    {
        if ($this->editingId) {
            $this->rules['identification'] = 'required|unique:equipements,identification,' . $this->editingId;
        }

        $this->validate();

        $data = [
            'identification' => $this->identification,
            'nom_public' => $this->nom_public,
            'emplacement' => $this->emplacement_form,
            'marque' => $this->marque_form,
            'model' => $this->model_form,
            'type' => $this->type_form,
            'numero_serie' => $this->numero_serie,
            'couleur' => $this->couleur,
            'technologie_impression' => $this->technologie_impression,
            'reference_cartouche' => $this->reference_cartouche,
            'date_entree_stock' => $this->date_entree_stock,
            'adresse_ip' => $this->adresse_ip,
            'statut' => $this->statut_form,
            'description' => $this->description,
        ];

        if ($this->editingId) {
            EquipementModel::find($this->editingId)->update($data);
            $message = 'Équipement modifié avec succès!';
        } else {
            EquipementModel::create($data);
            $message = 'Équipement créé avec succès!';
        }

        $this->showModal = false;
        $this->resetForm();

        session()->flash('success', $message);
    }

    // Supprimer un équipement
    public function delete($id)
    {
        $equipement = EquipementModel::findOrFail($id);
        $equipement->delete();

        session()->flash('success', 'Équipement supprimé avec succès!');
    }

    // Réinitialiser le formulaire
    private function resetForm()
    {
        $this->reset([
            'editingId',
            'identification',
            'nom_public',
            'emplacement_form',
            'marque_form',
            'model_form',
            'type_form',
            'numero_serie',
            'couleur',
            'technologie_impression',
            'reference_cartouche',
            'date_entree_stock',
            'adresse_ip',
            'statut_form',
            'description',
        ]);
        $this->resetErrorBag();
    }

    // Fermer la modale
    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }
}
