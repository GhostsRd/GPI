<?php


namespace App\Http\Livewire\Equipement;

use App\Models\telephone as TelephoneModel;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class Telephone extends Component

{
    use WithPagination;

    // Propriétés pour le formulaire
    public $telephoneId;
    public $nom;
    public $entite;
    public $usager;
    public $lieu;
    public $services;
    public $type;
    public $marque;
    public $modele;
    public $numero_serie;
    public $statut = 'En service';
    public $emplacement_actuel;
    public $imei;

    // Propriétés pour les filtres
    public $search = '';
    public $filterStatut = '';
    public $filterType = '';
    public $perPage = 10;

    // États du composant
    public $showForm = false;
    public $isEditing = false;
    public $showDeleteModal = false;
    public $telephoneToDelete;

    protected $queryString = [
        'search' => ['except' => ''],
        'filterStatut' => ['except' => ''],
        'filterType' => ['except' => ''],
    ];

    // Règles de validation
    protected function rules()
    {
        return [
            'nom' => 'required|string|max:100',
            'entite' => 'nullable|string|max:100',
            'usager' => 'nullable|string|max:100',
            'lieu' => 'required|string|max:150',
            'services' => 'nullable|string',
            'type' => 'required|string|in:Téléphone,Tablette',
            'marque' => 'required|string|max:100',
            'modele' => 'required|string|max:100',
            'numero_serie' => [
                'required',
                'string',
                'max:100',
                Rule::unique('telephones_tablettes', 'numero_serie')->ignore($this->telephoneId)
            ],
            'statut' => 'required|in:En service,En stock,Hors service,En réparation',
            'emplacement_actuel' => 'required|string|max:150',
            'imei' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('telephones_tablettes', 'imei')->ignore($this->telephoneId)
            ]
        ];
    }

    // Réinitialisation des filtres
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

    // Ouvrir le formulaire de création
    public function create()
    {
        $this->resetForm();
        $this->isEditing = false;
        $this->showForm = true;
    }

    // Ouvrir le formulaire d'édition
    public function edit($id)
    {
        $telephone = TelephoneModel::findOrFail($id);
        
        $this->telephoneId = $telephone->id;
        $this->nom = $telephone->nom;
        $this->entite = $telephone->entite;
        $this->usager = $telephone->usager;
        $this->lieu = $telephone->lieu;
        $this->services = $telephone->services;
        $this->type = $telephone->type;
        $this->marque = $telephone->marque;
        $this->modele = $telephone->modele;
        $this->numero_serie = $telephone->numero_serie;
        $this->statut = $telephone->statut;
        $this->emplacement_actuel = $telephone->emplacement_actuel;
        $this->imei = $telephone->imei;

        $this->isEditing = true;
        $this->showForm = true;
    }

    // Sauvegarder (création ou édition)
    public function save()
    {
        $this->validate();

        $data = [
            'nom' => $this->nom,
            'entite' => $this->entite,
            'usager' => $this->usager,
            'lieu' => $this->lieu,
            'services' => $this->services,
            'type' => $this->type,
            'marque' => $this->marque,
            'modele' => $this->modele,
            'numero_serie' => $this->numero_serie,
            'statut' => $this->statut,
            'emplacement_actuel' => $this->emplacement_actuel,
            'imei' => $this->imei,
        ];

        if ($this->isEditing) {
            $telephone = TelephoneModel::find($this->telephoneId);
            $telephone->update($data);
            $message = 'Équipement mis à jour avec succès.';
        } else {
            TelephoneModel::create($data);  // <-- utiliser le modèle correctement
            $message = 'Équipement créé avec succès.';
        }

        $this->resetForm();
        $this->showForm = false;

        session()->flash('success', $message);
    }


    // Confirmer la suppression
    public function confirmDelete($id)
    {
        $this->telephoneToDelete = $id;
        $this->showDeleteModal = true;
    }

    // Supprimer l'équipement
    public function delete()
    {
        TelephoneModel::find($this->telephoneToDelete)->delete();
        
        $this->showDeleteModal = false;
        $this->telephoneToDelete = null;
        
        session()->flash('success', 'Équipement supprimé avec succès.');
    }

    // Annuler la suppression
    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->telephoneToDelete = null;
    }

    // Réinitialiser le formulaire
    private function resetForm()
    {
        $this->reset([
            'telephoneId',
            'nom',
            'entite',
            'usager',
            'lieu',
            'services',
            'type',
            'marque',
            'modele',
            'numero_serie',
            'statut',
            'emplacement_actuel',
            'imei'
        ]);
        $this->statut = 'En service';
        $this->resetErrorBag();
    }

    // Fermer le formulaire
    public function closeForm()
    {
        $this->showForm = false;
        $this->resetForm();
    }

    public function render()
    {
        $query = TelephoneModel::query();

        // Appliquer les filtres
        if ($this->search) {
            $query->where(function($q) {
                $q->where('nom', 'like', '%' . $this->search . '%')
                  ->orWhere('usager', 'like', '%' . $this->search . '%')
                  ->orWhere('numero_serie', 'like', '%' . $this->search . '%')
                  ->orWhere('imei', 'like', '%' . $this->search . '%')
                  ->orWhere('marque', 'like', '%' . $this->search . '%')
                  ->orWhere('modele', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->filterStatut) {
            $query->where('statut', $this->filterStatut);
        }

        if ($this->filterType) {
            $query->where('type', $this->filterType);
        }

        $telephones = $query->latest()->paginate($this->perPage);

        // Statistiques
        $stats = [
            'total' => TelephoneModel::count(),
            'enService' => TelephoneModel::where('statut', 'En service')->count(),
            'enStock' => TelephoneModel::where('statut', 'En stock')->count(),
            'horsService' => TelephoneModel::where('statut', 'Hors service')->count(),
            'enReparation' => TelephoneModel::where('statut', 'En réparation')->count(),
        ];

        return view('livewire.equipement.telephone', compact('telephones', 'stats'));
    }
}