<?php

namespace App\Http\Livewire\Admin\Sim;

use Livewire\Component;
use App\Models\SimCard;
use App\Models\SimHistory;
use App\Models\User;

class SimDashboard extends Component
{
    public function render()
    {
        $stats = [
            'total' => SimCard::count(),
            'available' => SimCard::available()->count(),
            'assigned' => SimCard::assigned()->count(),
            'lost' => SimCard::lost()->count(),
        ];

        $operatorStats = SimCard::select('operator', \DB::raw('count(*) as count'))
            ->groupBy('operator')
            ->get();

        $recentHistories = SimHistory::with(['simCard', 'user'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('livewire.admin.sim.sim-dashboard', [
            'stats' => $stats,
            'operatorStats' => $operatorStats,
            'recentHistories' => $recentHistories
        ]);
    }
}
