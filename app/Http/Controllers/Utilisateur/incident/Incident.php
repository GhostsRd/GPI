<?php

namespace App\Http\Controllers\utilisateur\incident;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Incident extends Controller
{
    public function index(){
        return view("Utilisateur.incident.incident");
    }
}
