<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Contact extends Controller
{
    
    public function index(){
        return view("contact");
    }
}
