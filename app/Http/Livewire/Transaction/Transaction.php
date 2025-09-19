<?php

namespace App\Http\Livewire\Transaction;

use App\Models\collecte;
use Livewire\WithPagination;
use App\Models\collecteur;
use App\Models\Produit;
use App\Models\regisseur;
use App\Models\User;
use Livewire\Component;

class Transaction extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $checkData = [];
    public $result = [];

    public $disabled = "disabled";
    public $total;
    public $recherche;
    public $selectoption;

    public function listparregisseur(){

        $regisseurs = regisseur::where("nom",$this->selectoption)->get();
        foreach($regisseurs as $regisseur){
        }
        return view('livewire.transaction.transaction',
        [   
            "transactions"=> collecte::
                 where("regisseur_id",$this->selectoption)
                 ->orderby("updated_at",'desc')
                 ->paginate(15),
            "collectes"=> collecte::all(),
            "collecteurs" => collecteur::all(),
            "regisseurs" => regisseur::all(),
            "produits" => Produit::all(),
        ]);
    }
    public function deleteSelected(){
     
        collecte::query()
            ->where('id',$this->checkData)
            ->delete();

        $this->checkData = [];

        return redirect("/history/transaction")
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

     


        return view('livewire.transaction.transaction',



    [   
        "transactions"=> collecte::
             where("commune","like","%".$this->recherche."%")
            
             ->orderby("updated_at",'desc')
             ->paginate(15),
        "collectes"=> collecte::all(),
        "collecteurs" => collecteur::all(),
        "regisseurs" => User::all(),
        "produits" => Produit::all(),


    ]);
}
}
