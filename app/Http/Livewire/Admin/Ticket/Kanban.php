<?php

namespace App\Http\Livewire\Admin\Ticket;

use Livewire\Component;
use App\Models\ticket;
use Illuminate\Support\Facades\Auth;
use App\Models\Commentaire;

class Kanban extends Component
{
    

    public $steps;
    public $categorie ;
    public $priorite ;
    public $state ;
    public $recherche;


    public $ticketIds;

    protected $listeners = ['moveTicket']; // écoute l'événement JS

    public function mount()
    {
        $this->steps = [
            ['id' => 1, 'name' => 'Ouvert'],
            ['id' => 2, 'name' => 'Assignation'],
            ['id' => 3, 'name' => 'Traitement'],
            ['id' => 4, 'name' => 'Résolution'],
            ['id' => 5, 'name' => 'Clôture'],

        ];
   
    }
    public function changerVue(){
        return redirect()->to("/ticket");
    }
    public function Visualiser($id){
        return redirect()->to("/admin/ticket-view-".$id);
    }

    public function moveTicket($ticketId, $newStepId,Commentaire $commentaire)
    {
        $ticketId = (int) $ticketId;
        $newStepId = (int) $newStepId;

        $this->ticketIds =$ticketId;

        $ticket = ticket::find($ticketId);
        if (! $ticket) {
            return; // ou dispatchBrowserEvent pour message d'erreur
        }

        if ($ticket->state === $newStepId) {
            return; // rien à faire
        }

        $ticket->state = $newStepId;
        $ticket->save();

        
            $commentaire->ticket_id = $this->ticketIds;
            $commentaire->utilisateur_id = Auth::user()->id ;
            //$commentaire->responsable_id = Auth::user()->id ;
            $commentaire->etat = $newStepId;
            if($newStepId == 2){
                $commentaire->commentaire = "changement d'etat sur Assignation.";
            }elseif($newStepId == 3){
                $commentaire->commentaire = "Diagnostique de ticket en cours.";
                
            }
            elseif($newStepId == 4){
                $commentaire->commentaire = "Resolution de ticket du ticket.";
                
            }
            elseif($newStepId == 5){
                $commentaire->commentaire = "Traitement terminer";
                
            }
            $commentaire->save();

        // rafraîchir les données si nécessaire (ici on ne garde pas de cache)
        $this->emitSelf('refreshComponent'); // optional
        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Ticket déplacé']);
    }

    public function render()
    {
        // récupère les tickets depuis la DB (ou adapte selon ton modèle)
        $tickets = ticket::where("sujet","like", "%" .  $this->recherche . "%")->where("state","like", "%" .  $this->state . "%")->where("priorite","like", "%" .  $this->priorite . "%")->where("categorie","like", "%" .  $this->categorie . "%")->where("responsable_id",Auth::user()->id)
        
        ->orderBy("priorite", "asc")   // d'abord par priorité
        ->orderBy("created_at", "desc") 
        ->get();
        return view('livewire.admin.ticket.kanban', [
            'tickets' => $tickets,
        ]);
    }



}

