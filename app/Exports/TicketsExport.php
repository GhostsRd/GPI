<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Illuminate\Contracts\View\View;

class TicketsExport implements FromView, ShouldAutoSize, WithDrawings
{
    protected $tickets;

    public function __construct($tickets)
    {
        $this->tickets = collect($tickets);
    }

    public function view(): View
    {
        return view('exports.tickets', [
            'tickets' => $this->tickets
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
