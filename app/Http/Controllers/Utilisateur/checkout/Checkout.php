<?php

namespace App\Http\Controllers\utilisateur\checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Checkout extends Controller
{
    public function index(){
        return view('Utilisateur.checkout.checkout');
    }
}
