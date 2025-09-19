<?php

namespace App\Http\Livewire\Login;

use App\Mail\Momemail;
use App\Models\collecte;
use App\Models\collecteur;
use App\Models\Produit;
use App\Models\regisseur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Mail;

class Utilisateur extends Component
{   
    use WithFileUploads;
    
    public function sendEmail()
    {
        $details = [
            'title' => 'Test d\'envoi d\'e-mail',
            'body' => 'Ceci est un exemple d\'e-mail envoyé depuis Laravel.'
        ];
       

        Mail::to('leoncerado@gmail.com')->send(new Momemail($details));

        return "sended";
    }

    public function getproduit(){
        $dat = Produit::all();
       
        foreach($dat as $produit){
            $id = $produit->id;
            $categorie = $produit->categorie;
            $nature = $produit->nature;
            $unite = $produit->unite;
            $taux_ristourne = $produit->taux_ristourne;
        }
       
        return
        response()->json(
            $data = $dat,
        );
        
        //dd($da);
    }

    public function getCollecte(){
        $dat = collecte::where("id",8)->get();

        $produits =  Produit::where("id",9)->get();

        foreach ($produits as $produit){
            
            $nature = $produit->nature;

        }
        foreach($dat as $collecte){
            $date = $collecte->created_at;
            $quitance = $collecte->numero_quitance;
            $quantite = $collecte->quantite;


        }
       
        
        return response()->json([
            "success" => true,
            "statusCode" => 200,
            "data" => [
               
                [
                    "Produit" => ["nature" => "Produit B"],
                    "Collecteur" => ["nom" => "Marie Curie"],
                    "date_collecte" => "2025-01-02",
                    "numero_quittance" => "67890",
                    "quantite" => 30
                ]
            ]
        ],200); // Ajout du statusCode 200
        
        

        
    }
    public function collectes(Request $request,collecte $collecte){
      
        $collecteur =  collecteur::where("CIN",$request->cin_collecteur)->get();

        foreach ($collecteur as $collect){
            $id = $collect->id;
        }

        $produits =  Produit::where("id",$request->produit_id)->get();

        foreach ($produits as $produit){
            $taux = $produit->taux_ristourne_par_unite;
            $unite = $produit->unite;

        }

        $total = $taux * $request->quantite;

        $collecte->numero_quitance = $request->numero_quittance;
        $collecte->produit_id = $request->produit_id;
        $collecte->quantite = $request->quantite;
        $collecte->commune = $request->commune;
        $collecte->regisseur_id = 3;

        $collecte->collecteur_id = $id;
        $collecte->unite = $unite;
        $collecte->ristourne_calculee = $total;


        
        $collecte->save();

        return response()->json(["statusCode"=> "201",]);
    }
    public function login(Request $request){

        $req = regisseur::where("email",$request->email)->get();
        //email et password
        $userPassrecuperer = Hash::make($request->password);

        
        foreach($req as $re){
            $result = Hash::check($request->password, $re->mot_de_passe);
            if($result) {    
                return response()->json(["statusCode"=> "200","token"=> "kkjsdfselciusrbfui"]);
        }else{

            return response()->json(["statusCode"=> "404"]);
        }
    }
            
    }

    public function changeCode(Request $request){

        $req = regisseur::all();
        $code = $request->newPassword;
        $details = [
            'title' => 'Compte',
            'code' => 'Votre mot de passe  est modifier pour '.$code
        ];
      
        foreach($req as $re){
            if(Hash::check($request->oldPassword, $re->mot_de_passe)) {
               
                $requet = regisseur::find($re->id);
                
                $requet->update(["mot_de_passe"=> Hash::make($code)]);

                Mail::to($re->email)->send(new Momemail($details));

                return response()->json(["statusCode"=> "200","token"=> "kkjsdfselciusrbfui"]);
            }
        }
        return response()->json(["statusCode"=> "404"]);

        
    }

    public function render()
    {
        return view('livewire.login.utilisateur');
    }
}
