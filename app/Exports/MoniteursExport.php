<?php

namespace App\Exports;

use App\Models\Moniteur;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Exports\Concerns\BrandedExport;

class MoniteursExport implements \Maatwebsite\Excel\Concerns\FromCollection, \Maatwebsite\Excel\Concerns\WithHeadings, \Maatwebsite\Excel\Concerns\WithMapping, \Maatwebsite\Excel\Concerns\ShouldAutoSize, \Maatwebsite\Excel\Concerns\WithStyles, \Maatwebsite\Excel\Concerns\WithDrawings, \Maatwebsite\Excel\Concerns\WithCustomStartCell, \Maatwebsite\Excel\Concerns\WithEvents
{
    use BrandedExport;

    public function exportTitle(): string
    {
        return 'INVENTAIRE DES MONITEURS';
    }
    public function collection()
    {
        return Moniteur::with(['utilisateur', 'usager'])->orderBy('nom')->get();
    }

    public function headings(): array
    {
        return [
            'Nom',
            'Fabricant',
            'Modèle',
            'Numéro de Série',
            'Détenteur',
            'Entité',
            'Lieu',
            'Type',
            'Statut',
            'Commentaires'
        ];
    }

    public function map($moniteur): array
    {
        return [
            $moniteur->nom,
            $moniteur->fabricant,
            $moniteur->modele,
            $moniteur->numero_serie,
            $moniteur->utilisateur->nom ?? 'N/A',
            $moniteur->entite,
            $moniteur->lieu,
            $moniteur->type,
            $moniteur->statut,
            $moniteur->commentaires,
        ];
    }

}
