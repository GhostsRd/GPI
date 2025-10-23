<?php

namespace App\Http\Controllers\Acceuil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Acceuil extends Controller
{
    //
      public function index(){

        return view("acceuil.acceuil");
    }
}

