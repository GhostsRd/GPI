<?php

namespace App\Http\Livewire\Acceuil;

use Livewire\Component;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Task;
use App\Models\Inventory;
use Illuminate\Support\Facades\Cache;

class Acceuil extends Component
{
    public $totalTickets;
    public $totalUsers;

    public $monthlyStats;
    public $taskDistribution;

    protected $listeners = ['refreshDashboard' => 'refreshData'];

    public function mount()
    {
        $this->refreshData();
    }

    public function refreshData()
    {
        // Cache les données pour de meilleures performances
        $this->totalTickets = Cache::remember('total_tickets', 300, function () {
            return Ticket::count();
        });

        $this->totalUsers = Cache::remember('total_users', 300, function () {
            return User::count();
        });

        $this->monthlyStats = Cache::remember('monthly_stats', 300, function () {
            return $this->getMonthlyStats();
        });


    }

    private function getMonthlyStats()
    {
        // Logique pour récupérer les statistiques mensuelles
        return [
            'labels' => ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
            'opened' => [120, 190, 130, 170, 150, 200, 180, 210, 190, 220, 240, 248],
            'resolved' => [80, 120, 100, 140, 110, 160, 130, 170, 150, 180, 200, 210]
        ];
    }

    private function getTaskDistribution()
    {
        // Logique pour récupérer la répartition des tâches
        return [
            'Agricole' => 35,
            'Pêche' => 25,
            'Forestier' => 20,
            'Élevage' => 15,
            'Autre' => 5
        ];
    }

    public function exportData()
    {
        // Logique d'exportation
        $this->dispatchBrowserEvent('notification', [
            'type' => 'success',
            'title' => 'Export réussi',
            'message' => 'Les données ont été exportées avec succès.'
        ]);
    }

    public function render()
    {
        return view('livewire.acceuil.acceuil');
    }
}
