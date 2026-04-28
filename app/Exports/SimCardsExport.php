<?php

namespace App\Exports;

use App\Models\SimCard;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;

class SimCardsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithDrawings, WithCustomStartCell, WithEvents
{
    private $rowCount = 0;

    public function collection()
    {
        $sims = SimCard::with('currentUser')->get();
        $this->rowCount = $sims->count();
        return $sims;
    }

    public function startCell(): string
    {
        // Start data at row 5 to leave space for logo and title
        return 'A5';
    }

    public function headings(): array
    {
        return [
            'N°',
            'Numéro de téléphone',
            'ICCID / MSISDN',
            'Opérateur',
            'Statut',
            'Utilisateur Actuel',
            'Service',
            'Modèle Téléphone',
            'IMEI',
            'Date d\'activation',
            'Remarques'
        ];
    }

    public function map($sim): array
    {
        return [
            $sim->id,
            $sim->phone_number,
            $sim->iccid,
            $sim->operator,
            $sim->status == 'available' ? 'Disponible' : 
                ($sim->status == 'assigned' ? 'Attribuée' : 
                ($sim->status == 'lost' ? 'Perdue' : 'Désactivée')),
            $sim->currentUser ? $sim->currentUser->name : '—',
            $sim->department ?? '—',
            $sim->device_model ?? '—',
            $sim->imei ?? '—',
            $sim->activation_date ? $sim->activation_date->format('d/m/Y') : '—',
            $sim->remarks ?? ''
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 6,
            'B' => 22,
            'C' => 24,
            'D' => 14,
            'E' => 14,
            'F' => 22,
            'G' => 18,
            'H' => 18,
            'I' => 20,
            'J' => 16,
            'K' => 30,
        ];
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo Pivot');
        $drawing->setDescription('Logo Pivot');
        $drawing->setPath(public_path('images/logoPivot.png'));
        $drawing->setHeight(45);
        $drawing->setCoordinates('A1');
        $drawing->setOffsetX(5);
        $drawing->setOffsetY(5);

        return $drawing;
    }

    public function styles(Worksheet $sheet)
    {
        // Teal primary color
        $tealHex = '5BC4BF';
        $tealDark = '3A9E99';
        $grayLight = 'F8FAFC';
        $grayBorder = 'E2E8F0';

        // ----- TITLE ROW (Row 2-3) -----
        $sheet->mergeCells('B1:K1');
        $sheet->setCellValue('B1', 'GPI — Pivot · Gestion de Parc Informatique');
        $sheet->getStyle('B1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
                'color' => ['argb' => 'FF' . $tealHex],
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);
        $sheet->getRowDimension(1)->setRowHeight(50);

        $sheet->mergeCells('A2:K2');
        $sheet->setCellValue('A2', 'Rapport de la Flotte SIM — Exporté le ' . now()->format('d/m/Y à H:i'));
        $sheet->getStyle('A2')->applyFromArray([
            'font' => [
                'size' => 10,
                'color' => ['argb' => 'FF94A3B8'],
                'italic' => true,
            ],
        ]);
        $sheet->getRowDimension(2)->setRowHeight(20);

        // Separator row
        $sheet->mergeCells('A3:K3');
        $sheet->getRowDimension(3)->setRowHeight(5);
        $sheet->getStyle('A3:K3')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF' . $tealHex],
            ],
        ]);

        // Empty row 4
        $sheet->getRowDimension(4)->setRowHeight(8);

        // ----- HEADER ROW (Row 5) -----
        $sheet->getStyle('A5:K5')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 10,
                'color' => ['argb' => 'FFFFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF' . $tealDark],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF' . $tealDark],
                ],
            ],
        ]);
        $sheet->getRowDimension(5)->setRowHeight(28);

        // ----- DATA ROWS -----
        $lastRow = 5 + $this->rowCount;
        if ($this->rowCount > 0) {
            $sheet->getStyle('A6:K' . $lastRow)->applyFromArray([
                'font' => [
                    'size' => 10,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => 'FF' . $grayBorder],
                    ],
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ]);

            // Zebra stripe rows
            for ($i = 6; $i <= $lastRow; $i++) {
                $sheet->getRowDimension($i)->setRowHeight(22);
                if ($i % 2 == 0) {
                    $sheet->getStyle('A' . $i . ':K' . $i)->applyFromArray([
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => ['argb' => 'FF' . $grayLight],
                        ],
                    ]);
                }
            }

            // Center columns A, D, E, J
            $sheet->getStyle('A6:A' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('D6:D' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('E6:E' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('J6:J' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }

        // ----- FOOTER -----
        $footerRow = $lastRow + 2;
        $sheet->mergeCells('A' . $footerRow . ':K' . $footerRow);
        $sheet->setCellValue('A' . $footerRow, 'Total : ' . $this->rowCount . ' carte(s) SIM');
        $sheet->getStyle('A' . $footerRow)->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
                'color' => ['argb' => 'FF' . $tealHex],
            ],
        ]);

        return [];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Freeze panes: freeze below header row
                $event->sheet->freezePane('A6');
                
                // Auto-filter on header row
                $event->sheet->setAutoFilter('A5:K5');
                
                // Print settings
                $event->sheet->getDelegate()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
                $event->sheet->getDelegate()->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
                $event->sheet->getDelegate()->getPageSetup()->setFitToWidth(1);
                $event->sheet->getDelegate()->getPageSetup()->setFitToHeight(0);
            },
        ];
    }
}
