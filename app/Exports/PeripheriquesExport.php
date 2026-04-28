<?php

namespace App\Exports;

use App\Models\Peripherique;
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

class PeripheriquesExport implements \Maatwebsite\Excel\Concerns\FromCollection, \Maatwebsite\Excel\Concerns\WithHeadings, \Maatwebsite\Excel\Concerns\WithMapping, \Maatwebsite\Excel\Concerns\ShouldAutoSize, \Maatwebsite\Excel\Concerns\WithStyles, \Maatwebsite\Excel\Concerns\WithDrawings, \Maatwebsite\Excel\Concerns\WithCustomStartCell, \Maatwebsite\Excel\Concerns\WithEvents
{
    use BrandedExport;

    public function exportTitle(): string
    {
        return 'INVENTAIRE DES PÉRIFHÉRIQUES';
    }
    public function collection()
    {
        return Peripherique::with(['utilisateur', 'usager'])->orderBy('nom')->get();
    }

    public function headings(): array
    {
        return [
            'Nom',
            'Entité',
            'Statut',
            'Fabricant',
            'Lieu',
            'Type',
            'Modèle',
            'Usager'
        ];
    }

    public function map($peripherique): array
    {
        return [
            $peripherique->nom,
            $peripherique->entite,
            $peripherique->statut,
            $peripherique->fabricant,
            $peripherique->lieu,
            $peripherique->type,
            $peripherique->modele,
            $peripherique->utilisateur->nom ?? 'N/A',
        ];
    }

}
