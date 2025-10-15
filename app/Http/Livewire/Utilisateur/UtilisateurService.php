<?php

namespace App\Http\Livewire\Utilisateur;

use Livewire\Component;
use App\Models\ticket;
use App\Models\chat;
use Illuminate\Support\Facades\Auth;
use App\Models\Commentaire;
use App\Models\User;
use Livewire\WithPagination;


class UtilisateurService extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $recherche = "";
    public $message;
    public $total;
    public $sujet;
    public $categorie;
    public $details;
    public $priorite;
    public $priorite_impact;
    public $equipement;
    public $state;
    public $impact ;
    public $equipementSeeder;
    public $responsable_id = 2;
    public $step2 = "";
    
    public function steps2(){
        $this->step2 = "active";
    }
    public function visiterCheckout(){
        return redirect("/utilisateur-checkout");
    }
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
        //$responsable = User::where("poste",);


        if($this->categorie == "Réseau"){
            $this->responsable_id= 1;

        }elseif($this->categorie == "Logiciel"){
            $this->responsable_id= 2;
        
        }
        if($this->impact == "Utilisateur"){
            $this->priorite_impact= 1;

        }elseif($this->impact == "Organisation" || $this->impact ==  "Service"){
            $this->priorite_impact= 0;
        
        }
        elseif($this->impact == "Autre"){
            $this->priorite_impact= 2;
        
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
        $ticket->priorite = $this->priorite_impact;
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
        $this->emitSelf('refreshComponent'); 
        $this->dispatchBrowserEvent('toggleSidebar');

        // Event JS (ex: fermer modal)
        
        //session()->flash('message','Ticket creer avec succes');
        //return redirect()->to('/utilisateur-ticket-'.$findTicket->id);
    }
    public function visualiser($id){
        
        return redirect("/utilisateur-ticket-".$id);
       //return view('Utilisateur.utilisateur-ticket',compact('id'));
    }
    public function mount(){
        
        $this->step2;
        $this->resetPage('refreshComponent');
        $this->dispatchBrowserEvent('ticket-saved');
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
            "tickets"=> ticket::
                      where("utilisateur_id",$user_ID)
                    ->where("state","like","%" . $this->state . "%")
                    ->where("sujet","like","%".$this->recherche."%")
                    ->orderBy("created_at", "desc")
                ->paginate(4),
         "chats"=> chat::all(),
         "responsables" => User::all(),
           ]);
    }
}
