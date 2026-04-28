<?php

namespace App\Exports;

use App\Models\MaterielReseau;
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

class MaterielReseauxExport implements \Maatwebsite\Excel\Concerns\FromCollection, \Maatwebsite\Excel\Concerns\WithHeadings, \Maatwebsite\Excel\Concerns\WithMapping, \Maatwebsite\Excel\Concerns\ShouldAutoSize, \Maatwebsite\Excel\Concerns\WithStyles, \Maatwebsite\Excel\Concerns\WithDrawings, \Maatwebsite\Excel\Concerns\WithCustomStartCell, \Maatwebsite\Excel\Concerns\WithEvents
{
    use BrandedExport;

    public function exportTitle(): string
    {
        return 'INVENTAIRE DU MATÉRIEL RÉSEAU';
    }
    public function collection()
    {
        return MaterielReseau::orderBy('nom')->get();
    }

    public function headings(): array
    {
        return [
            'Nom',
            'Entité',
            'Statut',
            'Fabricant',
            'Lieu',
            'Réseau IP',
            'Type',
            'Modèle',
            'Numéro de Série'
        ];
    }

    public function map($materiel): array
    {
        return [
            $materiel->nom,
            $materiel->entite,
            $materiel->statut,
            $materiel->fabricant,
            $materiel->lieu,
            $materiel->reseau_ip,
            $materiel->type,
            $materiel->modele,
            $materiel->numero_serie,
        ];
    }

}
