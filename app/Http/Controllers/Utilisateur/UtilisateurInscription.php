<?php

namespace App\Http\Controllers\utilisateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UtilisateurInscription extends Controller
{
    public function index(){
        return view('Utilisateur.utilisateur-inscription');
    }
}
