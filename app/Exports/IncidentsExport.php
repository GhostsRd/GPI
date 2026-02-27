<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class IncidentsExport implements FromView, ShouldAutoSize
{
    protected $incidents;

    public function __construct($incidents)
    {
        $this->incidents = $incidents;
    }

    public function view(): View
    {
        return view('exports.incidents', [
            'incidents' => $this->incidents
        ]);
    }
}
