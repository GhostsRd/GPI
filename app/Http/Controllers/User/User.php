<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\collecteur;
use App\Models\qrcode;
use App\Models\Transaction;
use App\Models\User as ModelsUser;
use Illuminate\Http\Request;

class User extends Controller
{
    public function index(){
        return view('User.user');
    }

    public function dashboard(){
        // Récupérer les statistiques
        $totalUsers = ModelsUser::count();
        $activeUsers = ModelsUser::where('status', 'active')->count();
        $inactiveUsers = ModelsUser::where('status', 'inactive')->count();
        $adminUsers = ModelsUser::where('role', 'admin')->count();

        // Récupérer les utilisateurs récents
        $recentUsers = ModelsUser::orderBy('created_at', 'desc')->take(5)->get();

        return view('User.dashboard', [
            'totalUsers' => $totalUsers,
            'activeUsers' => $activeUsers,
            'inactiveUsers' => $inactiveUsers,
            'adminUsers' => $adminUsers,
            'recentUsers' => $recentUsers,
        ]);
    }

    public function utilisateur()
    {
        // Récupérer les données pour le dashboard regisseur
        $totalUsers = ModelsUser::count();
        $activeUsers = ModelsUser::where('status', 'active')->count();
        $inactiveUsers = ModelsUser::where('status', 'inactive')->count();
        $adminUsers = ModelsUser::where('role', 'admin')->count();
        $recentUsers = ModelsUser::orderBy('created_at', 'desc')->take(5)->get();

        return view('livewire.utilisateur', [
            'totalUsers' => $totalUsers,
            'activeUsers' => $activeUsers,
            'inactiveUsers' => $inactiveUsers,
            'adminUsers' => $adminUsers,
            'recentUsers' => $recentUsers,
        ]);
    }

    public function store(Request $request, ModelsUser $users){
        return response()->json([
            "users" => "ok",
            "status"=> 200,
        ]);
    }

    public function finding($id){
        return view('transfer.transfer',[
            'id_receveurs' => qrcode::where('id',$id)->get(),
        ]);
    }

    public function retrait($id){
        return view('transfer.retrait',[
            'id_receveurs' => qrcode::where('id',$id)->get(),
        ]);
    }
}
