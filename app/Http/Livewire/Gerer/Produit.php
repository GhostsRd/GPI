<?php

namespace App\Http\Livewire\Gerer;

use App\Models\Produit as modelproduit;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Produit extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $form = "";
    public $form1 = "";

    public $checkData = [];
    public $disabled = "disabled";
    public $total;
    public $nature;
    public $categorie;
    public $unite;
    public $taux_ristourne;

    public $recherche;  

    public function formAjout()
     {
         $this->form = "active";
     }

    public function mount(){
        $this->form;
        $this->form1;
    }
    public function exit(){
        return redirect('/produit');
     }
    public function create(modelproduit $produit){
       $produit->nature = $this->nature;
       $produit->categorie = $this->categorie;
       $produit->unite = $this->unite;
       $produit->taux_ristourne_par_unite = $this->taux_ristourne;
       $produit->save();

       return redirect('/produit')->with('notif',"Ajouté produit avec success");

    }

    public function deleteSelected(){
     
        modelproduit::query()
            ->where('id',$this->checkData)
            ->delete();

        $this->checkData = [];

        return redirect("/produit")
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
        return view('livewire.gerer.produit',[
            "produits"=> modelproduit::where("nature","like","%".$this->recherche."%")
        ->where("categorie","like","%".$this->recherche."%")
        ->Orwhere("unite","like","%".$this->recherche."%")
        ->Orwhere("taux_ristourne_par_unite","like","%".$this->recherche."%")
        ->paginate(8),
           ]);
    }
}
