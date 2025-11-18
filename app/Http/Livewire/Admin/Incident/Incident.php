<?php

namespace App\Http\Livewire\Admin\Incident;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Incident as IncidentModel;
use Illuminate\Support\Facades\DB;

class Incident extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshComponent' => '$refresh'];
    
    public $search = '';
    public $statutFilter = '';
    public $typeMateriel = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $selectedTickets = [];
    public $selectAll = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'statutFilter' => ['except' => ''],
        'typeMateriel' => ['except' => ''],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function getStatsProperty()
    {
        return [
            'total' => IncidentModel::count(),
            'en_cours' => IncidentModel::where('statut', 1)->count(),
            'en_traitement' => IncidentModel::where('statut', 2)->count(),
            'demande_annulation' => IncidentModel::where('statut', 0)->count(),
        ];
    }

    public function getTypesMaterielProperty()
    {
        return IncidentModel::distinct()
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
            $this->selectedTickets = $this->incidents->pluck('id')->toArray();
        } else {
            $this->selectedTickets = [];
        }
    }

    public function updatedSelectedTickets()
    {
        $this->selectAll = false;
    }

    public function deleteSelected()
    {
        if (!empty($this->selectedTickets)) {
            IncidentModel::whereIn('id', $this->selectedTickets)->delete();
            $this->selectedTickets = [];
            $this->selectAll = false;
            $this->dispatchBrowserEvent('show-toast', [
                'type' => 'success',
                'message' => 'Incidents sélectionnés supprimés avec succès.'
            ]);
        }
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->statutFilter = '';
        $this->typeMateriel = '';
        $this->sortField = 'created_at';
        $this->sortDirection = 'desc';
        $this->selectedTickets = [];
        $this->selectAll = false;
    }

    public function exportIncidents()
    {
        // Implémentez l'exportation selon vos besoins
        $this->dispatchBrowserEvent('show-toast', [
            'type' => 'info',
            'message' => 'Fonction d\'export à implémenter.'
        ]);
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

    public function SupprimerDemande($id)
    {
        $incident = IncidentModel::destroy($id);
        $this->emit("refreshComponent");
        $this->dispatchBrowserEvent('show-toast', [
            'type' => 'success',
            'message' => 'Incident supprimé avec succès.'
        ]);
    }

    public function Visualiser($id)
    {
        return redirect()->route("admin.incident.view", ["id" => $id]);
    }

    public function getIncidentsProperty()
    {
        return IncidentModel::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('id', 'like', '%' . $this->search . '%')
                      ->orWhereHas('utilisateur', function ($q) {
                          $q->where('nom', 'like', '%' . $this->search . '%');
                      });
                });
            })
            ->when($this->statutFilter !== '', function ($query) {
                $query->where('statut', $this->statutFilter);
            })
            ->when($this->typeMateriel, function ($query) {
                $query->where('equipement_type', $this->typeMateriel);
            })
            ->with(['utilisateur', 'ordinateur', 'telephone'])
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.admin.incident.incident', [
            'incidents' => $this->incidents,
        ]);
    }
}