<?php

namespace App\Http\Livewire\Ticket;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Ticket as TicketModel;

class Ticket extends Component
{
    use WithPagination;

    public $checkData = [];
    public $selectedTickets = [];
    public $recherche = '';
    public $disabled = "disabled";

    public function render()
    {
        $tickets = TicketModel::when($this->recherche, function ($query) {
            $query->where("reference", "like", "%" . $this->recherche . "%")
                ->orWhere("sujet", "like", "%" . $this->recherche . "%");
        })->paginate(8);

        return view('livewire.ticket.ticket', [
            "tickets" => $tickets,
            "totalTickets" => TicketModel::count(),
            "inProgressTickets" => TicketModel::where("status", "En cours")->count(),
            "pendingTickets" => TicketModel::where("status", "En attente")->count(),
            "resolvedTickets" => TicketModel::where("status", "Résolu")->count(),
        ]);
    }
}
