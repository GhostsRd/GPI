<?php

namespace App\Http\Controllers\actus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Actus extends Controller
{
    public function index(){
        
        return view('actus.actus');
    }
}
