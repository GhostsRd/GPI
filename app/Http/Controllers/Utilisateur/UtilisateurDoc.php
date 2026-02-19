<?php

namespace App\Http\Controllers\utilisateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UtilisateurDoc extends Controller
{
     public function index(){

        return view("utilisateur.utilisateur-doc");
    }
}
