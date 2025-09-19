<?php

namespace App\Http\Controllers\gerer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class produit extends Controller
{
    public function index(){
        return view('gerer.produit');
    }
}
