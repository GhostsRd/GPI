<?php

namespace App\Http\Livewire\Utilisateur;

use Livewire\Component;
use App\Models\ticket;
use App\Models\chat;
use Illuminate\Support\Facades\Auth;
use App\Models\Commentaire;

class UtilisateurService extends Component
{
    public $recherche = "";
    public $message;
    public $total;
    public $sujet;
    public $categorie;
    public $details;
    public $priorite;
    public $equipement;
    public $impact;
    public $equipementSeeder;
    public $responsable_id = 2;
 
    protected $rules = [
        'sujet'      => 'required|string|min:5',
        'details'    => 'required|string|min:5',
        'priorite'   => 'required|string',
        'equipementSeeder' => 'required|string',
        'categorie'  => 'required|string',
        'impact'     => 'required|string',
    ];

    // Validation en direct à chaque update de champ
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }



        public function store(ticket $ticket,chat $chat,Commentaire $commentaire){
        $utlisateurConnecter = Auth::guard('utilisateur')->user()->id;
        if($this->categorie == "Réseau"){
            $this->responsable_id= 1;
        }

        $ticket->sujet = $this->sujet;
        $ticket->details = $this->details;
        $ticket->utilisateur_id = $utlisateurConnecter ;
        $ticket->responsable_id = $this->responsable_id;
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

        $this->reset(['sujet', 'details', 'priorite']);

        // Event JS (ex: fermer modal)
        $this->dispatchBrowserEvent('ticket-saved');

        //session()->flash('message','Ticket creer avec succes');
        //return redirect()->to('/utilisateur-ticket');
    }
    public function visualiser($id){
        
        return redirect("/utilisateur-ticket");
    }
    public function storechat()
    {
        $chat = new chat();
        $chat->utilisateur_id = 1;
        $chat->targetmsg_id = 2;
        $chat->type = "utilisateur";
        $chat->message = $this->message;
        $chat->save();
    }

    public function render()
    {
        $user_ID =  Auth::guard('utilisateur')->user()->id;
        
        return view('livewire.utilisateur.utilisateur-service',[
            "tickets"=> ticket::where("sujet","like","%".$this->recherche."%")
                ->where("utilisateur_id",$user_ID)
                ->paginate(8),
         "chats"=> chat::all(),
           ]);
    }
}
