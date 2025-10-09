<?php

namespace App\Http\Livewire\Equipement;

use App\Models\Moniteur as MoniteurModel;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Moniteur extends Component
{
    use WithPagination;

    // Propriétés pour la recherche et les filtres
    public $search = '';
    public $statut = '';
    public $entite = '';
    public $fabricant = '';

    // Propriétés pour le formulaire
    public $moniteurId;
    public $nom;
    public $entite_form;
    public $statut_form = 'En service';
    public $fabricant_form;
    public $numero_serie;
    public $utilisateur_id;
    public $usager_id;
    public $lieu;
    public $type;
    public $modele;
    public $commentaires;

    public $isEditing = false;
    public $showModal = false;
    public $showStats = true;

    // Données pour les selects
    public $utilisateurs;
    public $statuts = ['En service', 'En stock', 'Hors service', 'En réparation'];
    public $types = ['LCD', 'LED', '4K', 'Ultra HD', 'Curved', 'IPS', 'TN', 'VA'];

    // Propriétés pour les statistiques
    public $statsGlobales = [];
    public $statsParEntite = [];
    public $statsParFabricant = [];
    public $statsParType = [];
    public $evolutionMensuelle = [];

    protected $rules = [
        'nom' => 'required|string|max:100',
        'entite_form' => 'nullable|string|max:100',
        'statut_form' => 'required|in:En service,En stock,Hors service,En réparation',
        'fabricant_form' => 'nullable|string|max:100',
        'numero_serie' => 'nullable|string|max:100',
        'utilisateur_id' => 'nullable|exists:users,id',
        'usager_id' => 'nullable|exists:users,id',
        'lieu' => 'nullable|string|max:150',
        'type' => 'nullable|string|max:50',
        'modele' => 'nullable|string|max:100',
        'commentaires' => 'nullable|string'
    ];

    public function mount()
    {
        $this->utilisateurs = User::orderBy('name')->get();
        $this->chargerStatistiques();
    }

    public function render()
    {
        $query = MoniteurModel::with(['utilisateur', 'usager']);

        // Application des filtres
        if ($this->statut) {
            $query->where('statut', $this->statut);
        }

        if ($this->entite) {
            $query->where('entite', $this->entite);
        }

        if ($this->fabricant) {
            $query->where('fabricant', $this->fabricant);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nom', 'LIKE', "%{$this->search}%")
                    ->orWhere('numero_serie', 'LIKE', "%{$this->search}%")
                    ->orWhere('fabricant', 'LIKE', "%{$this->search}%")
                    ->orWhere('modele', 'LIKE', "%{$this->search}%")
                    ->orWhere('lieu', 'LIKE', "%{$this->search}%")
                    ->orWhereHas('utilisateur', function ($q) {
                        $q->where('name', 'LIKE', "%{$this->search}%");
                    })
                    ->orWhereHas('usager', function ($q) {
                        $q->where('name', 'LIKE', "%{$this->search}%");
                    });
            });
        }

        $moniteurs = $query->orderBy('nom')->paginate(20);

        // Récupérer les listes pour les filtres
        $fabricantsList = MoniteurModel::whereNotNull('fabricant')
            ->distinct()
            ->pluck('fabricant')
            ->toArray();
            
        $entitesList = MoniteurModel::whereNotNull('entite')
            ->distinct()
            ->pluck('entite')
            ->toArray();

        return view('livewire.equipement.moniteur', compact('moniteurs', 'fabricantsList', 'entitesList'));
    }

    /**
     * Charger les statistiques
     */
    public function chargerStatistiques()
    {
        try {
            // Statistiques globales par statut
            $this->statsGlobales = MoniteurModel::select('statut', DB::raw('COUNT(*) as count'))
                ->groupBy('statut')
                ->get()
                ->pluck('count', 'statut')
                ->toArray();

            // Statistiques par entité
            $this->statsParEntite = MoniteurModel::select('entite', DB::raw('COUNT(*) as count'))
                ->whereNotNull('entite')
                ->groupBy('entite')
                ->orderBy('count', 'desc')
                ->get()
                ->toArray();

            // Statistiques par fabricant
            $this->statsParFabricant = MoniteurModel::select('fabricant', DB::raw('COUNT(*) as count'))
                ->whereNotNull('fabricant')
                ->groupBy('fabricant')
                ->orderBy('count', 'desc')
                ->get()
                ->toArray();

            // Statistiques par type
            $this->statsParType = MoniteurModel::select('type', DB::raw('COUNT(*) as count'))
                ->whereNotNull('type')
                ->groupBy('type')
                ->orderBy('count', 'desc')
                ->get()
                ->toArray();

            // Évolution mensuelle (6 derniers mois)
            $this->evolutionMensuelle = MoniteurModel::select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
                ->where('created_at', '>=', now()->subMonths(6))
                ->groupBy('year', 'month')
                ->orderBy('year', 'desc')
                ->orderBy('month', 'desc')
                ->get()
                ->map(function ($item) {
                    return [
                        'year' => $item->year,
                        'month' => $item->month,
                        'count' => $item->count,
                        'month_name' => $this->getMonthName($item->month)
                    ];
                })
                ->toArray();

        } catch (\Exception $e) {
            // En cas d'erreur (table non existante), initialiser des tableaux vides
            $this->statsGlobales = [];
            $this->statsParEntite = [];
            $this->statsParFabricant = [];
            $this->statsParType = [];
            $this->evolutionMensuelle = [];
        }
    }

    /**
     * Obtenir le nom du mois
     */
    private function getMonthName($month)
    {
        $months = [
            1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril',
            5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août',
            9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre'
        ];
        return $months[$month] ?? 'Mois inconnu';
    }

    /**
     * Afficher/Masquer les statistiques
     */
    public function toggleStats()
    {
        $this->showStats = !$this->showStats;
        if ($this->showStats) {
            $this->chargerStatistiques();
        }
    }

    /**
     * Obtenir le pourcentage pour un statut
     */
    public function getPourcentageStatut($statut)
    {
        $total = array_sum($this->statsGlobales);
        if ($total === 0) return 0;

        $count = $this->statsGlobales[$statut] ?? 0;
        return round(($count / $total) * 100, 1);
    }

    /**
     * Obtenir la couleur pour un statut
     */
    public function getCouleurStatut($statut)
    {
        return match($statut) {
            'En service' => 'success',
            'En stock' => 'info',
            'En réparation' => 'warning',
            'Hors service' => 'danger',
            default => 'secondary'
        };
    }

    /**
     * Obtenir l'icône pour un statut
     */
    public function getIconeStatut($statut)
    {
        return match($statut) {
            'En service' => 'fa-check-circle',
            'En stock' => 'fa-warehouse',
            'En réparation' => 'fa-tools',
            'Hors service' => 'fa-times-circle',
            default => 'fa-question-circle'
        };
    }

    /**
     * Réinitialiser les filtres
     */
    public function resetFilters()
    {
        $this->reset(['search', 'statut', 'entite', 'fabricant']);
        $this->resetPage();
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        $this->resetForm();
        $this->isEditing = false;
        $this->showModal = true;
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit($id)
    {
        $moniteur = MoniteurModel::findOrFail($id);

        $this->moniteurId = $moniteur->id;
        $this->nom = $moniteur->nom;
        $this->entite_form = $moniteur->entite;
        $this->statut_form = $moniteur->statut;
        $this->fabricant_form = $moniteur->fabricant;
        $this->numero_serie = $moniteur->numero_serie;
        $this->utilisateur_id = $moniteur->utilisateur_id;
        $this->usager_id = $moniteur->usager_id;
        $this->lieu = $moniteur->lieu;
        $this->type = $moniteur->type;
        $this->modele = $moniteur->modele;
        $this->commentaires = $moniteur->commentaires;

        $this->isEditing = true;
        $this->showModal = true;
    }

    /**
     * Enregistrer un nouveau moniteur
     */
    public function store()
    {
        $validatedData = $this->validate();

        try {
            MoniteurModel::create([
                'nom' => $this->nom,
                'entite' => $this->entite_form,
                'statut' => $this->statut_form,
                'fabricant' => $this->fabricant_form,
                'numero_serie' => $this->numero_serie,
                'utilisateur_id' => $this->utilisateur_id,
                'usager_id' => $this->usager_id,
                'lieu' => $this->lieu,
                'type' => $this->type,
                'modele' => $this->modele,
                'commentaires' => $this->commentaires,
            ]);

            $this->showModal = false;
            $this->resetForm();
            $this->chargerStatistiques();

            $this->dispatchBrowserEvent('notify', [
                'type' => 'success',
                'message' => 'Moniteur créé avec succès.'
            ]);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('notify', [
                'type' => 'error',
                'message' => 'Erreur lors de la création du moniteur: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Mettre à jour un moniteur
     */
    public function update()
    {
        $this->validate([
            'nom' => 'required|string|max:100|unique:moniteurs,nom,' . $this->moniteurId,
            'entite_form' => 'nullable|string|max:100',
            'statut_form' => 'required|in:En service,En stock,Hors service,En réparation',
            'fabricant_form' => 'nullable|string|max:100',
            'numero_serie' => 'nullable|string|max:100|unique:moniteurs,numero_serie,' . $this->moniteurId,
            'utilisateur_id' => 'nullable|exists:users,id',
            'usager_id' => 'nullable|exists:users,id',
            'lieu' => 'nullable|string|max:150',
            'type' => 'nullable|string|max:50',
            'modele' => 'nullable|string|max:100',
            'commentaires' => 'nullable|string'
        ]);

        try {
            $moniteur = MoniteurModel::findOrFail($this->moniteurId);
            $moniteur->update([
                'nom' => $this->nom,
                'entite' => $this->entite_form,
                'statut' => $this->statut_form,
                'fabricant' => $this->fabricant_form,
                'numero_serie' => $this->numero_serie,
                'utilisateur_id' => $this->utilisateur_id,
                'usager_id' => $this->usager_id,
                'lieu' => $this->lieu,
                'type' => $this->type,
                'modele' => $this->modele,
                'commentaires' => $this->commentaires,
            ]);

            $this->showModal = false;
            $this->resetForm();
            $this->chargerStatistiques();

            $this->dispatchBrowserEvent('notify', [
                'type' => 'success',
                'message' => 'Moniteur mis à jour avec succès.'
            ]);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('notify', [
                'type' => 'error',
                'message' => 'Erreur lors de la mise à jour du moniteur: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Supprimer un moniteur
     */
    public function delete($id)
    {
        try {
            MoniteurModel::findOrFail($id)->delete();
            $this->chargerStatistiques();

            $this->dispatchBrowserEvent('notify', [
                'type' => 'success',
                'message' => 'Moniteur supprimé avec succès.'
            ]);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('notify', [
                'type' => 'error',
                'message' => 'Erreur lors de la suppression du moniteur: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Confirmer la suppression
     */
    public function confirmDelete($id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Êtes-vous sûr?',
            'text' => 'Cette action est irréversible!',
            'id' => $id
        ]);
    }

    /**
     * Réinitialiser le formulaire
     */
    private function resetForm()
    {
        $this->reset([
            'moniteurId', 'nom', 'entite_form', 'statut_form', 'fabricant_form',
            'numero_serie', 'utilisateur_id', 'usager_id', 'lieu', 'type',
            'modele', 'commentaires'
        ]);
        $this->resetErrorBag();
    }

    /**
     * Fermer le modal
     */
    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    /**
     * Gérer la pagination
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatut()
    {
        $this->resetPage();
    }

    public function updatingEntite()
    {
        $this->resetPage();
    }

    public function updatingFabricant()
    {
        $this->resetPage();
    }

    /**
     * Écouteur d'événements pour la suppression
     */
    protected $listeners = [
        'deleteConfirmed' => 'delete'
    ];
}