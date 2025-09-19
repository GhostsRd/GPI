<?php

namespace App\Http\Livewire\Qrcode;

use App\Models\qrcode as ModelsQrcode;
use Livewire\Component;
use Milon\Barcode\Facades\DNS2D;

class Qrcode extends Component
{


    
    public function find($id){
        
        $results = ModelsQrcode::where('id',$id)->get();

        return view('qrcode.qrcode',compact("results"));
    }
    public function render()

    {
        $results = ModelsQrcode::where('id',5)->get();
        return view('qrcode.qrcode',compact("results"));
        
        
}
}
