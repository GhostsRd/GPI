<?php

namespace App\Http\Livewire\Utilisateur;

use Livewire\Component;
use App\Models\ticket;
use Illuminate\Http\Request;

class UtilisateurTicket extends Component
{
    public $checkData = [];
    public $disabled = "disabled";
    public $total;
    public $sujet;
    public $categorie;
    public $details;
    public $equipement;
  

    public function store(ticket $ticket){
       

        $ticket->sujet = $this->sujet;
        $ticket->details = $this->details;
        $ticket->equipement = $this->equipement;
        $ticket->categorie = $this->categorie;
        $ticket->status = "en attente";
        $ticket->priorite = false;
        $ticket->save();

        session()->flash('message','Ticket creer avec succes');
        return redirect()->to('/utilisateur-ticket');
    }

    public function render()
    {
  
        return view('livewire.utilisateur.utilisateur-ticket');
    }
    
}
