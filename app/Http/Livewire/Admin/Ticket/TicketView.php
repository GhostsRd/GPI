<?php

namespace App\Http\Livewire\Admin\Ticket;

use Livewire\Component;
use App\Models\ticket;

class TicketView extends Component
{
    public $ticketId;
    public $ticketvals;
    public $table = [1,2,3,4,5];
    //public $currentStep = 1;
    public $current = [
        1 => 'current',
        2 => 'future',
        3 => 'future',
        4 => 'future',
        5 => 'future',
    ];
    public $progress;

    public function nextStep()
    {
        for($i=1; $i<=5; $i++){
            if($this->current[$i] == "current" && $i < 5){
                $this->current[$i] = "past";
                $this->current[$i+1] = "current";
                $prog = ($i+1)*20; 
                $progress = 'fill_'.$prog;
                $this->progress = $progress;
                break;
            }
        }
       // dd($this->current);
    }

    public function previousStep()
    {
        for($i=5; $i>=1; $i--){
            if($this->current[$i] == "current" && $i > 1){
                $this->current[$i] = "future";
                $this->current[$i-1] = "current";
                $prog = ($i-1)*20; 
                $progress = 'fill_'.$prog;
                $this->progress = $progress;
                break;
            }
        }
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
    }          
    public function submitForm()
    {
        // Logic to handle form submission
    }
    public function render()
    {
        return view('livewire.admin.ticket.ticket-view',[
            "tickets" => ticket::all(),
        ]);
    }
}
