<?php

namespace App\Http\Controllers\Regisseur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Regisseur extends Controller
{
    public function index(){

        return view("regisseur.regisseur");
    }



}
