<?php

namespace App\Http\Livewire\Admin\Checkout;

use Livewire\Component;
use App\Models\checkoutreserver as matreservation;
use App\Models\chat;
use App\Models\Checkout as CheckoutModel;
use App\Models\utilisateur;
use App\Models\Commentaire;
use App\Models\ordinateur;
use App\Models\TelephoneTablette;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Momemail;
class CheckoutReservationList extends Component
{
    public $checkoutId;
     public $message;
    public $currentStep;
     public $comments;
     public $selectedvalsdata;
     public $checkouts;
     public $selectEquipement;
     public $materiel_type;

     public $progress;
      public $current = [
        1 => 'current',
        2 => 'future',
        3 => 'future',
        4 => 'future',

    ];
     public $affichecommentaire = True;
     public $affichestep = False;
   
    public function changerVue(){
        return redirect('/admin/checkout-reservation');
    }
    public function Visualiser($id){
    return redirect('/admin/checkout-reservation-view-'. $id);
  }
    public function mount(){
     

    }
    public function render()
    {

    

        return view('livewire.admin.checkout.checkout-reservation-list',[
            "matreservations" => matreservation::
           
            orderBy("created_at","desc")->
            get(),

           
        ]);
    }
}
