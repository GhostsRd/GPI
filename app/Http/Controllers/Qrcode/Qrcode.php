<?php

namespace App\Http\Controllers\Qrcode;

use App\Http\Controllers\Controller;
use App\Models\qrcode as ModelsQrcode;
use Illuminate\Http\Request;


class Qrcode extends Controller
{
    public function find($id){
        
        $results = ModelsQrcode::where('id',$id)->get();

        return view('qrcode.qrcode',compact("results"));
    }
}
