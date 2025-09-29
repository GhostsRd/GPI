<?php

namespace App\Http\Livewire\Ticket;

use Livewire\Component;
use App\Models\ticket as ticketmodel;

class Ticket extends Component
{
    public $checkData = [];
    public $recherche;
    public $disabled = "disabled";
    public function render()
    {
        return view('livewire.ticket.ticket',[
            "tickets"=> ticketmodel::where("id","like","%".$this->recherche."%")
        
        ->paginate(8),
           ]);
    }
}
