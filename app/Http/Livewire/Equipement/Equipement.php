<?php

namespace App\Http\Livewire\Equipement;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Equipement as EquipementModel;

class Equipement extends Component
{
    use WithPagination;

    public $search = '';
    public $statut = '';
    public $type = '';
    public $emplacement = '';
    public $marque = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'statut' => ['except' => ''],
        'type' => ['except' => ''],
        'emplacement' => ['except' => ''],
        'marque' => ['except' => ''],
    ];

    public function render()
    {
        // Statistiques
        $stats = [
            'total' => EquipementModel::count(),
            'en_stock' => EquipementModel::where('statut', 'en_stock')->count(),
            'en_pret' => EquipementModel::where('statut', 'en_pret')->count(),
            'en_maintenance' => EquipementModel::where('statut', 'en_maintenance')->count(),
        ];

        // Données pour les filtres
        $types = EquipementModel::distinct()->pluck('type')->filter();
        $emplacements = EquipementModel::distinct()->pluck('emplacement')->filter();
        $marques = EquipementModel::distinct()->pluck('marque')->filter();

        // Équipements filtrés
        $equipements = EquipementModel::when($this->search, function ($query) {
            $query->where(function ($q) {
                $q->where('identification', 'like', '%' . $this->search . '%')
                    ->orWhere('nom_public', 'like', '%' . $this->search . '%')
                    ->orWhere('numero_serie', 'like', '%' . $this->search . '%')
                    ->orWhere('adresse_ip', 'like', '%' . $this->search . '%');
            });
        })
            ->when($this->statut, fn($query) => $query->where('statut', $this->statut))
            ->when($this->type, fn($query) => $query->where('type', $this->type))
            ->when($this->emplacement, fn($query) => $query->where('emplacement', $this->emplacement))
            ->when($this->marque, fn($query) => $query->where('marque', $this->marque))
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.equipement.equipement', compact(
            'stats',
            'equipements',
            'types',
            'emplacements',
            'marques'
        ));
    }

    public function updatingSearch() { $this->resetPage(); }
    public function updatingStatut() { $this->resetPage(); }
    public function updatingType() { $this->resetPage(); }
    public function updatingEmplacement() { $this->resetPage(); }
    public function updatingMarque() { $this->resetPage(); }
}
