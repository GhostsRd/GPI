<?php

namespace App\Exports;

use App\Models\Telephone;
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

class TelephonesExport implements \Maatwebsite\Excel\Concerns\FromCollection, \Maatwebsite\Excel\Concerns\WithHeadings, \Maatwebsite\Excel\Concerns\WithMapping, \Maatwebsite\Excel\Concerns\ShouldAutoSize, \Maatwebsite\Excel\Concerns\WithStyles, \Maatwebsite\Excel\Concerns\WithDrawings, \Maatwebsite\Excel\Concerns\WithCustomStartCell, \Maatwebsite\Excel\Concerns\WithEvents
{
    use BrandedExport;

    public function exportTitle(): string
    {
        return 'INVENTAIRE DES TÉLÉPHONES ET TABLETTES';
    }
    public function collection()
    {
        return Telephone::with(['utilisateur', 'usager'])->orderBy('nom')->get();
    }

    public function headings(): array
    {
        return [
            'Nom',
            'Entité',
            'Usager',
            'Lieu',
            'Services',
            'Type',
            'Marque',
            'Modèle',
            'Numéro de Série',
            'Statut',
            'Emplacement Actuel',
            'IMEI'
        ];
    }

    public function map($telephone): array
    {
        return [
            $telephone->nom,
            $telephone->entite,
            $telephone->utilisateur->nom ?? 'N/A',
            $telephone->lieu,
            $telephone->services,
            $telephone->type,
            $telephone->marque,
            $telephone->modele,
            $telephone->numero_serie,
            $telephone->statut,
            $telephone->emplacement_actuel,
            $telephone->imei,
        ];
    }

}
