<?php

namespace App\Http\Livewire\Admin\Profile;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\DB;

class UtilisateurListe extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $departementFilter = '';
    public $lieuFilter = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $selectedUsers = [];
    public $selectAll = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'departementFilter' => ['except' => ''],
        'lieuFilter' => ['except' => ''],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function getStatsProperty()
    {
        return [
            'total' => Utilisateur::count(),
            'actifs' => Utilisateur::count(), // Supprimé la condition sur statut qui n'existe pas
            'departements' => Utilisateur::distinct('departement')->count('departement'),
            'lieux' => Utilisateur::distinct('lieu_affectation')->count('lieu_affectation'),
        ];
    }

    public function getDepartementsProperty()
    {
        return Utilisateur::distinct()
            ->whereNotNull('departement')
            ->where('departement', '!=', '')
            ->pluck('departement')
            ->toArray();
    }

    public function getLieuxAffectationProperty()
    {
        return Utilisateur::distinct()
            ->whereNotNull('lieu_affectation')
            ->where('lieu_affectation', '!=', '')
            ->pluck('lieu_affectation')
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
            $this->selectedUsers = $this->utilisateurs->pluck('id')->toArray();
        } else {
            $this->selectedUsers = [];
        }
    }

    public function updatedSelectedUsers()
    {
        $this->selectAll = false;
    }

    public function deleteSelected()
    {
        if (!empty($this->selectedUsers)) {
            Utilisateur::whereIn('id', $this->selectedUsers)->delete();
            $this->selectedUsers = [];
            $this->selectAll = false;
            $this->dispatchBrowserEvent('show-toast', [
                'type' => 'success',
                'message' => 'Utilisateurs sélectionnés supprimés avec succès.'
            ]);
        }
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->departementFilter = '';
        $this->lieuFilter = '';
        $this->sortField = 'created_at';
        $this->sortDirection = 'desc';
        $this->selectedUsers = [];
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

    public function deleteUser($id)
    {
        Utilisateur::destroy($id);
        $this->dispatchBrowserEvent('show-toast', [
            'type' => 'success',
            'message' => 'Utilisateur supprimé avec succès.'
        ]);
    }

    public function Visualiser($id)
    {
        return redirect()->route("userprofile", ["id" => $id]);
    }

    public function getUtilisateursProperty()
    {
        return Utilisateur::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('nom', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('poste', 'like', '%' . $this->search . '%')
                      ->orWhere('departement', 'like', '%' . $this->search . '%')
                      ->orWhere('lieu_affectation', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->departementFilter, function ($query) {
                $query->where('departement', $this->departementFilter);
            })
            ->when($this->lieuFilter, function ($query) {
                $query->where('lieu_affectation', $this->lieuFilter);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.admin.profile.utilisateur-liste', [
            'utilisateurs' => $this->utilisateurs,
        ]);
    }
}