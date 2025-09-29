<?php

namespace App\Http\Livewire\Utilisateur;

use Livewire\Component;
use App\Models\ticket;
use App\Models\chat;
use Illuminate\Http\Request;

class UtilisateurTicket extends Component
{
    public $checkData = [];
    public $disabled = "disabled";
    public $total;
    public $sujet;
    public $categorie;
    public $details;
    public $recherche;
    public $equipement;
  

    public function store(ticket $ticket,chat $chat){
       

        $ticket->sujet = $this->sujet;
        $ticket->details = $this->details;
        $ticket->equipement = $this->equipement;
        $ticket->categorie = $this->categorie;
        $ticket->status = "en attente";
        $ticket->priorite = false;
        $ticket->save();

        $chat->utilisateur_id = 2;
        $chat->targetmsg_id = 1;
        $chat->type = "agent";
        $chat->message = "Ticket creer avec succes";
        $chat->save();

        session()->flash('message','Ticket creer avec succes');
        return redirect()->to('/utilisateur-ticket');
    }

    public function render()
    {
  
        return view('livewire.utilisateur.utilisateur-ticket',[
            "tickets"=> ticket::where("id","like","%".$this->recherche."%")->paginate(8),
   
            "chats"=> chat::all(),
           ]);
    }
    
}
