<?php

namespace App\Exports;

use App\Models\Logiciel;
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

class LogicielsExport implements \Maatwebsite\Excel\Concerns\FromCollection, \Maatwebsite\Excel\Concerns\WithHeadings, \Maatwebsite\Excel\Concerns\WithMapping, \Maatwebsite\Excel\Concerns\ShouldAutoSize, \Maatwebsite\Excel\Concerns\WithStyles, \Maatwebsite\Excel\Concerns\WithDrawings, \Maatwebsite\Excel\Concerns\WithCustomStartCell, \Maatwebsite\Excel\Concerns\WithEvents
{
    use BrandedExport;

    public function exportTitle(): string
    {
        return 'INVENTAIRE DES LOGICIELS';
    }
    public function collection()
    {
        return Logiciel::orderBy('nom')->get();
    }

    public function headings(): array
    {
        return [
            'Nom',
            'Éditeur',
            'Version',
            'S.E. Compatible',
            'Installations',
            'Licences',
            'Description',
            'Date Achat',
            'Date Expiration'
        ];
    }

    public function map($logiciel): array
    {
        return [
            $logiciel->nom,
            $logiciel->editeur,
            $logiciel->version_nom,
            $logiciel->version_systeme_exploitation,
            $logiciel->nombre_installations,
            $logiciel->nombre_licences,
            $logiciel->description,
            $logiciel->date_achat ? $logiciel->date_achat->format('d/m/Y') : '',
            $logiciel->date_expiration ? $logiciel->date_expiration->format('d/m/Y') : '',
        ];
    }

}
