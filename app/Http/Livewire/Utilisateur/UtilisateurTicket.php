<?php

namespace App\Http\Livewire\Utilisateur;

use Livewire\Component;
use App\Models\ticket;
use App\Models\chat;
use App\Models\Commentaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
  

    public function store(ticket $ticket,chat $chat,Commentaire $commentaire){
        $utlisateurConnecter = Auth::guard('utilisateur')->user()->id;

        $ticket->sujet = $this->sujet;
        $ticket->details = $this->details;
        $ticket->utilisateur_id = $utlisateurConnecter ;
        $ticket->equipement = $this->equipement;
        $ticket->categorie = $this->categorie;
        $ticket->state = 2;
        $ticket->status = "en attente";
        $ticket->priorite = false;
        $ticket->save();



        $findTicket = ticket::latest()->first();

       

        $commentaire->ticket_id = $findTicket->id;
        $commentaire->utilisateur_id = $utlisateurConnecter ;
        $commentaire->commentaire = "Ticket creer avec succes";
        $commentaire->save();
        

        $chat->utilisateur_id = $utlisateurConnecter ;
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
