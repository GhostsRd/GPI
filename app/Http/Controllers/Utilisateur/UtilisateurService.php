<?php

namespace App\Http\Controllers\utilisateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UtilisateurService extends Controller
{
    public function index(){

        return view("Utilisateur.utilisateur-service");
    }
}
