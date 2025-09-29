<?php

namespace App\Http\Controllers\utilisateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
   public function index(){

        return view("Utilisateur.dashboard");
    }
}
