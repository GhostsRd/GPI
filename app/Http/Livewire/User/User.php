<?php

namespace App\Http\Livewire\User;
use Livewire\WithPagination;
use App\Models\collecteur;
use App\Models\Produit;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;

class User extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $form = "";
    public $form1 = "";

     public  $nom;
     public  $prenom;
     public  $CIN;
     public $CIF;
     public $NIF;
     public $produit;
     public $RCS;
     public $adresse;

     public $modifier;



     public $STAT;
     public $photos;
     public $id_qr;
     public $form2;
     public $form3;


 




     public $checkData = [];
     public $disabled = "disabled";
     public $total;
     public $recherche;

     public function modifierForm($id){
        $this->modifier = "active";

       
        $this->id_qr = $id;
    }
    public function previsualiser2($id){
        $this->form2 = "active";

       
        $this->id_qr = $id;
    }

    public function previsualiserAdmin($id){
        $this->form3 = "active";

       
        $this->id_qr = $id;
    }
     public function formAjout()
     {
         $this->form = "active";
     }
    


     public function exit(){
        return redirect('/paramétre/user');
     }


     public function update(Request $request){
        //$id_receveur = collecteur::where('id',$request->id_rec)->get();
       
      
        
           //$val = collecteur::where('id',$request->id)->update([
           //     'montant'=> $request->montant + $cin_receveur,
            //]);
        
            $collecteur = collecteur::find($request->id);    
            //$url= $request->photos->store("image",'public');
            if($collecteur){

                $collecteur->nom = $request->nom;
                $collecteur->prenom = $request->prenom;
                $collecteur->CIF = $request->CIF;
                $collecteur->CIN = $request->CIN;
                $collecteur->NIF = $request->NIF;
                $collecteur->RCS = $request->RCS;
                $collecteur->STAT = $request->STAT;
                $collecteur->adresse = $request->adresse;
                $collecteur->produit = $request->produit;
                //$collecteur->url_img = $url;
                $collecteur->save();
                return redirect('/paramétre/user')->with('notif',"Modifier avec succes");
            }
            else{
                return redirect('/paramétre/user')->with('notif',"N'est pas trouver");
            }

        }
        
     public function recherche(Request $request){
        
        $resulats = collecteur::where("nom","like","%".$request->recherche."%")
        ->where("prenom","like","%".$request->recherche."%")
        ->Orwhere("nom","like","%".$request->recherche."%")
        ->Orwhere("CIN","like","%".$request->recherche."%")
        ->Orwhere("STAT","like","%".$request->recherche."%")

        ->get();
        if(is_null($resulats)){
            return response()->json([
                "resultats"=> null,
                "message"=> "donnés introuvable",
                "STATus"=> 404,
            ]);
        }
        else
        {
            return response()->json([
                "resultats"=> $resulats,
                "message"=> "donnés trouvé",
                "STATus"=> 404,
            ]);
        }
     }



     public function image(Request $request,collecteur $code){
        // $this->photos =$re

    $vals = collecteur::where('CIN',$request->CIN)->where('nom',$request->nom)->where('STAT',$request->STAT)->first();

     if(is_null($vals)){
        
         $url= $request->image->store("image",'public');
         $code->nom = $request->nom;
         $code->prenom = $request->prenom;
         $code->CIN = $request->CIN;
         $code->STAT = $request->STAT;
         $code->montant = 60000;
         $code->url_img = $url;
         $code->save();
    
    
         $id_iuser = collecteur::where('CIN',$request->CIN)->get();
    
         foreach($id_iuser as $id_user){
             $id_utilisateur = $id_user->id;
         }
    
         return response()->json([
             "messages " => "enregistre avec success",
             "url"=> "http://192.168.43.125:8000/find/".$id_utilisateur,
             "STATut " => 200,
    
    
         ]);
     }else{
        return response()->json([
            "messages " => "Donné déja enregistré",
            // "url"=> "http://192.168.43.125:8000/affiche_QR/".$id_utilisateur,
            "STATut " => 401,
   
   
        ]);
     }


     }
     public function create(collecteur $code){
         $url= $this->photos->store("image",'public');
        $code->nom = $this->nom;
        $code->prenom = $this->prenom;
        $code->CIF = $this->CIF;
        $code->CIN = $this->CIN;
        $code->NIF = $this->NIF;
        $code->RCS = $this->RCS;
        $code->STAT = $this->STAT;
        $code->adresse = $this->adresse;
        $code->produit = $this->produit;
        $code->url_img = $url;
        $code->save();

        return redirect('/paramétre/user')->with('notif',"ajouté avec success");

     }
     public function deleteSelected(){
     
        collecteur::query()
            ->where('id',$this->checkData)
            ->delete();

        $this->checkData = [];

        return redirect("/paramétre/user")
        ->with('notif',"Effacé avec succés");
    }   
    

    public function mount(){
        $this->form;
        $this->form1;
        $this->form2;
        $this->form3;

        $this->id_qr;


    }
    public function render()
    {
        if(count($this->checkData) > 0){
            $this->disabled = "";
            $this->total = count($this->checkData);
        }else
        {
             $this->disabled = "disabled";
        }
        return view('livewire.user.user',
    [
        "qrusers"=> collecteur::where("nom","like","%".$this->recherche."%")
        ->where("prenom","like","%".$this->recherche."%")
        ->Orwhere("adresse","like","%".$this->recherche."%")
        ->Orwhere("CIN","like","%".$this->recherche."%")
        ->Orwhere("STAT","like","%".$this->recherche."%")

        ->paginate(7),
        "produits"=> Produit::all(),
    ]);
    }
}
