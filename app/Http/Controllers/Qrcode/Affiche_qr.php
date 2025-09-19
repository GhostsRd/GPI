<?php

namespace App\Http\Controllers\qrcode;

use App\Http\Controllers\Controller;
use App\Models\qrcode;
use Illuminate\Http\Request;

class Affiche_qr extends Controller
{
    
    public function find($id){
        
        $results = qrcode::where('id',$id)->get();

        return view('qrcode.afficher_qr',compact("results"));
    }
}
