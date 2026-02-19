<?php

namespace App\Http\Livewire;


use App\Models\ticket;
use App\Models\Equipement;
use App\Models\Incident;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{


    public $totalTickets;
    public $totalIncidents;
    public $totalEquipments;
    public $totalUsers;

    public $ticketStatusData;
    public $monthlyTicketsData;
    
    public $equipmentChartData;
    public $equipmentStatusData;
    
    public $incidentsChartData;
    public $incidentTrendData;
    
    public $incidentsByPriority;
    public $incidentsByType;

    public $recentEquipments;

    public function mount()
    {
        $this->loadStats();
        $this->loadCharts();
        $this->loadRecentEquipments();
    }

    public function loadStats()
    {
        $this->totalTickets = ticket::count();
        $this->totalIncidents = Incident::count();
        $this->totalEquipments = Equipement::count();
        $this->totalUsers = \App\Models\User::count();
    }

    public function loadCharts()
    {
        // 1. Tickets par statut
        $this->ticketStatusData = ticket::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // 2. Tickets mensuels (6 derniers mois)
        $this->monthlyTicketsData = ticket::select(
                DB::raw('count(*) as count'), 
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month")
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // 3. Équipements par type
        $this->equipmentChartData = Equipement::select('type', DB::raw('count(*) as count'))
            ->groupBy('type')
            ->pluck('count', 'type')
            ->toArray();

        // 4. Statut des équipements
        $this->equipmentStatusData = Equipement::select('statut', DB::raw('count(*) as count'))
            ->groupBy('statut')
            ->pluck('count', 'statut')
            ->toArray();

        // 5. Statut des incidents
        $this->incidentsChartData = Incident::select('statut', DB::raw('count(*) as count'))
            ->groupBy('statut')
            ->pluck('count', 'statut')
            ->toArray();

        // 6. Tendance des incidents (6 derniers mois)
        $data = Incident::select(
                DB::raw('count(*) as count'), 
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month")
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();
            
        $this->incidentTrendData = [
            'labels' => $data->pluck('month')->toArray(),
            'data' => $data->pluck('count')->toArray()
        ];

        // 7. Incidents par priorité
        $this->incidentsByPriority = []; 
        
        // 8. Incidents par type (Nature)
        $this->incidentsByType = Incident::select('incident_nature', DB::raw('count(*) as count'))
            ->groupBy('incident_nature')
            ->pluck('count', 'incident_nature')
            ->toArray();
    }

    public function loadRecentEquipments()
    {
        $this->recentEquipments = Equipement::latest()
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
