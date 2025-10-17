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
        }


         for($j = 1; $j <= 5; $j++){
            if($i == $j){
                $this->etape[$i] = "active";
            }else{
                $this->etape[$j] = "remove";
            }
        }
       

            
  
}


    public function mount()
    {   
        $this->etape;
        $this->valeur1 ;
        $this->recherche;
        $this->filtrerMateriel;
        $ordinateur = ordinateur::find(1);
         $this->equipements = collect([
            ['id' => 1, 'type' => 'Ordinateur portable', 'statut' => 'En stock'],
            ['id' => 2, 'type' => 'Ordinateur de bureau', 'statut' => 'En stock'],
            ['id' => 3, 'type' => 'Moniteur', 'statut' => 'En stock'],
            ['id' => 4, 'type' => 'Clavier', 'statut' => 'En stock'],
            ['id' => 5, 'type' => 'Souris', 'statut' => 'En stock'],
            ['id' => 6, 'type' => 'Périphérique USB', 'statut' => 'En stock'],
            ['id' => 7, 'type' => 'Bluetooth', 'statut' => 'En stock'],
            ['id' => 8, 'type' => 'Dongle', 'statut' => 'En stock'],
            ['id' => 9, 'type' => 'Casque filaire', 'statut' => 'En stock'],
            ['id' => 10, 'type' => 'Casque sans fil', 'statut' => 'En stock'],
            ['id' => 11, 'type' => 'Microphone', 'statut' => 'En stock'],
            ['id' => 12, 'type' => 'Jabra', 'statut' => 'En stock'],
            ['id' => 13, 'type' => 'Projecteur', 'statut' => 'En stock'],
            ['id' => 14, 'type' => 'Chargeur', 'statut' => 'En stock'],
            ['id' => 15, 'type' => 'Adaptateur', 'statut' => 'En stock'],
            ['id' => 16, 'type' => 'Imprimante', 'statut' => 'En stock'],
            ['id' => 17, 'type' => 'Scanner', 'statut' => 'En stock'],
            ['id' => 18, 'type' => 'Tablette', 'statut' => 'En stock'],
            ['id' => 19, 'type' => 'Téléphone mobile', 'statut' => 'En stock'],
            ['id' => 20, 'type' => 'Câble USB Type-C', 'statut' => 'En stock'],
            ['id' => 21, 'type' => 'Câble Lightning (iPhone)', 'statut' => 'En stock'],
            ['id' => 22, 'type' => 'Câble HDMI', 'statut' => 'En stock'],
            ['id' => 23, 'type' => 'Câble USB-A', 'statut' => 'En stock'],
            ['id' => 24, 'type' => 'Câble audio jack 3.5mm', 'statut' => 'En stock'],
        ]);
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

