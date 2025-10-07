<?php

namespace App\Http\Livewire\Utilisateur;

use Livewire\Component;
use App\Models\ticket;
use App\Models\chat;
use App\Models\Commentaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\utilisateur;
use App\Models\User;

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
    public $ticketId;
    public $commentaires;



     public function mount($id)
    {
        $this->ticketId = $id;
        //$this->current;
        //$this->progress;
       // $this->techniciens = \App\Models\Utilisateur::where('role', 'technicien')->get();
        // Exemple si tu veux charger directement ton modèle
        $this->ticketvals = Ticket::findOrFail($this->ticketId);
        $this->commentaires = $this->ticketvals
                ->commentaires()
                ->orderBy('created_at', 'desc')
                ->get();
       ;
    }      

    public function store(ticket $ticket,chat $chat,Commentaire $commentaire){
        $utlisateurConnecter = Auth::guard('utilisateur')->user()->id;

        $ticket->sujet = $this->sujet;
        $ticket->details = $this->details;
        $ticket->utilisateur_id = $utlisateurConnecter ;
        $ticket->equipement = $this->equipement;
        $ticket->categorie = $this->categorie;
        $ticket->impact = $this->impact;
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
            "responsables" =>User::all(),
           ]);
    }
    
}
