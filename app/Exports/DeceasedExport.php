<?php

namespace App\Exports;

use App\Models\Deceased;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class DeceasedExport implements FromCollection, WithHeadings, WithEvents, WithStyles
{
    public function collection()
    {
        return Deceased::with([
            'affiliate:id,created_at,user_id',
            'affiliate.user:name,last_name,id,ci'
        ])
        ->get()
        ->map(function ($deceased) {

            if ($deceased->affiliate->created_at instanceof Carbon) {
                $fechaRegistro = $deceased->affiliate->created_at->format('Y-m-d');
            } elseif ($deceased->affiliate->created_at) {
                $fechaRegistro = Carbon::parse($deceased->affiliate->created_at)->format('Y-m-d');
            } else {
                $fechaRegistro = '';
            }

            return [
                'Matricula' => $deceased->affiliate->id ?? '',
                'Nombre Completo' => $deceased->affiliate->user->full_name ?? '',
                'Fecha Registro' => $fechaRegistro,
                'CI' => $deceased->affiliate->user->ci ?? '',
                'Fecha Fallecimiento' => $deceased->date ?? '',
                'Descripcion' => $deceased->description ?? '',
                'Mausoleo' => $deceased->mausoleum ?? '',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Matricula',
            'Nombre Completo',
            'Fecha de Registro',
            'C.I',
            'Fecha de Fallecimiento',
            'Descripcion',
            'En el Mausoleo'
        ];
    }

    /**
     * Estilo de cabecera
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => '000000'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'D9D9D9'], // plomo suave
                ],
            ],
        ];
    }

    /**
     * Filas intercaladas (zebra) y bordes
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();
                $lastRow = $sheet->getHighestRow();

                // Autoajustar columnas
                foreach (range('A', 'G') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }

                // Bordes generales
                $sheet->getStyle("A1:G{$lastRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => 'BFBFBF'],
                        ],
                    ],
                ]);

                // Filas intercaladas
                for ($row = 2; $row <= $lastRow; $row++) {
                    if ($row % 2 == 0) {
                        $sheet->getStyle("A{$row}:G{$row}")
                            ->getFill()
                            ->setFillType(Fill::FILL_SOLID)
                            ->getStartColor()
                            ->setRGB('F2F2F2'); // gris claro
                    }
                }
            },
        ];
    }
}
