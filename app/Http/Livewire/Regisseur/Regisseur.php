<?php

namespace App\Http\Livewire\Regisseur;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\Momemail;
use App\Models\regisseur as ModelsRegisseur;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Regisseur extends Component
{

    public $checkData = [];
    public $disabled = "disabled";
    public $total;
    public $recherche;
    public $form;
    public $nom;
    public $prenom;
    public $email;
    public $password;






    public function formAjout()
     {
         $this->form = "active";
     }
     public function exit(){
        return redirect('/admin');
     }
    public function create(ModelsRegisseur $code){
    
       $code->nom = $this->nom;
       $code->prenom = $this->prenom;
       $code->email = $this->email;
       $code->mot_de_passe = Hash::make($this->password);
       $code->save();

       $details = [
        'title' => 'Compte',
        'code' => $this->nom.' votre mot de passe pour cette application est '.$this->password
    ];

         Mail::to($this->email)->send(new Momemail($details));

       return redirect('/regisseur')->with('notif',"ajouté avec success");

    }

    public function changeCode($id){

        $req = ModelsRegisseur::find($id);
        $code = rand(10000000,99999999);
        $details = [
            'title' => 'Compte',
            'code' => 'Votre mot de passe  est modifier pour '.$code
        ];
        
        $req->update([
            "mot_de_passe" => Hash::make($code),
        ]);
        
        Mail::to($req->email)->send(new Momemail($details));


        return redirect('/regisseur')->with('notif',"Email envoyer avec success");
    }
    public function deleteSelected(){
     
        ModelsRegisseur::query()
            ->where('id',$this->checkData)
            ->delete();

        $this->checkData = [];

        return redirect("/regisseur")
        ->with('notif',"Effacé avec succés");
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
        return view('livewire.regisseur.regisseur',[
            "users"=> ModelsRegisseur::where("email","like","%".$this->recherche."%")
        ->where("nom","like","%".$this->recherche."%")
        
        ->get(),
           ]);
    }
    
    
}
