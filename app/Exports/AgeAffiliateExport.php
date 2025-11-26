<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;

use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Events\AfterSheet;

class AgeAffiliateExport implements FromCollection, WithHeadings, WithTitle, WithEvents
{
    protected $affiliates;
    protected $minor;
    protected $maximum;
    protected $status;
    protected $masculino;
    protected $femenino;

    public function __construct($affiliates, $minor, $maximum, $status, $masculino, $femenino)
    {
        $this->affiliates = $affiliates;
        $this->minor = $minor;
        $this->maximum = $maximum;
        $this->status = $status ?: 'Todos';
        $this->masculino = $masculino;
        $this->femenino = $femenino;
    }

    public function collection()
    {
        return collect($this->affiliates)->map(function ($item, $index) {
            return [
                '#' => $index + 1,
                'Nombre Completo' => $item->full_name,
                'Edad' => $item->age,
                'Correo' => $item->email,
                'Género' => $item->gender,
                'Teléfonos' => $item->phones,
            ];
        });
    }

    public function headings(): array
    {
        // Solo encabezados de tabla, los demás datos los insertaremos con AfterSheet
        return [
            ['#', 'Nombre Completo', 'Edad', 'Correo', 'Género', 'Teléfonos'],
        ];
    }

    public function title(): string
    {
        return 'Afiliados por edad';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Insertar filas antes de la tabla para la cabecera general
                $sheet->insertNewRowBefore(1, 6);

                // === Título ===
                $sheet->mergeCells('A1:F1');
                $sheet->setCellValue('A1', 'REPORTE DE AFILIADOS POR EDAD');
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
                $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // === Institución y gestión ===
                $sheet->mergeCells('A2:D2');
                $sheet->mergeCells('E2:F2');
                $sheet->setCellValue('A2', 'INSTITUCIÓN: Ilustre Colegio de Abogados');
                $sheet->setCellValue('E2', 'GESTIÓN: ' . now()->year);

                // === Totales por género ===
                $sheet->mergeCells('A3:C3');
                $sheet->setCellValue('A3', 'Masculino: ' . $this->masculino . ' | Femenino: ' . $this->femenino . ' | Total: ' . ($this->masculino + $this->femenino));

                // === Rango de edad ===
                $sheet->mergeCells('A4:F4');
                $sheet->setCellValue('A4', 'RANGO DE EDAD: De ' . $this->minor . ' a ' . $this->maximum . ' años');

                // === Estado ===
                $sheet->mergeCells('A5:F5');
                $sheet->setCellValue('A5', 'ESTADO: ' . $this->status);

                // === Espacio ===
                $sheet->setCellValue('A6', ''); // fila vacía

                // === Encabezado de tabla ===
                $headerRow = 7;
                $lastRow = $sheet->getHighestRow();
                $lastColumn = $sheet->getHighestColumn();

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

                // === Bordes generales ===
                $sheet->getStyle("A{$headerRow}:{$lastColumn}{$lastRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ]);

                // === Zebra stripes ===
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

                // === Ajuste automático de columnas ===
                foreach (range('A', $lastColumn) as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }
}
