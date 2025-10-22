<?php

namespace App\Http\Livewire\Utilisateur\Checkout;

use Livewire\Component;
use App\Models\chat;
use Illuminate\Support\Facades\Auth;
use App\Models\Commentaire;
use App\Models\User;
use App\Models\ordinateur;
use App\Models\moniteur;
use \App\Models\Checkout as modelchekout;
use App\Models\ticket;
//use Livewire\WithPagination;


class Checkout extends Component
{
    //protected $paginationTheme = 'bootstrap';
    //use WithPagination;
    public $categorie = [];
    public $tickets;
    public $recherche;
    public $search = "";

    public $state;
    public $filteredMateriels = [];

    public $equipements = [];
    public $valeur1;
    public $valeur2;
    public $valeur3;
    public $valeur4;


    public $filtrerMateriel = "";

    public $selectedMateriels = [];
    public $etape = [
        1 => "active",
        2=> "remove",
        3=> "remove",
        4=> "remove",
        5=> "remove"
    ] ;

    public function visiterTicket()
    {
        return redirect("/utilisateur-service");
    }
    public function EnvoyerCheckout(modelchekout $checkout){
        $checkout->utilisateur_id = Auth::guard('utilisateur')->user()->id;
        $checkout->responsable_id = 1;
        $checkout->equipement_id = 1;
        $checkout->materiel_type = $this->valeur1;
        $checkout->statut = 1;
        $checkout->materiel_details = $this->valeur2;
        $checkout->save();
        
        for($i = 1; $i <=5 ; $i++){
            if($i == 1){
                $this->etape[$i] = "active";
            }else{

                $this->etape[$i] = "remove";
            }
        }
        $this->reset(['valeur1', 'valeur2']);
        $this->emitSelf('refreshComponent'); 
    }
    public function test(){
        dd($this->valeur1 , $this->valeur2 );
    }
    public function next_form($i){
        //$this->current  = $i;
       // dd($i);
       if($this->valeur1 == 'Telephone' && $i == 2){
           $i = 2;    
        }elseif($this->valeur1 == 'Peripherique' && $i == 2){
            $i = 4;
        }elseif($this->valeur1 == 'ordinateur' && $i == 2){
            $i = 5;
        }


         for($j = 1; $j <= 5; $j++){
            if($i == $j){
                $this->etape[$i] = "active";
            }else{
                $this->etape[$j] = "remove";
            }
        }
        $this->emitSelf('refreshComponent'); 
  
}


    public function mount()
    {   
        $this->etape;
        $this->valeur1 ;
        $this->recherche;
        $this->filtrerMateriel;
        $ordinateur = ordinateur::find(1);
        
        // dd(gettype($ordinateur->statut));

        // dd($this->state);
    }

        public function getFilteredEquipementsProperty()
    {
        if ($this->search == '') {
            return $this->equipements;
        }

        return $this->equipements->filter(function ($equip) {
            return str_contains(strtolower($equip['type']), strtolower($this->search));
        })->values(); // values() pour réindexer le tableau
    }

    public function render()
    {
        $user_ID = Auth::guard('utilisateur')->user()->id;
        
        return view('livewire.utilisateur.checkout.checkout', [
        
            'ordinateurs' => ordinateur::where("statut","En stock")->paginate(10),
            "moniteurs" => moniteur::where("statut", "En stock")->paginate(10),
            'equipements' => $this->filteredEquipements,
            "checkouts" => modelchekout::where("utilisateur_id",$user_ID)
            ->orderBy("created_at","desc")
            ->paginate(5),

        ]);
    }

}

