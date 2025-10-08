<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Equipement;
use Illuminate\Support\Facades\DB;

class EquipementITController extends Component
{
    use WithPagination;

    // Propriétés pour la recherche et les filtres
    public $search = '';
    public $statut = '';
    public $type = '';
    public $emplacement = '';
    public $marque = '';

    // Propriétés pour le modal
    public $showModal = false;
    public $editingId = null;
    public $modalTitle = '';

    // Propriétés du formulaire
    public $identification = '';
    public $nom_public = '';
    public $emplacement_form = '';
    public $marque_form = '';
    public $model_form = '';
    public $type_form = '';
    public $numero_serie = '';
    public $couleur = 'noir';
    public $technologie_impression = '';
    public $reference_cartouche = '';
    public $date_entree_stock = '';
    public $adresse_ip = '';
    public $statut_form = 'en_stock';
    public $description = '';

    protected $rules = [
        'identification' => 'required|unique:equipements,identification',
        'nom_public' => 'required|string|max:255',
        'emplacement_form' => 'required|string|max:255',
        'marque_form' => 'required|string|max:255',
        'model_form' => 'required|string|max:255',
        'type_form' => 'required|string|max:255',
        'couleur' => 'required|in:noir,blanc,gris',
        'date_entree_stock' => 'required|date',
        'statut_form' => 'required|in:en_stock,en_pret,en_maintenance',
    ];

    public function mount()
    {
        $this->date_entree_stock = now()->format('Y-m-d');
    }

    public function render()
    {
        $query = Equipement::query()
            ->search($this->search)
            ->byStatut($this->statut)
            ->byType($this->type)
            ->byEmplacement($this->emplacement)
            ->byMarque($this->marque);

        $equipements = $query->orderBy('created_at', 'desc')->paginate(10);

        // Statistiques
        $stats = [
            'total' => Equipement::count(),
            'en_stock' => Equipement::where('statut', 'en_stock')->count(),
            'en_pret' => Equipement::where('statut', 'en_pret')->count(),
            'en_maintenance' => Equipement::where('statut', 'en_maintenance')->count(),
        ];

        // Listes pour les filtres
        $types = Equipement::distinct()->pluck('type')->filter();
        $emplacements = Equipement::distinct()->pluck('emplacement')->filter();
        $marques = Equipement::distinct()->pluck('marque')->filter();

        return view('livewire.equipement-i-t-controller', compact('equipements', 'stats', 'types', 'emplacements', 'marques'));
    }

    public function create()
    {
        $this->resetForm();
        $this->modalTitle = 'Nouvel Équipement';
        $this->showModal = true;
        $this->editingId = null;
    }

    public function edit($id)
    {
        $equipement = Equipement::findOrFail($id);

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
            Equipement::find($this->editingId)->update($data);
            session()->flash('success', 'Équipement modifié avec succès.');
        } else {
            Equipement::create($data);
            session()->flash('success', 'Équipement créé avec succès.');
        }

        $this->closeModal();
    }

    public function delete($id)
    {
        $equipement = Equipement::findOrFail($id);
        $equipement->delete();

        session()->flash('success', 'Équipement supprimé avec succès.');
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
        $this->editingId = null;
    }

    private function resetForm()
    {
        $this->reset([
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
            'description'
        ]);
        $this->date_entree_stock = now()->format('Y-m-d');
        $this->couleur = 'noir';
        $this->statut_form = 'en_stock';
    }

    public function export()
    {
        // Implémentez l'exportation Excel/CSV ici
        session()->flash('success', 'Exportation en cours...');
    }
}
