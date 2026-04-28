<?php

namespace App\Exports;

use App\Models\Ordinateur;
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

class OrdinateursExport implements \Maatwebsite\Excel\Concerns\FromCollection, \Maatwebsite\Excel\Concerns\WithHeadings, \Maatwebsite\Excel\Concerns\WithMapping, \Maatwebsite\Excel\Concerns\ShouldAutoSize, \Maatwebsite\Excel\Concerns\WithStyles, \Maatwebsite\Excel\Concerns\WithDrawings, \Maatwebsite\Excel\Concerns\WithCustomStartCell, \Maatwebsite\Excel\Concerns\WithEvents
{
    use BrandedExport;

    public function exportTitle(): string
    {
        return 'INVENTAIRE DES ORDINATEURS';
    }
    public function collection()
    {
        return Ordinateur::with(['utilisateur', 'usager'])->orderBy('nom')->get();
    }

    public function headings(): array
    {
        return [
            'Nom',
            'Entité',
            'Sous-entité',
            'Statut',
            'Fabricant',
            'Modèle',
            'Numéro de Série',
            'Utilisateur',
            'Usager',
            'Date Inventaire',
            'IP',
            'Disque Dur',
            'OS Version',
            'OS Noyau',
            'Dernier Démarrage',
            'Notes'
        ];
    }

    public function map($ordinateur): array
    {
        return [
            $ordinateur->nom,
            $ordinateur->entite,
            $ordinateur->sous_entite,
            $ordinateur->statut,
            $ordinateur->fabricant,
            $ordinateur->modele,
            $ordinateur->numero_serie,
            $ordinateur->utilisateur->nom ?? 'N/A',
            $ordinateur->usager->nom ?? 'N/A',
            $ordinateur->date_dernier_inventaire ? $ordinateur->date_dernier_inventaire->format('d/m/Y') : '',
            $ordinateur->reseau_ip,
            $ordinateur->disque_dur,
            $ordinateur->os_version,
            $ordinateur->os_noyau,
            $ordinateur->derniere_date_demarrage ? $ordinateur->derniere_date_demarrage->format('d/m/Y H:i') : '',
            $ordinateur->notes,
        ];
    }

}
