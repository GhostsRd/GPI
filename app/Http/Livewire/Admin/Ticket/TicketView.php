<?php

namespace App\Http\Livewire\Admin\Ticket;

use Livewire\Component;
use App\Models\ticket;
use App\Models\Commentaire;

class TicketView extends Component
{
    public $ticketId;
    public $ticketvals;
    public $table = [1,2,3,4,5];
    public $commentaires;
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

    public function postCommentaire(Commentaire $commentaire){
        if(!$this->comments){
          
        }else{

            $commentaire->ticket_id = $this->ticketId;
            $commentaire->utilisateur_id = 2;
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

        for($i=1; $i<=5; $i++){
            if($i < $this->currentStep){
                $this->current[$i] = "past";
            }elseif($i == $this->currentStep){
                $this->current[$i] = "current";
            }else{
                $this->current[$i] = "future";
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
        
        for($i=5; $i>=1; $i--){
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
        // Exemple si tu veux charger directement ton modèle
        $this->ticketvals = Ticket::findOrFail($this->ticketId);
        $this->commentaires = $this->ticketvals
                ->commentaires()
                ->orderBy('created_at', 'desc')
                ->get();

    }         

  
    public function render()
    {   
        $this->modelstep(Ticket::find($this->ticketId));
        return view('livewire.admin.ticket.ticket-view',[
            "tickets" => ticket::all(),
            "commentaires" => $this->commentaires,
        ]);
    }
}
