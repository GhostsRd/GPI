<?php

namespace App\Http\Livewire\Admin\Ticket;

use Livewire\Component;

class Kanban extends Component
{
     public $steps = [
        ['id' => 1, 'name' => 'Step 1'],
        ['id' => 2, 'name' => 'Step 2'],
        ['id' => 3, 'name' => 'Step 3'],
    ];

    public $tickets = [
        ['id' => 1, 'title' => 'Fix login bug', 'step_id' => 1],
        ['id' => 2, 'title' => 'Update CSS', 'step_id' => 1],
        ['id' => 3, 'title' => 'Deploy to prod', 'step_id' => 2],
    ];

    public function moveTicket($ticketId, $newStepId)
    {
        foreach ($this->tickets as &$ticket) {
            if ($ticket['id'] == $ticketId) {
                $ticket['step_id'] = $newStepId;
                break;
            }
        }
    }

   
    public function render()
    {
        return view('livewire.admin.ticket.kanban');
    }
}
