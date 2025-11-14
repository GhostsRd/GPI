<?php

namespace App\Http\Livewire\Equipement;

use App\Models\Peripherique;
use App\Models\HistoriqueSortie;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Accessoir extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // Propriétés pour la recherche et les filtres
    public $search = '';
    public $filterStatut = '';
    public $filterType = '';
    public $filterEntite = '';
    
    // Propriétés pour les modals
    public $showSortieModal = false;
    public $showRetourModal = false;
    public $showHistoriqueModal = false;
    public $showDetailsModal = false;
    
    // Propriétés pour les sorties
    public $peripheriqueId;
    public $usager;
    public $entite;
    public $lieu;
    public $date_sortie;
    public $commentaire_sortie;
    
    // Propriétés pour les retours
    public $retourPeripheriqueId;
    public $date_retour;
    public $etat_retour = 'Bon';
    public $commentaire_retour;
    
    // Propriétés pour l'historique
    public $historiquePeripheriqueId;
    public $historique = [];
    
    // Sélection multiple
    public $selectedPeripheriques = [];
    public $selectAll = false;

    // Options
    public $statuts = ['En stock', 'En service', 'Hors service', 'En réparation'];
    public $types = ['Clavier', 'Souris', 'Webcam', 'Casque', 'Écran', 'Imprimante', 'Scanner'];
    public $etats = ['Bon', 'Usé', 'Défectueux', 'En réparation'];
    public $entites = [];

    protected $rules = [
        'peripheriqueId' => 'required|exists:peripheriques,id',
        'usager' => 'required|string|max:255',
        'entite' => 'required|string|max:255',
        'lieu' => 'required|string|max:255',
        'date_sortie' => 'required|date',
        'commentaire_sortie' => 'nullable|string|max:500',
    ];

    protected $retourRules = [
        'retourPeripheriqueId' => 'required|exists:peripheriques,id',
        'date_retour' => 'required|date',
        'etat_retour' => 'required|string|max:255',
        'commentaire_retour' => 'nullable|string|max:500',
    ];

    public function mount()
    {
        $this->date_sortie = now()->format('Y-m-d\TH:i');
        $this->date_retour = now()->format('Y-m-d\TH:i');
        $this->chargerEntites();
    }

    public function render()
    {
        $query = Peripherique::query()
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('nom', 'like', '%'.$this->search.'%')
                      ->orWhere('modele', 'like', '%'.$this->search.'%')
                      ->orWhere('fabricant', 'like', '%'.$this->search.'%')
                      ->orWhere('usager', 'like', '%'.$this->search.'%');
                });
            })
            ->when($this->filterStatut, function($query) {
                $query->where('statut', $this->filterStatut);
            })
            ->when($this->filterType, function($query) {
                $query->where('type', $this->filterType);
            })
            ->when($this->filterEntite, function($query) {
                $query->where('entite', 'like', '%'.$this->filterEntite.'%');
            })
            ->orderBy('statut')
            ->orderBy('nom');

        $peripheriques = $query->paginate(20);

        // Périphériques disponibles pour la sortie
        $peripheriquesEnStock = Peripherique::where('statut', 'En stock')->get();
        
        // Périphériques en service pour le retour
        $peripheriquesEnService = Peripherique::where('statut', 'En service')->get();

        return view('livewire.equipement.accessoir', [
            'peripheriques' => $peripheriques,
            'peripheriquesEnStock' => $peripheriquesEnStock,
            'peripheriquesEnService' => $peripheriquesEnService,
        ]);
    }

    /**
     * Ouvrir le modal de sortie
     */
    public function openSortieModal()
    {
        $this->resetSortieForm();
        $this->showSortieModal = true;
    }

    /**
     * Sortie rapide d'un périphérique
     */
    public function quickSortie($id)
    {
        $peripherique = Peripherique::findOrFail($id);
        
        if ($peripherique->statut !== 'En stock') {
            $this->dispatchBrowserEvent('show-alert', [
                'type' => 'error',
                'message' => 'Ce périphérique n\'est pas disponible pour sortie.'
            ]);
            return;
        }

        $this->peripheriqueId = $id;
        $this->entite = $peripherique->entite;
        $this->lieu = $peripherique->lieu;
        $this->date_sortie = now()->format('Y-m-d\TH:i');
        
        $this->showSortieModal = true;
    }

    /**
     * Enregistrer une sortie
     */
    public function enregistrerSortie()
    {
        $this->validate();

        DB::transaction(function () {
            $peripherique = Peripherique::findOrFail($this->peripheriqueId);
            
            // Créer l'historique de sortie
            HistoriqueSortie::create([
                'peripherique_id' => $this->peripheriqueId,
                'type_operation' => 'sortie',
                'usager' => $this->usager,
                'entite' => $this->entite,
                'lieu' => $this->lieu,
                'date_operation' => $this->date_sortie,
                'etat' => $peripherique->statut,
                'commentaire' => $this->commentaire_sortie,
            ]);

            // Mettre à jour le périphérique
            $peripherique->update([
                'statut' => 'En service',
                'usager' => $this->usager,
                'entite' => $this->entite,
                'lieu' => $this->lieu,
            ]);
        });

        $this->showSortieModal = false;
        $this->resetSortieForm();
        
        $this->dispatchBrowserEvent('show-alert', [
            'type' => 'success',
            'message' => 'Sortie enregistrée avec succès.'
        ]);
    }

    /**
     * Ouvrir le modal de retour
     */
    public function openRetourModal()
    {
        $this->resetRetourForm();
        $this->showRetourModal = true;
    }

    /**
     * Retour rapide d'un périphérique
     */
    public function quickRetour($id)
    {
        $peripherique = Peripherique::findOrFail($id);
        
        if ($peripherique->statut !== 'En service') {
            $this->dispatchBrowserEvent('show-alert', [
                'type' => 'error',
                'message' => 'Ce périphérique n\'est pas en service.'
            ]);
            return;
        }

        $this->retourPeripheriqueId = $id;
        $this->date_retour = now()->format('Y-m-d\TH:i');
        $this->showRetourModal = true;
    }

    /**
     * Enregistrer un retour
     */
    public function enregistrerRetour()
    {
        $this->validate($this->retourRules);

        DB::transaction(function () {
            $peripherique = Peripherique::findOrFail($this->retourPeripheriqueId);
            
            // Déterminer le nouveau statut
            $nouveauStatut = $this->etat_retour === 'Défectueux' ? 'Hors service' : 
                           ($this->etat_retour === 'En réparation' ? 'En réparation' : 'En stock');

            // Créer l'historique de retour
            HistoriqueSortie::create([
                'peripherique_id' => $this->retourPeripheriqueId,
                'type_operation' => 'retour',
                'usager' => $peripherique->usager,
                'entite' => $peripherique->entite,
                'lieu' => 'Stock',
                'date_operation' => $this->date_retour,
                'etat' => $this->etat_retour,
                'commentaire' => $this->commentaire_retour,
            ]);

            // Mettre à jour le périphérique
            $peripherique->update([
                'statut' => $nouveauStatut,
                'usager' => null,
                'entite' => null,
                'lieu' => 'Stock',
            ]);
        });

        $this->showRetourModal = false;
        $this->resetRetourForm();
        
        $this->dispatchBrowserEvent('show-alert', [
            'type' => 'success',
            'message' => 'Retour enregistré avec succès.'
        ]);
    }

    /**
     * Afficher l'historique d'un périphérique
     */
    public function showHistorique($id)
    {
        $this->historiquePeripheriqueId = $id;
        $this->historique = HistoriqueSortie::where('peripherique_id', $id)
            ->orderBy('date_operation', 'desc')
            ->get();
        $this->showHistoriqueModal = true;
    }

    /**
     * Afficher les détails d'un périphérique
     */
    public function showDetails($id)
    {
        $this->selectedPeripherique = Peripherique::find($id);
        $this->showDetailsModal = true;
    }

    /**
     * Fermer les modals
     */
    public function closeModals()
    {
        $this->showSortieModal = false;
        $this->showRetourModal = false;
        $this->showHistoriqueModal = false;
        $this->showDetailsModal = false;
        $this->resetSortieForm();
        $this->resetRetourForm();
    }

    /**
     * Réinitialiser le formulaire de sortie
     */
    private function resetSortieForm()
    {
        $this->reset([
            'peripheriqueId',
            'usager',
            'entite',
            'lieu',
            'commentaire_sortie'
        ]);
        $this->date_sortie = now()->format('Y-m-d\TH:i');
        $this->resetErrorBag();
    }

    /**
     * Réinitialiser le formulaire de retour
     */
    private function resetRetourForm()
    {
        $this->reset([
            'retourPeripheriqueId',
            'etat_retour',
            'commentaire_retour'
        ]);
        $this->date_retour = now()->format('Y-m-d\TH:i');
        $this->etat_retour = 'Bon';
        $this->resetErrorBag();
    }

    /**
     * Charger la liste des entités
     */
    private function chargerEntites()
    {
        $this->entites = Peripherique::whereNotNull('entite')
            ->distinct()
            ->pluck('entite')
            ->toArray();
    }

    /**
     * Réinitialiser les filtres
     */
    public function resetFilters()
    {
        $this->reset(['search', 'filterStatut', 'filterType', 'filterEntite']);
    }

    // Méthodes pour la pagination
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

    public function updatingFilterEntite()
    {
        $this->resetPage();
    }
}