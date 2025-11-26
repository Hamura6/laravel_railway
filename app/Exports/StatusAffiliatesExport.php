<?php

namespace App\Exports;

use App\Models\Affiliate;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class StatusAffiliatesExport implements FromCollection, WithHeadings, WithEvents, WithCustomStartCell, WithTitle
{
    protected $statusTotal;
    protected $total;
    protected $estadosText;
    protected $affiliates;

    public function __construct(array $statusTotal)
    {
        $this->statusTotal = $statusTotal;

        $estados = array_keys($this->statusTotal);

        $this->affiliates = Affiliate::select('id', 'user_id', 'status', 'created_at')
            ->with(['user:id,name,last_name'])
            ->whereIn('status', $estados)
            ->get();

        $this->total = $this->affiliates->count();

        $estadoText = '';
        foreach ($this->statusTotal as $estado => $count) {
            $estadoText .= "$estado = $count, ";
        }
        $this->estadosText = rtrim($estadoText, ', ');
    }

    public function collection()
    {
        $data = $this->affiliates->map(function ($affiliate, $index) {
            return [
                '#' => $index + 1,
                'Matrícula' => $affiliate->id,
                'Afiliado' => $affiliate->user->name . ' ' . $affiliate->user->last_name,
                'Estado' => ucfirst($affiliate->status),
                'Antigüedad (años)' => $affiliate->antique,
            ];
        });

        return new Collection($data);
    }

    public function headings(): array
    {
        return [
            ['#', 'Matrícula', 'Afiliado', 'Estado', 'Antigüedad (años)'],
        ];
    }

    public function title(): string
    {
        return 'Afiliados por estado';
    }

    public function startCell(): string
    {
        // La tabla (encabezados) debe comenzar en la fila 7
        return 'A7';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                /**
                 * No insertamos nuevas filas; solo escribimos en las filas superiores
                 * para mantener los encabezados en la fila 7.
                 */

                // === Título ===
                $sheet->mergeCells('A1:E1');
                $sheet->setCellValue('A1', 'REPORTE DE AFILIADOS POR ESTADO');
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
                $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // === Institución y gestión ===
                $sheet->mergeCells('A2:C2');
                $sheet->mergeCells('D2:E2');
                $sheet->setCellValue('A2', 'INSTITUCIÓN: Ilustre Colegio de Abogados');
                $sheet->setCellValue('D2', 'GESTIÓN: ' . now()->year);

                // === Estados ===
                $sheet->mergeCells('A3:E3');
                $sheet->setCellValue('A3', 'ESTADOS: ' . $this->estadosText);

                // === Total general ===
                $sheet->mergeCells('A4:E4');
                $sheet->setCellValue('A4', 'TOTAL DE AFILIADOS: ' . $this->total);

                // === Espacio vacío (fila 6) ===
                $sheet->setCellValue('A6', '');

                // === Encabezado de tabla ===
                $headerRow = 7;
                $lastRow = $sheet->getHighestRow();
                $lastColumn = $sheet->getHighestColumn();

                // Encabezado tabla
                $sheet->getStyle("A{$headerRow}:{$lastColumn}{$headerRow}")->applyFromArray([
                    'font' => ['bold' => true],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'E6E6E6'],
                    ],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ]);

                // Bordes generales
                $sheet->getStyle("A{$headerRow}:{$lastColumn}{$lastRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ]);

                // Zebra stripes
                for ($i = $headerRow + 1; $i <= $lastRow; $i++) {
                    if ($i % 2 === 0) {
                        $sheet->getStyle("A{$i}:{$lastColumn}{$i}")->applyFromArray([
                            'fill' => [
                                'fillType' => Fill::FILL_SOLID,
                                'startColor' => ['rgb' => 'F9F9F9'],
                            ],
                        ]);
                    }
                }

                // Auto ancho columnas
                foreach (range('A', $lastColumn) as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }
}
