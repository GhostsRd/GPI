<?php

namespace App\Http\Livewire\Utilisateur;

use Livewire\Component;
use \App\Models\utilisateur;

class Utilisateurmembre extends Component
{
    public $recherche = "";
    public $nom, $email, $telephone, $adresse, $poste, $lieu_affectation,$form="";

    public function visualiser($id){
        $user = utilisateur::find($id);
        $this->nom = $user->nom;
        $this->email = $user->email;
        $this->telephone = $user->telephone;
        $this->adresse = $user->adresse;  
        $this->poste = $user->poste;
        $this->lieu_affectation = $user->lieu_affectation;  
        $this->form = "active";
    }
    public function closeform(){
        $this->form = "";
    }

    public function mount(){
        $this->nom;
        $this->email;
        $this->telephone;
        $this->adresse;
        $this->poste;
        $this->lieu_affectation;
        $this->form;;
        
    }
    public function render()
    {
        return view('livewire.utilisateur.utilisateurmembre',[
            "utilisateurs" => utilisateur::where('nom',"like","%".$this->recherche."%")->get()
        ]);
    }
}
