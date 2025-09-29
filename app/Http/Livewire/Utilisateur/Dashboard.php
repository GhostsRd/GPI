<?php

namespace App\Http\Livewire\Utilisateur;

use Livewire\Component;
use App\Models\User as ModelsUser;

class Dashboard extends Component
{
    public function render()
    {
        $totalUsers = ModelsUser::count();
        $activeUsers = ModelsUser::where('status', 'active')->count();
        $inactiveUsers = ModelsUser::where('status', 'inactive')->count();
        $adminUsers = ModelsUser::where('role', 'admin')->count();
        $recentUsers = ModelsUser::orderBy('created_at', 'desc')->take(5)->get();

        return view('livewire.utilisateur.dashboard', [
            'totalUsers' => $totalUsers,
            'activeUsers' => $activeUsers,
            'inactiveUsers' => $inactiveUsers,
            'adminUsers' => $adminUsers,
            'recentUsers' => $recentUsers,
        ]);
    }
}
