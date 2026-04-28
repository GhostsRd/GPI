<?php

namespace App\Exports;

use App\Models\Imprimante;
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

class ImprimantesExport implements \Maatwebsite\Excel\Concerns\FromCollection, \Maatwebsite\Excel\Concerns\WithHeadings, \Maatwebsite\Excel\Concerns\WithMapping, \Maatwebsite\Excel\Concerns\ShouldAutoSize, \Maatwebsite\Excel\Concerns\WithStyles, \Maatwebsite\Excel\Concerns\WithDrawings, \Maatwebsite\Excel\Concerns\WithCustomStartCell, \Maatwebsite\Excel\Concerns\WithEvents
{
    use BrandedExport;

    public function exportTitle(): string
    {
        return 'INVENTAIRE DES IMPRIMANTES';
    }
    public function collection()
    {
        return Imprimante::with(['utilisateur', 'usager'])->orderBy('nom')->get();
    }

    public function headings(): array
    {
        return [
            'Nom',
            'Entité',
            'Statut',
            'Fabricant',
            'Modèle',
            'Numéro de Série',
            'IP',
            'Lieu',
            'Type'
        ];
    }

    public function map($imprimante): array
    {
        return [
            $imprimante->nom,
            $imprimante->entite,
            $imprimante->statut,
            $imprimante->fabricant,
            $imprimante->modele,
            $imprimante->numero_serie,
            $imprimante->reseau_ip,
            $imprimante->lieu,
            $imprimante->type,
        ];
    }

}
