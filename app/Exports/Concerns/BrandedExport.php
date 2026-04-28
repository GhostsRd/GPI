<?php

namespace App\Exports\Concerns;

use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;

trait BrandedExport
{
    public function startCell(): string
    {
        return 'A6';
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo Pivot');
        $drawing->setDescription('Logo Pivot');
        $drawing->setPath(public_path('images/logoPivot.png'));
        $drawing->setHeight(80);
        $drawing->setCoordinates('A1');

        return $drawing;
    }

    public function styles(Worksheet $sheet)
    {
        $lastColumn = $this->getLastColumn();
        return [
            6 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '3D3E14'],
                ],
            ],
            "A1:{$lastColumn}5" => [
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $lastColumn = $this->getLastColumn();
                $centerColStart = 'C';
                $centerColEnd = $this->getCenterEndColumn($lastColumn);
                
                $event->sheet->getDelegate()->mergeCells("{$centerColStart}2:{$centerColEnd}3");
                $event->sheet->getDelegate()->setCellValue("{$centerColStart}2", $this->exportTitle());
                $event->sheet->getDelegate()->getStyle("{$centerColStart}2")->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 18,
                        'color' => ['rgb' => '3D3E14'],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);

                $event->sheet->getDelegate()->setCellValue("{$centerColStart}4", 'Généré le : ' . date('d/m/Y H:i'));
                $event->sheet->getDelegate()->getStyle("{$centerColStart}4")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }

    protected function getLastColumn(): string
    {
        $count = count($this->headings());
        return \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($count);
    }

    protected function getCenterEndColumn($lastColumn): string
    {
        // Try to center title based on columns
        $count = count($this->headings());
        $endIdx = max(3, $count - 1);
        return \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($endIdx);
    }
}
