<?php

namespace App\Http\Livewire\Admin\Ticket;

use Livewire\Component;
use App\Models\ticket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Models\Commentaire;

class TicketView extends Component
{
    public $ticketId;
    public $ticketvals;
    public $table = [1,2,3,4,5];
    //public $commentaires;
    public $comments;
    public $currentStep;
    public $current = [
        1 => 'current',
        2 => 'future',
        3 => 'future',
        4 => 'future',
        5 => 'future',
    ];
    public $progress;

    public $selectedTicket;
public $assigned_to;
public $techniciens;


public function openAffectationModal()
{
  
    $this->assigned_to = null; // reset
     $this->dispatchBrowserEvent('openAffectationModal');
}

public function affecter()
{
    $this->validate([
        'assigned_to' => 'required|exists:utilisateurs,id',
    ]);

    $ticket = ticket::findOrFail($this->ticketId);
    $ticket->responsable_id = $this->assigned_to;
    $ticket->save();

    $this->dispatchBrowserEvent('closeAffectationModal'); // fermer le modal côté JS
    session()->flash('message', 'Ticket affecté avec succès ✅');
    return redirect('/ticket');
}

    public function postCommentaire(Commentaire $commentaire){
        if(!$this->comments){
          
        }else{

            $commentaire->ticket_id = $this->ticketId;
            $commentaire->utilisateur_id = Auth::user()->id ;
            //$commentaire->responsable_id = Auth::user()->id ;

            $commentaire->etat = $this->currentStep;
            $commentaire->commentaire = $this->comments;
            $commentaire->save();

            return redirect()->to('/admin/ticket-view-'.$this->ticketId);
        }

       // session()->flash('message','Commentaire ajouter avec succes');
      //  return redirect()->to('/admin-ticket-view/'.$this->ticketId);

    }

    public function modelstep(Ticket $ticket){
        $ticket = Ticket::find($this->ticketId);
        $this->currentStep = $ticket->state;

        $this->current[$this->currentStep] = "current";
        $prog = $this->currentStep*20; 
        $progress = 'fill_'.$prog;
        $this->progress = $progress;

        if($this->currentStep == 5){

        }else{
            for($i=1; $i<=6; $i++){
            if($i < $this->currentStep){
                $this->current[$i] = "past";
            }elseif($i == $this->currentStep){
                $this->current[$i] = "current";
            }else{
                $this->current[$i] = "future";
            }
        }

        }

      
    }
    public function nextStep()
    {
        $this->modelstep(Ticket::find($this->ticketId));
        Ticket::where('id', $this->ticketId)->update(['state' => $this->currentStep + 1]);    

    }

    public function previousStep()
    {
        
        for($i=6; $i>=1; $i--){
            if($this->current[$this->currentStep] == "current" && $i > 1){
                $this->current[$this->currentStep] = "future";
                $this->current[$this->currentStep-1] = "current";
                $prog = ($i-1)*20; 
                $progress = 'fill_'.$prog;
                $this->progress = $progress;
                break;
            }
        }
        Ticket::where('id', $this->ticketId)->update(['state' => $this->currentStep - 1]);
       // dd($this->current);
    }
    public function currentStep($val)
    {
        $this->current[$val] = "current";
        $prog = $val*20; 
        $progress = 'fill_'.$prog;
        $this->progress = $progress;

        for($i=1; $i<=5; $i++){
            if($i < $val){
                $this->current[$i] = "past";
            }elseif($i == $val){
                $this->current[$i] = "current";
                
                
            }else{
                $this->current[$i] = "future";
            }
        }
        //dd($this->current);
        // foreach($this->table as $item){
        //     if($item < $val){
        //         $this->current = $item;
        //     }elseif($item > $val){
        //         $this->future = $item;
        //     }else{
        //         $this->past = $item;
        //     }
        // }
       // $this->currentStep = $val;
        //dd($this->currentStep);
    }

    public function mount($id)
    {
        $this->ticketId = $id;
        $this->current;
        $this->progress;
        $this->techniciens = \App\Models\Utilisateur::where('role', 'technicien')->get();
        // Exemple si tu veux charger directement ton modèle
        $this->ticketvals = Ticket::findOrFail($this->ticketId);
       
    }         

  
    public function render()
    {   
        $this->modelstep(Ticket::find($this->ticketId));
        return view('livewire.admin.ticket.ticket-view',[

            "utilisateurs" => ticket::find($this->ticketId)->utilisateur,
            "responsables" => User::get(),

            "commentaires" => $this->ticketvals
                ->commentaires()
                ->orderBy('created_at', 'desc')
                ->paginate(2)
        ]);
    }
}
