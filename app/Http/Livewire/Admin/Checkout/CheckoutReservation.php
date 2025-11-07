<?php

namespace App\Http\Livewire\Admin\Checkout;

use Livewire\Component;
use App\Models\checkoutreserver as reserverEquipement;

class CheckoutReservation extends Component
{
     public $type = "";
    
     public function changerVue(){
        return redirect('/admin/checkout-reservation-list');
     }
    public function render()
    {
        return view('livewire.admin.checkout.checkout-reservation',
     ['events' => reserverEquipement:: where('equipement_type', "like", "%" . $this->type . "%")->get(),]
    );
    }
}
