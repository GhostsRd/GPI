<?php
namespace App\Http\Livewire\Equipement;


use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Ordinateur as OrdinateurModel; //
use App\Models\Utilisateur; // si tu l’utilises
use Illuminate\Support\Facades\DB;


class Ordinateur extends Component
{
    use WithPagination;

    public $search = '';
    public $statut = '';
    public $entite = '';
    public $perPage = 20;

    // Variables pour le formulaire
    public $ordinateurId;
    public $nom;
    public $entite_form;
    public $sous_entite;
    public $statut_form = 'En service';
    public $fabricant;
    public $modele;
    public $numero_serie;
    public $utilisateur_id;
    public $usager_id;
    public $date_dernier_inventaire;
    public $reseau_ip;
    public $disque_dur;
    public $os_version;
    public $os_noyau;
    public $derniere_date_demarrage;
    public $notes;

    public $showModal = false;
    public $modalTitle = 'Ajouter un ordinateur';
    public $editMode = false;

    protected $rules = [
        'nom' => 'required|string|max:100|unique:ordinateurs,nom',
        'entite_form' => 'nullable|string|max:100',
        'sous_entite' => 'nullable|string|max:100',
        'statut_form' => 'required|in:En service,En stock,Hors service,En réparation',
        'fabricant' => 'nullable|string|max:100',
        'modele' => 'nullable|string|max:100',
        'numero_serie' => 'nullable|string|max:100|unique:ordinateurs,numero_serie',
        'utilisateur_id' => 'nullable|exists:utilisateurs,id',
        'usager_id' => 'nullable|exists:utilisateurs,id',
        'date_dernier_inventaire' => 'nullable|date',
        'reseau_ip' => 'nullable|ip',
        'disque_dur' => 'nullable|string|max:50',
        'os_version' => 'nullable|string|max:100',
        'os_noyau' => 'nullable|string|max:100',
        'derniere_date_demarrage' => 'nullable|date',
        'notes' => 'nullable|string'
    ];

    public function mount()
    {
        $this->resetPage();
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['search', 'statut', 'entite', 'perPage'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        $query = OrdinateurModel::with(['utilisateur', 'usager']); // ✅

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nom', 'LIKE', "%{$this->search}%")
                    ->orWhere('numero_serie', 'LIKE', "%{$this->search}%")
                    ->orWhere('fabricant', 'LIKE', "%{$this->search}%")
                    ->orWhere('modele', 'LIKE', "%{$this->search}%")
                    ->orWhere('reseau_ip', 'LIKE', "%{$this->search}%")
                    ->orWhereHas('utilisateur', function ($q) {
                        $q->where('name', 'LIKE', "%{$this->search}%");
                    });
            });
        }

        if ($this->statut) {
            $query->where('statut', $this->statut);
        }

        if ($this->entite) {
            $query->where('entite', 'LIKE', "%{$this->entite}%");
        }

        $ordinateurs = $query->orderBy('nom')->paginate($this->perPage);
        $utilisateurs = Utilisateur::orderBy('nom')->get();
        $statuts = ['En service', 'En stock', 'Hors service', 'En réparation'];

        // ✅ Utilise le modèle aliasé ici aussi
        $stats = OrdinateurModel::select('statut', DB::raw('COUNT(*) as count'))
            ->groupBy('statut')
            ->get()
            ->pluck('count', 'statut');

        return view('livewire.equipement.ordinateur', compact('ordinateurs', 'utilisateurs', 'statuts', 'stats'));
    }


    public function create()
    {
        $this->resetForm();
        $this->modalTitle = 'Ajouter un ordinateur';
        $this->editMode = false;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $ordinateur = Ordinateur::findOrFail($id);

        $this->ordinateurId = $ordinateur->id;
        $this->nom = $ordinateur->nom;
        $this->entite_form = $ordinateur->entite;
        $this->sous_entite = $ordinateur->sous_entite;
        $this->statut_form = $ordinateur->statut;
        $this->fabricant = $ordinateur->fabricant;
        $this->modele = $ordinateur->modele;
        $this->numero_serie = $ordinateur->numero_serie;
        $this->utilisateur_id = $ordinateur->utilisateur_id;
        $this->usager_id = $ordinateur->usager_id;
        $this->date_dernier_inventaire = $ordinateur->date_dernier_inventaire ? $ordinateur->date_dernier_inventaire->format('Y-m-d') : null;
        $this->reseau_ip = $ordinateur->reseau_ip;
        $this->disque_dur = $ordinateur->disque_dur;
        $this->os_version = $ordinateur->os_version;
        $this->os_noyau = $ordinateur->os_noyau;
        $this->derniere_date_demarrage = $ordinateur->derniere_date_demarrage ? $ordinateur->derniere_date_demarrage->format('Y-m-d\TH:i') : null;
        $this->notes = $ordinateur->notes;

        $this->modalTitle = 'Modifier l\'ordinateur';
        $this->editMode = true;
        $this->showModal = true;
    }

    public function save()
    {
        if ($this->editMode) {
            $this->rules['nom'] = 'required|string|max:100|unique:ordinateurs,nom,' . $this->ordinateurId;
            $this->rules['numero_serie'] = 'nullable|string|max:100|unique:ordinateurs,numero_serie,' . $this->ordinateurId;
        }

        $this->validate();

        try {
            $data = [
                'nom' => $this->nom,
                'entite' => $this->entite_form,
                'sous_entite' => $this->sous_entite,
                'statut' => $this->statut_form,
                'fabricant' => $this->fabricant,
                'modele' => $this->modele,
                'numero_serie' => $this->numero_serie,
                'utilisateur_id' => $this->utilisateur_id,
                'usager_id' => $this->usager_id,
                'date_dernier_inventaire' => $this->date_dernier_inventaire,
                'reseau_ip' => $this->reseau_ip,
                'disque_dur' => $this->disque_dur,
                'os_version' => $this->os_version,
                'os_noyau' => $this->os_noyau,
                'derniere_date_demarrage' => $this->derniere_date_demarrage,
                'notes' => $this->notes,
            ];

            if ($this->editMode) {
                $ordinateur = Ordinateur::findOrFail($this->ordinateurId);
                $ordinateur->update($data);
                session()->flash('message', 'Ordinateur mis à jour avec succès.');
            } else {
                Ordinateur::create($data);
                session()->flash('message', 'Ordinateur créé avec succès.');
            }

            $this->resetForm();
            $this->showModal = false;
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de l\'opération: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $ordinateur = OrdinateurModel::findOrFail($id); // ✅ Bon modèle
        $ordinateur->delete();

        session()->flash('message', 'Ordinateur supprimé avec succès.');
    }

    public function resetForm()
    {
        $this->reset([
            'ordinateurId', 'nom', 'entite_form', 'sous_entite', 'statut_form',
            'fabricant', 'modele', 'numero_serie', 'utilisateur_id', 'usager_id',
            'date_dernier_inventaire', 'reseau_ip', 'disque_dur', 'os_version',
            'os_noyau', 'derniere_date_demarrage', 'notes'
        ]);
        $this->resetErrorBag();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }
}
