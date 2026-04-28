<?php

namespace App\Http\Livewire\Ticket;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Ticket as TicketModel;
use Illuminate\Support\Facades\Auth;

class Ticket extends Component
{
    //use WithPagination;

    public $checkData = [];
    public $selectedTickets = [];
    public $recherche = '';
    public $disabled = "disabled";
    public $categorie = "";
    public $showDeleteModal = false;
    public $ticketToDelete = null; // 🟢 Add this missing property
    public $sortField = 'id';
    public $sortDirection = 'asc';
    public $archive = false;


    public function archiveActive(){
        $this->archive = !$this->archive;
    }

    public function confirmDelete($ticketId)
    {
        $this->ticketToDelete = $ticketId;
        $this->showDeleteModal = true;
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->ticketToDelete = null;
    }

    public function deleteTicket()
    {
        if ($this->ticketToDelete) {
            TicketModel::find($this->ticketToDelete)?->delete();
            $this->showDeleteModal = false;
            $this->ticketToDelete = null;

            session()->flash('message', 'Ticket supprimé avec succès.');
        }
    }

    public function deleteSelected()
    {
        if (empty($this->selectedTickets)) {
            return;
        }

        TicketModel::whereIn('id', $this->selectedTickets)->delete();
        $this->selectedTickets = [];

        session()->flash('message', 'Tickets supprimés avec succès.');
    }

    public function changerVue()
    {
        return redirect()->to("/admin/ticket-kanban");
    }
    public function Visualiser($id){
            return redirect()->to("/admin/ticket-view-".$id);
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $tickets = TicketModel::where("responsable_id", Auth::user()->id)
            ->where("categorie", "like", "%" . $this->categorie . "%")
            ->where("archive", "like", "%" . $this->archive . "%")
            ->when($this->recherche, function ($query) {
                $query->where(function ($q) {
                    $q->where("reference", "like", "%" . $this->recherche . "%")
                        ->orWhere("sujet", "like", "%" . $this->recherche . "%");
                });
            })
            ->orderBy("priorite", "asc")
            ->orderBy("created_at", "desc")
            ->paginate(10);

        $ticketcs = TicketModel::where("responsable_id", Auth::user()->id)->count();

        return view('livewire.ticket.ticket', [
            "tickets" => $tickets,
            "totalTickets" => $ticketcs,
            "inProgressTickets" => TicketModel::where("status", "En cours")->count(),
            "pendingTickets" => TicketModel::where("status", "En attente")->count(),
            "resolvedTickets" => TicketModel::where("status", "Résolu")->count(),
        ]);
    }

    public function exportExcel()
    {
        try {
            $tickets = $this->getExportData();
            $fileName = 'export_tickets_' . now()->format('Ymd_His') . '.xlsx';
            
            if (ob_get_level()) ob_end_clean();
            
            return \Maatwebsite\Excel\Facades\Excel::download(
                new \App\Exports\TicketsExport($tickets), 
                $fileName,
                \Maatwebsite\Excel\Excel::XLSX
            );
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('swal:error', ['message' => 'Erreur lors de l\'export Excel : ' . $e->getMessage()]);
        }
    }

    public function exportCSV()
    {
        try {
            $tickets = $this->getExportData();
            $fileName = 'export_tickets_' . now()->format('Ymd_His') . '.csv';
            
            if (ob_get_level()) ob_end_clean();
            
            return \Maatwebsite\Excel\Facades\Excel::download(
                new \App\Exports\TicketsCsvExport($tickets), 
                $fileName,
                \Maatwebsite\Excel\Excel::CSV
            );
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('swal:error', ['message' => 'Erreur lors de l\'export CSV : ' . $e->getMessage()]);
        }
    }

    public function exportPDF()
    {
        try {
            $tickets = $this->getExportData();
            
            if (ob_get_level()) ob_end_clean();

            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('exports.tickets', [
                'tickets' => $tickets,
                'is_pdf' => true
            ])->setPaper('a4', 'landscape');

            return response()->streamDownload(function() use ($pdf) {
                echo $pdf->output();
            }, 'export_tickets_' . now()->format('Ymd_His') . '.pdf');
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('swal:error', ['message' => 'Erreur lors de l\'export PDF : ' . $e->getMessage()]);
        }
    }

    protected function getExportData()
    {
        return TicketModel::where("responsable_id", Auth::user()->id)
            ->where("categorie", "like", "%" . $this->categorie . "%")
            ->where("archive", "like", "%" . $this->archive . "%")
            ->when($this->recherche, function ($query) {
                $query->where(function ($q) {
                    $q->where("reference", "like", "%" . $this->recherche . "%")
                        ->orWhere("sujet", "like", "%" . $this->recherche . "%");
                });
            })
            ->orderBy("priorite", "asc")
            ->orderBy("created_at", "desc")
            ->get();
    }
}
