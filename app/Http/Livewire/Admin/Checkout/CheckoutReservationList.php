<?php

namespace App\Http\Livewire\Admin\Checkout;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CheckoutReserver as MatReservation;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Auth;

class CheckoutReservationList extends Component
{
    use WithPagination;

    protected $listeners = ['refreshComponent' => '$refresh'];
    
    public $search = '';
    public $typeFilter = '';
    public $statutFilter = '';
    public $periodeFilter = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $selectedReservations = [];
    public $selectAll = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'typeFilter' => ['except' => ''],
        'statutFilter' => ['except' => ''],
        'periodeFilter' => ['except' => ''],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function getStatsProperty()
    {
        $total = MatReservation::count();
        $enCours = MatReservation::where('statut', 3)->count();
        $avenir = MatReservation::where('date_debut', '>', now())->count();
        $termines = MatReservation::whereIn('statut', [4, 5])->count();

        return [
            'total' => $total,
            'en_cours' => $enCours,
            'a_venir' => $avenir,
            'termines' => $termines,
        ];
    }

    public function getTypesMaterielProperty()
    {
        return MatReservation::distinct()
            ->whereNotNull('equipement_type')
            ->pluck('equipement_type')
            ->toArray();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedReservations = $this->matreservations->pluck('id')->toArray();
        } else {
            $this->selectedReservations = [];
        }
    }

    public function updatedSelectedReservations()
    {
        $this->selectAll = false;
    }

    public function deleteSelected()
    {
        if (!empty($this->selectedReservations)) {
            MatReservation::whereIn('id', $this->selectedReservations)->delete();
            $this->selectedReservations = [];
            $this->selectAll = false;
            $this->dispatchBrowserEvent('show-toast', [
                'type' => 'success',
                'message' => 'Réservations sélectionnées supprimées avec succès.'
            ]);
        }
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->typeFilter = '';
        $this->statutFilter = '';
        $this->periodeFilter = '';
        $this->sortField = 'created_at';
        $this->sortDirection = 'desc';
        $this->selectedReservations = [];
        $this->selectAll = false;
    }

    public function confirmDelete($id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Êtes-vous sûr?',
            'text' => 'Vous ne pourrez pas revenir en arrière!',
            'id' => $id
        ]);
    }

    public function deleteReservation($id)
    {
        MatReservation::destroy($id);
        $this->dispatchBrowserEvent('show-toast', [
            'type' => 'success',
            'message' => 'Réservation supprimée avec succès.'
        ]);
    }

    public function changerVue()
    {
        return redirect('/admin/checkout-reservation');
    }

    public function Visualiser($id)
    {
        return redirect('/admin/checkout-reservation-view-' . $id);
    }

    public function supprimerDemande($id)
    {
        MatReservation::destroy($id);
        $this->emit('refreshComponent');
        $this->dispatchBrowserEvent('show-toast', [
            'type' => 'success',
            'message' => 'Demande supprimée avec succès.'
        ]);
    }

    public function getMatreservationsProperty()
    {
        return MatReservation::query()
            ->with(['responsable'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->whereHas('responsable', function ($q) {
                        $q->where('nom', 'like', '%' . $this->search . '%');
                    })
                    ->orWhere('equipement_type', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->typeFilter, function ($query) {
                $query->where('equipement_type', $this->typeFilter);
            })
            ->when($this->statutFilter !== '', function ($query) {
                $query->where('statut', $this->statutFilter);
            })
            ->when($this->periodeFilter, function ($query) {
                match($this->periodeFilter) {
                    'today' => $query->whereDate('date_debut', today()),
                    'week' => $query->whereBetween('date_debut', [now()->startOfWeek(), now()->endOfWeek()]),
                    'month' => $query->whereBetween('date_debut', [now()->startOfMonth(), now()->endOfMonth()]),
                    'future' => $query->where('date_debut', '>', now()),
                    'past' => $query->where('date_fin', '<', now()),
                    default => $query
                };
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.admin.checkout.checkout-reservation-list', [
            'matreservations' => $this->matreservations,
        ]);
    }
}