<?php

namespace App\Http\Controllers\equipement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class imprimante extends Controller
{
    public function index(){
        return view('equipement.materiel-reseau');
    }
}
