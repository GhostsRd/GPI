<?php

namespace App\Http\Livewire\Admin\Checkout;

use App\Models\Checkout as CheckoutModel;
use Livewire\Component;
use App\Models\Commentaire;
use App\Models\ordinateur;
use App\Models\TelephoneTablette;
use Illuminate\Support\Facades\Auth;

class CheckoutView extends Component
{   
     public $checkoutId;
    public $currentStep;
     public $comments;
     public $selectedvalsdata;
     public $checkouts;
     public $selectEquipement;

     public $affichecommentaire = True;
     public $affichestep = False;


     public function afficheretape(){
        $this->affichestep = !$this->affichestep;

     }

      public function changercomment(){
        $this->affichecommentaire = !$this->affichecommentaire;

     }
  
    public $progress;
      public $current = [
        1 => 'current',
        2 => 'future',
        3 => 'future',
    ];

    public function validerequipement(){
        //dd($this->selectedvalsdata,$this->checkoutId);
        CheckoutModel::where('id', $this->checkoutId)->update([
            'equipement_id' => $this->selectedvalsdata,
        ]);

          $this->emitSelf('refreshComponent');
          return redirect('/admin/checkout-view-'.$this->checkoutId);
    }
     public function modelstep(CheckoutModel $checkout){
        $checkout = CheckoutModel::find($this->checkoutId);
        $this->currentStep = $checkout->statut;

        $this->current[$this->currentStep] = "current";
        $prog = $this->currentStep*20; 
        $progress = 'fill_'.$prog;
        $this->progress = $progress;

        if($this->currentStep == 3){
            for($i=1; $i<3; $i++){
                    $this->current[$i] = "past";
            }
        }else{
            for($i=1; $i<=3; $i++){
            if($i < $this->currentStep){
                $this->current[$i] = "past";
            }elseif($i == $this->currentStep){
                $this->current[$i] = "current";
            }else{
                $this->current[$i] = "future";
            }
        }

        }

       //$this->emitSelf('refreshComponent');
    }

    public function nextStep()
    {
        $this->modelstep(CheckoutModel::find($this->checkoutId));
        if($this->currentStep == 3){
            return;
        }elseif($this->currentStep < 3){
                CheckoutModel::where('id', $this->checkoutId)->update(['statut' => $this->currentStep + 1 ]);    
        }
       

    }

    public function previousStep()
        {
            if($this->currentStep == 1){
                return;
            }else{
                for($i=3; $i>=1; $i--){
                    if($this->current[$this->currentStep] == "current" && $i > 1){
                        $this->current[$this->currentStep] = "future";
                        $this->current[$this->currentStep-1] = "current";
                        $prog = ($i-1)*20; 
                        $progress = 'fill_'.$prog;
                        $this->progress = $progress;
                        break;
                    }
                    $this->emitSelf('refreshComponent');
            }
            }
            CheckoutModel::where('id', $this->checkoutId)->update(['statut' => $this->currentStep - 1]);
        // dd($this->current);
        }
     public function mount($id)
     {   
         $this->checkoutId = $id;
        $this->progress;
         $this->current;
         $this->selectEquipement;
         $this->checkouts = CheckoutModel::findOrFail($this->checkoutId);
       // $this->currentStep;
        $this->selectedvalsdata;
        $this->affichestep;

    }   

    public function destroyComment($id){
        Commentaire::destroy($id);
        
    }
    public function selectevals($vals){
        $this->selectedvalsdata = $vals;
    }
     public function postCommentaire(Commentaire $commentaire){
        if(!$this->comments){
          
        }else{

            $commentaire->checkout_id = $this->checkoutId;
            $commentaire->utilisateur_id = Auth::user()->id ;
            //$commentaire->responsable_id = Auth::user()->id ;

            $commentaire->etat = $this->currentStep;
            $commentaire->commentaire = $this->comments;
            $commentaire->save();

            $this->comments = "";
            $this->reset(['selectedvalsdata']);
            $this->emitSelf('refreshComponent');
            $this->emitTo('Utilisateur.utilisateur-ticket', 'refreshComponent');
        }

       // session()->flash('message','Commentaire ajouter avec succes');
      //  return redirect()->to('/admin-ticket-view/'.$this->ticketId);

    }
    public function render()
    {
         $this->modelstep(CheckoutModel::find($this->checkoutId));
        return view('livewire.admin.checkout.checkout-view',[
            "commentaires" => $this->checkouts
                ->commentaires()
                ->orderBy('created_at', 'desc')
                ->paginate(2),
            "TelephoneTablettes" => TelephoneTablette::where("type","like","%" . $this->selectEquipement . "%")->get(),
            "ordinateurs" => ordinateur::where("nom","like","%" . $this->selectEquipement . "%")->get(),

        ]);
    }
}
