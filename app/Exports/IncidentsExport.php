<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Illuminate\Contracts\View\View;

class IncidentsExport implements FromView, ShouldAutoSize, WithDrawings
{
    protected $incidents;

    public function __construct($incidents)
    {
        // On s'assure d'avoir une collection propre
        $this->incidents = collect($incidents);
    }

    public function view(): View
    {
        return view('exports.incidents', [
            'incidents' => $this->incidents
        ]);
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo Pivot');
        $drawing->setDescription('Logo Pivot');
        $drawing->setPath(public_path('images/logoPivot.png'));
        $drawing->setHeight(50);
        $drawing->setCoordinates('A1');

        return $drawing;
    }
}
