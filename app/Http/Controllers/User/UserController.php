<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('admin.users.dashboard');
    }

    public function getUserData()
    {
        // Statistiques principales
        $totalUsers = User::count();
        $activeUsers = User::where('is_active', true)->count();
        $inactiveUsers = User::where('is_active', false)->count();
        $adminUsers = User::where('role', 'admin')->count();

        // Données pour les graphiques
        $userActivity = $this->getUserActivityData();
        $roleDistribution = $this->getRoleDistributionData();
        $onlineStatus = $this->getOnlineStatusData();

        // Utilisateurs récents
        $recentUsers = User::with('lastLogin')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return response()->json([
            'statistics' => [
                'total' => $totalUsers,
                'active' => $activeUsers,
                'inactive' => $inactiveUsers,
                'admins' => $adminUsers,
            ],
            'charts' => [
                'activity' => $userActivity,
                'roles' => $roleDistribution,
                'status' => $onlineStatus,
            ],
            'recentUsers' => $recentUsers,
            'onlineUsers' => $this->getOnlineUsers(),
        ]);
    }

    private function getUserActivityData()
    {
        // Données des 7 derniers jours
        $dates = [];
        $newUsers = [];
        $logins = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $dates[] = now()->subDays($i)->format('D');

            $newUsers[] = User::whereDate('created_at', $date)->count();
            $logins[] = DB::table('login_activities')
                ->whereDate('login_at', $date)
                ->count();
        }

        return [
            'labels' => $dates,
            'new_users' => $newUsers,
            'logins' => $logins,
        ];
    }

    private function getRoleDistributionData()
    {
        $roles = User::select('role', DB::raw('count(*) as count'))
            ->groupBy('role')
            ->get();

        return [
            'labels' => $roles->pluck('role'),
            'data' => $roles->pluck('count'),
        ];
    }

    private function getOnlineStatusData()
    {
        $online = User::where('last_activity', '>=', now()->subMinutes(5))->count();
        $away = User::where('last_activity', '>=', now()->subMinutes(30))
            ->where('last_activity', '<', now()->subMinutes(5))
            ->count();
        $offline = User::where('last_activity', '<', now()->subMinutes(30))->count();

        return [
            'labels' => ['En ligne', 'Absent', 'Hors ligne'],
            'data' => [$online, $away, $offline],
        ];
    }

    private function getOnlineUsers()
    {
        return User::where('last_activity', '>=', now()->subMinutes(30))
            ->orderBy('last_activity', 'desc')
            ->limit(5)
            ->get();
    }

    public function getUsersList(Request $request)
    {
        $query = User::query();

        // Recherche
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // Filtre par statut
        if ($request->has('status') && $request->status) {
            $query->where('is_active', $request->status === 'active');
        }

        // Filtre par rôle
        if ($request->has('role') && $request->role) {
            $query->where('role', $request->role);
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10);

        return response()->json($users);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:user,admin,moderator',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
            'is_active' => $request->is_active ?? true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Utilisateur créé avec succès',
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:user,admin,moderator',
        ]);

        $user->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Utilisateur mis à jour avec succès'
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Utilisateur supprimé avec succès'
        ]);
    }
}
