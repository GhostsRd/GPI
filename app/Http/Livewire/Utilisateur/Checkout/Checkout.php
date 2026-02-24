<?php

namespace App\Http\Livewire\Utilisateur\Checkout;

use App\Models\checkoutreserver;
use App\Models\TelephoneTablette;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\ordinateur;
use App\Models\moniteur;
use App\Models\Checkout as modelchekout;
use App\Models\checkoutreserver as ReservationEquipement;

class Checkout extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    // Propriétés existantes
    public $categorie = [];
    public $tickets;
    public $recherche;
    public $search = "";
    public $type_materiel;
    public $state;
    public $filteredMateriels = [];
    public $filteredEquipements = [];
    public $filtrematreservation = "";
    public $equipements = [];
    public $valeur1;
    public $valeur2;
    public $valeur3;
    public $valeur4;
    public $selectcheckoutID;
    public $filtrerMateriel = "";
    public $events = [];
    public $selectedMateriels = [];
    public $selectedCheckouts;
    public $selectedEquipements;
    
    // Tableau des étapes
    public $etape = [
        1 => "active",
        2 => "remove",
        3 => "remove",
        4 => "remove",
        5 => "remove"
    ];
    
    // NOUVELLES PROPRIÉTÉS POUR L'HISTORIQUE ET LA SUPPRESSION
    public $historiqueFiltreStatut = '';
    public $historiqueSearch = '';
    public $itemToDelete = null;
    public $perPage = 10;
    
    // Mapping des statuts (chiffre -> libellé)
    protected $statutLabels = [
        1 => 'En cours',
        2 => 'Validé',
        3 => 'Reçu',
        4 => 'Rendu'
    ];
    
    protected $statutClasses = [
        1 => 'bg-warning text-dark',
        2 => 'bg-success text-white',
        3 => 'bg-info text-dark',
        4 => 'bg-secondary text-white'
    ];

    public function mount()
    {
        $this->etape;
        $this->valeur1;
        $this->recherche;
        $this->filtrerMateriel;
        $this->filtrematreservation;
        $this->selectedEquipements;
        $this->type_materiel;
        $this->selectcheckoutID;
        $this->selectedCheckouts;
    }

    /**
     * Obtient le libellé du statut à partir du chiffre
     */
    public function getStatutLabel($statut)
    {
        return $this->statutLabels[$statut] ?? 'Inconnu';
    }

    /**
     * Obtient la classe CSS du statut à partir du chiffre
     */
    public function getStatutBadgeClass($statut)
    {
        return $this->statutClasses[$statut] ?? 'bg-light text-dark';
    }

    /**
     * Visualiser les détails d'un checkout
     */
    public function visualisercheckout($id)
    {
        $this->selectcheckoutID = $id;
        $this->selectedCheckouts = modelchekout::with(['utilisateur', 'ordinateur', 'telephone'])
            ->findOrFail($this->selectcheckoutID);
    }

    /**
     * Ouvrir le calendrier
     */
    public function openCalendrier($type, $id)
    {
        return redirect()->to(route('checkout.calendrier', ['type' => $type, 'id' => $id]));
    }

    /**
     * Envoyer un nouveau checkout
     */
    public function EnvoyerCheckout(modelchekout $checkout)
    {
        $this->validate([
            'valeur1' => 'required',
            'valeur2' => 'required',
        ]);

        $checkout->utilisateur_id = Auth::guard('utilisateur')->user()->id;
        $checkout->responsable_id = 1;
        $checkout->equipement_id = 1;
        $checkout->materiel_type = $this->valeur1;
        $checkout->statut = 1; // En cours par défaut
        $checkout->materiel_details = $this->valeur2;
        $checkout->save();
        
        // Réinitialiser les étapes
        for ($i = 1; $i <= 5; $i++) {
            $this->etape[$i] = ($i == 1) ? "active" : "remove";
        }
        
        $this->reset(['valeur1', 'valeur2']);
        session()->flash('success', 'Checkout créé avec succès !');
        $this->dispatch('checkoutCreated');
    }

    /**
     * Gestion des étapes du formulaire
     */
    public function next_form($i)
    {
        if ($this->valeur1 == 'Telephone' && $i == 2) {
            $i = 2;
        } elseif ($this->valeur1 == 'Peripherique' && $i == 2) {
            $i = 4;
        } elseif ($this->valeur1 == 'ordinateur' && $i == 2) {
            $i = 5;
        }

        for ($j = 1; $j <= 5; $j++) {
            $this->etape[$j] = ($i == $j) ? "active" : "remove";
        }
    }

    /**
     * Ouvrir la confirmation de suppression
     */
    public function openDeleteConfirmation($id)
    {
        $this->itemToDelete = modelchekout::with(['utilisateur'])
            ->find($id);
        
        if ($this->itemToDelete) {
            $this->dispatch('openDeleteModal');
        }
    }

    /**
     * Confirmer la suppression
     */
    public function confirmDelete()
    {
        if ($this->itemToDelete) {
            try {
                // Vérification des permissions
                if ($this->itemToDelete->utilisateur_id != Auth::guard('utilisateur')->user()->id) {
                    session()->flash('error', 'Vous n\'êtes pas autorisé à supprimer ce checkout.');
                    $this->dispatch('closeDeleteModal');
                    return;
                }

                $this->itemToDelete->delete();
                session()->flash('success', 'Suppression effectuée avec succès.');
                $this->dispatch('itemDeleted');
                $this->resetPage();
                
            } catch (\Exception $e) {
                session()->flash('error', 'Erreur lors de la suppression');
            }
            $this->itemToDelete = null;
        }
        $this->dispatch('closeDeleteModal');
    }

    /**
     * Propriété calculée pour l'historique complet des checkouts
     */
    public function getHistoriqueCheckoutsProperty()
    {
        $user_ID = Auth::guard('utilisateur')->user()->id;
        
        return modelchekout::with(['utilisateur', 'responsable', 'ordinateur', 'telephone'])
            ->where('utilisateur_id', $user_ID)
            ->when($this->historiqueFiltreStatut !== '', function($query) {
                return $query->where('statut', $this->historiqueFiltreStatut);
            })
            ->when($this->historiqueSearch, function($query) {
                return $query->where(function($q) {
                    $q->where('materiel_type', 'like', '%' . $this->historiqueSearch . '%')
                      ->orWhere('materiel_details', 'like', '%' . $this->historiqueSearch . '%')
                      ->orWhere('id', 'like', '%' . $this->historiqueSearch . '%')
                      ->orWhereHas('ordinateur', function($subQ) {
                          $subQ->where('nom', 'like', '%' . $this->historiqueSearch . '%');
                      })
                      ->orWhereHas('telephone', function($subQ) {
                          $subQ->where('nom', 'like', '%' . $this->historiqueSearch . '%');
                      });
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);
    }

    /**
     * Visualiser une réservation
     */
    public function visualiser($id)
    {
        $reservations = ReservationEquipement::findOrFail($id);
        return redirect()->to(route('checkout.calendrier', [
            'type' => $reservations->equipement_type,
            'id' => $reservations->equipement_id
        ]));
    }

    /**
     * Réinitialiser les filtres
     */
    public function resetFilters()
    {
        $this->historiqueFiltreStatut = '';
        $this->historiqueSearch = '';
        $this->resetPage();
    }

    // Méthodes de cycle de vie Livewire
    public function updatedHistoriqueFiltreStatut()
    {
        $this->resetPage();
    }

    public function updatedHistoriqueSearch()
    {
        $this->resetPage();
    }

    protected function getListeners()
    {
        return [
            'refreshComponent' => '$refresh',
        ];
    }

    /**
     * Rendu du composant
     */
    public function render()
    {
        $user_ID = Auth::guard('utilisateur')->user()->id;
        
        return view('livewire.utilisateur.checkout.checkout', [
            'ordinateurs' => ordinateur::where('statut', '!=', 'Hors service')->paginate(100),
            'telephones' => TelephoneTablette::where('statut', '!=', 'Hors service')->paginate(100),
            'moniteurs' => moniteur::where('statut', '!=', 'Hors service')->paginate(10),
            'equipements' => $this->filteredEquipements,
            'checkouts' => modelchekout::where('utilisateur_id', $user_ID)
                ->orderBy('created_at', 'desc')
                ->paginate(105),
            'checkoutrecentes' => modelchekout::where('utilisateur_id', $user_ID)
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->get(),
            'matreservations' => ReservationEquipement::where('responsable_id', $user_ID)
                ->orderBy('id', 'desc')
                ->get(),
            'events' => ReservationEquipement::get(),
            'reservationRecentes' => ReservationEquipement::where('responsable_id', $user_ID)
                ->limit(3)
                ->get(),
            'historiqueCheckouts' => $this->historiqueCheckouts,
            'statutLabels' => $this->statutLabels,
            'statutClasses' => $this->statutClasses,
        ]);
    }
}