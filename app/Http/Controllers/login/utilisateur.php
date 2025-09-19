<?php

namespace App\Http\Controllers\login;

use App\Http\Controllers\Controller;
use App\Models\qrcode;
use App\Models\Transaction;
use Illuminate\Http\Request;

class utilisateur extends Controller
{
    public function index(){
        return view('login.utilisateur');
    }

    public function verification(Request $request){

        $valeur = qrcode::where("nom",$request->nom)
        ->Orwhere('prenom',$request->prenom)
        ->where('tel',$request->tel)
        ->get();
        // dd($valeur);
        foreach($valeur as $val){
            $identifiant = $val->id;
        }
        if(isset($identifiant)){
            return view('login.home',[
                "valeurs"=>$valeur,
                "users"=> qrcode::all(),
                "transactions" => Transaction::where('sendeur',$identifiant)
                ->Orwhere('receveur',$identifiant)->get(),
            ]);
        }else{
          
            return view('login.utilisateur');
            // return redirect("/login/utilisateur");
        }
    }
}
