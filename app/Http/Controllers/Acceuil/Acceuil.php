<?php

namespace App\Http\Controllers\Acceuil;

use App\Http\Controllers\Controller;
use App\Models\qrcode;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class Acceuil extends Controller
{
    public function index(){

        // dd($trans);
        return view("acceuil.acceuil");
    }

}

