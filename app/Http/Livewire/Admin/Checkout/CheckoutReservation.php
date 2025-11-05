<?php

namespace App\Http\Livewire\Admin\Checkout;

use Livewire\Component;
use App\Models\checkoutreserver as reserverEquipement;

class CheckoutReservation extends Component
{

    
    public function render()
    {
        return view('livewire.admin.checkout.checkout-reservation',
     ['events' => reserverEquipement::get(),]
    );
    }
}
