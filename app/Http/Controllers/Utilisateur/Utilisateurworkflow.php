<?php

namespace App\Http\Controllers\utilisateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Utilisateurworkflow extends Controller
{
    public function index(){
        return view('utilisateur.utilisateur-workflow');
    }
}
