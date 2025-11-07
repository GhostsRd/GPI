<?php

namespace App\Http\Livewire\Admin\Checkout;

use Livewire\Component;
use App\Models\checkoutreserver as matreservation;
class CheckoutReservationList extends Component
{
   
    public function changerVue(){
        return redirect('/admin/checkout-reservation');
    }
    public function Visualiser($id){

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
