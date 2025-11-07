<?php

namespace App\Http\Livewire\Admin\Checkout;

use App\Models\Checkout;
use App\Models\Commentaire;
use App\Models\utilisateur;
use Livewire\Component;

class ReservationView extends Component
{
      public $checkoutId;
      public function mount(){
        $this->checkoutId;
      }
    public function render()
    {
        return view('livewire.admin.checkout.reservation-view',
    [
        'checkouts' => Checkout::get() ,
        'utilisateurs' => utilisateur::get(),
        'commentaires' => Commentaire::get() ,
    ]);
    }
}
