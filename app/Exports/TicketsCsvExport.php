<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TicketsCsvExport implements FromCollection, WithHeadings, WithMapping
{
    protected $tickets;

    public function __construct($tickets)
    {
        $this->tickets = collect($tickets);
    }

    public function collection()
    {
        return $this->tickets;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Sujet',
            'Utilisateur',
            'Responsable',
            'Catégorie',
            'Priorité',
            'Statut',
            'Créé le'
        ];
    }

    public function map($ticket): array
    {
        return [
            $ticket->id,
            $ticket->sujet ?? 'N/A',
            $ticket->utilisateur->nom ?? 'N/A',
            $ticket->responsable->name ?? '---',
            $ticket->categorie ?? 'N/A',
            ucfirst($ticket->priorite ?? 'normale'),
            $ticket->status ?? 'Nouveau',
            $ticket->created_at->format('d/m/Y H:i')
        ];
    }
}
