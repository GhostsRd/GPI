<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CheckoutsCsvExport implements FromCollection, WithHeadings, WithMapping
{
    protected $checkouts;

    public function __construct($checkouts)
    {
        $this->checkouts = collect($checkouts);
    }

    public function collection()
    {
        return $this->checkouts;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Utilisateur',
            'Email',
            'Type Matériel',
            'Détails Matériel',
            'Statut',
            'Raison',
            'Date Début',
            'Date Fin',
            'Date Création'
        ];
    }

    public function map($checkout): array
    {
        $statut = match($checkout->statut) {
            'en_cours' => 'En cours',
            'termine' => 'Terminé',
            'annule' => 'Annulé',
            'en_retard' => 'En retard',
            default => $checkout->statut
        };

        return [
            $checkout->id,
            $checkout->utilisateur->nom ?? 'N/A',
            $checkout->utilisateur->email ?? 'N/A',
            $checkout->materiel_type,
            $checkout->materiel_details,
            $statut,
            $checkout->raison,
            $checkout->date_debut?->format('d/m/Y') ?? 'N/A',
            $checkout->date_fin?->format('d/m/Y') ?? 'N/A',
            $checkout->created_at->format('d/m/Y H:i')
        ];
    }
}
