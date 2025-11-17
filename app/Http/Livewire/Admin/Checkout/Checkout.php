<?php

namespace App\Http\Livewire\Admin\Checkout;

use Livewire\Component;
use App\Models\ticket;
use Livewire\WithPagination;
use App\Models\Checkout as CheckoutModel;

class Checkout extends Component
{   use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function Visualiser($id){
        return redirect("/admin/checkout-view-".$id);
    }
    public function render()
    {
        $tickets = ticket::orderBy("created_at","desc")->paginate(5);
        $checkouts = CheckoutModel::orderBy("created_at","desc")->paginate(10);

        return view('livewire.admin.checkout.checkout',[
            "tickets" => $tickets,
            "checkouts" => $checkouts,

        ]);
    }
}