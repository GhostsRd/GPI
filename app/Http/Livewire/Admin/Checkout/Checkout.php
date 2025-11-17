<?php

namespace App\Http\Livewire\Admin\Checkout;

use Livewire\Component;
use App\Models\ticket;
use Livewire\WithPagination;
use App\Models\Checkout as CheckoutModel;
use App\Models\Utilisateur;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Checkout extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    // Propriétés pour les statistiques
    public $totalCheckouts;
    public $enCoursCheckouts;
    public $validerCheckouts;
    public $fermerCheckouts;
    
    // Propriétés pour la recherche et filtres
    public $search = "";
    public $statut = '';
    public $type_materiel = '';
    public $periode = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    
    // Propriétés pour la sélection multiple
    public $selectedCheckouts = [];
    public $selectAll = false;

    // Propriété pour stocker les checkouts
    public $checkouts;

    public function mount()
    {
        $this->calculerStatistiques();
        $this->loadCheckouts();
    }

    /**
     * Charger les checkouts
     */
    protected function loadCheckouts()
    {
        $query = CheckoutModel::with(['utilisateur']);

        // Application des filtres
        if ($this->search) {
            $query->where(function($q) {
                $q->where('id', 'like', '%'.$this->search.'%')
                  ->orWhere('materiel_type', 'like', '%'.$this->search.'%')
                  ->orWhere('materiel_details', 'like', '%'.$this->search.'%')
                  ->orWhereHas('utilisateur', function($q) {
                      $q->where('nom', 'like', '%'.$this->search.'%');
                  });
            });
        }

        if ($this->statut) {
            $query->where('statut', $this->statut);
        }

        if ($this->type_materiel) {
            $query->where('materiel_type', $this->type_materiel);
        }

        if ($this->periode) {
            $now = Carbon::now();
            switch ($this->periode) {
                case 'today':
                    $query->whereDate('created_at', $now->toDateString());
                    break;
                case 'week':
                    $query->whereBetween('created_at', [
                        $now->copy()->startOfWeek(), 
                        $now->copy()->endOfWeek()
                    ]);
                    break;
                case 'month':
                    $query->whereMonth('created_at', $now->month)
                          ->whereYear('created_at', $now->year);
                    break;
                case 'year':
                    $query->whereYear('created_at', $now->year);
                    break;
            }
        }

        $this->checkouts = $query->orderBy($this->sortField, $this->sortDirection)
                                ->paginate(10);
    }

    public function Visualiser($id)
    {
        return redirect("/admin/checkout-view-".$id);
    }

    /**
     * Calcul des statistiques
     */
    protected function calculerStatistiques()
    {
        $this->totalCheckouts = CheckoutModel::count();
        $this->enCoursCheckouts = CheckoutModel::where("statut", 1)->count();
        $this->validerCheckouts = CheckoutModel::where("statut", 2)->count();
        $this->fermerCheckouts = CheckoutModel::where("statut", 3)->count();
    }

    /**
     * Gestion du tri
     */
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
        $this->loadCheckouts();
    }

    /**
     * Sélection/désélection globale
     */
    public function updatedSelectAll($value)
    {
        if ($value && $this->checkouts) {
            $this->selectedCheckouts = $this->checkouts->pluck('id')->toArray();
        } else {
            $this->selectedCheckouts = [];
        }
    }

    /**
     * Réinitialisation des filtres
     */
    public function resetFilters()
    {
        $this->reset([
            'search', 
            'statut', 
            'type_materiel', 
            'periode', 
            'selectedCheckouts', 
            'selectAll',
            'sortField' => 'created_at',
            'sortDirection' => 'desc'
        ]);
        $this->loadCheckouts();
        $this->calculerStatistiques();
    }

    /**
     * Mise à jour des filtres
     */
    public function updated()
    {
        $this->loadCheckouts();
        $this->calculerStatistiques();
    }

    /**
     * Suppression multiple
     */
    public function deleteSelected()
    {
        if (!empty($this->selectedCheckouts)) {
            try {
                CheckoutModel::whereIn('id', $this->selectedCheckouts)->delete();
                $this->selectedCheckouts = [];
                $this->selectAll = false;
                $this->loadCheckouts();
                $this->calculerStatistiques();
                session()->flash('message', 'Checkouts supprimés avec succès.');
            } catch (\Exception $e) {
                session()->flash('error', 'Erreur lors de la suppression: ' . $e->getMessage());
            }
        }
    }

    /**
     * Confirmation de suppression
     */
    public function confirmDelete($id)
    {
        if (confirm('Êtes-vous sûr de vouloir supprimer ce checkout?')) {
            try {
                CheckoutModel::findOrFail($id)->delete();
                $this->loadCheckouts();
                $this->calculerStatistiques();
                session()->flash('message', 'Checkout supprimé avec succès!');
            } catch (\Exception $e) {
                session()->flash('error', 'Erreur lors de la suppression: ' . $e->getMessage());
            }
        }
    }

    /**
     * Édition d'un checkout
     */
    public function editCheckout($id)
    {
        return redirect("/admin/checkout-edit-".$id);
    }

    public function render()
    {
        // Recharger les données si nécessaire
        if (!$this->checkouts) {
            $this->loadCheckouts();
        }

        $tickets = ticket::orderBy("created_at","desc")->paginate(5);

        return view('livewire.admin.checkout.checkout',[
            "tickets" => $tickets,
            "checkouts" => $this->checkouts,
        ]);
    }
    
}