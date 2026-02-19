<?php

namespace App\Http\Controllers\Utilisateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Utilisateur extends Controller
{
       public function index(){

        return view("Utilisateur.DocumentView");
    }
}
