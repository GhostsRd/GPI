<?php

namespace App\Http\Controllers\admin\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UtilisateurListe extends Controller
{
    public function index(){
        
        return view("admin.profile.utilisateur-liste");
    }
}
