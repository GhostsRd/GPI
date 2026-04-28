<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ActivitesCsvExport implements FromCollection, WithHeadings, WithMapping
{
    protected $activities;

    public function __construct($activities)
    {
        $this->activities = collect($activities);
    }

    public function collection()
    {
        return $this->activities;
    }

    public function headings(): array
    {
        return [
            'N°',
            'Date & Heure',
            'Type',
            'Description',
            'Utilisateur',
            'Assigné à',
            'Statut',
            'Priorité'
        ];
    }

    public function map($activity): array
    {
        return [
            $activity['id'] ?? '',
            is_object($activity['date']) ? $activity['date']->format('d/m/Y H:i') : ($activity['date'] ?? ''),
            $activity['type'] ?? '',
            $activity['title'] ?? '',
            $activity['user'] ?? '',
            $activity['assigned_to'] ?? '',
            $activity['status'] ?? '',
            $activity['priority'] ?? '',
        ];
    }
}
