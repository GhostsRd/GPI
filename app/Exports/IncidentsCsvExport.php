<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class IncidentsCsvExport implements FromCollection, WithHeadings, WithMapping
{
    protected $incidents;

    public function __construct($incidents)
    {
        $this->incidents = collect($incidents);
    }

    public function collection()
    {
        return $this->incidents;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Sujet',
            'Utilisateur',
            'Type Matériel',
            'Statut',
            'Date Création'
        ];
    }

    public function map($incident): array
    {
        $statusText = 'Inconnu';
        if($incident->statut == 1) $statusText = 'En cours';
        elseif($incident->statut == 2) $statusText = 'En traitement';
        elseif($incident->statut == 0) $statusText = 'Demande annulation';

        return [
            $incident->id,
            $incident->incident_sujet ?? '',
            $incident->utilisateur->nom ?? 'N/A',
            $incident->equipement_type ?? '',
            $statusText,
            $incident->created_at->format('d/m/Y H:i')
        ];
    }
}
