<?php

namespace App\Http\Controllers\utilisateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UtilisateurTicket extends Controller
{
    public function index($id)
    {
        return view('Utilisateur.utilisateur-ticket',compact("id"));
    }
}
