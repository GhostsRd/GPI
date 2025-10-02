<?php

namespace App\Http\Controllers\utilisateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UtilisateurLogin extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Auth guard spécifique
        if (Auth::guard('utilisateur')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/utilisateur');
        }

        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('utilisateur')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/utilisateur-login');
    }
    public function index(){

        return view("Utilisateur.utilisateur-login");
    }
}
