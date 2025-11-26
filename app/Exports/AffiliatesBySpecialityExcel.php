<?php

namespace App\Exports;

use App\Models\Affiliate;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AffiliatesBySpecialityExcel implements     FromQuery,
    WithMapping,
    WithHeadings,
    WithStyles,
    WithTitle,
    ShouldAutoSize
{
        protected $specialities;
    protected $rowNumber = 0;

    public function __construct(array $specialities)
    {
        $this->specialities = $specialities;
    }

    /**
     * Consulta optimizada con relaciones necesarias.
     */
    public function query()
    {
        return Affiliate::query()
            ->whereHas('professions.specialty', function ($query) {
                $query->whereIn('name', $this->specialities);
            })
            ->with(['user.phones', 'demands', 'professions'])
            ->select('id', 'user_id');
    }

    /**
     * Encabezados de la tabla
     */
    public function headings(): array
    {
        return [
            '#',
            'Matrícula',
            'Afiliado',
            'Email',
            'Celular',
            'Demandas',
            'Especialidades',
        ];
    }

    /**
     * Mapeo de cada fila
     */
    public function map($affiliate): array
    {
        $this->rowNumber++;
        $user = $affiliate->user;
        $phone = $user->phones->first()->number ?? 'Sin número';

        return [
            $this->rowNumber,
            $affiliate->id,
            $user->full_name ?? '',
            $user->email ?? '',
            $phone,
            $affiliate->demands->count(),
            $affiliate->professions->count(),
        ];
    }

    /**
     * Estilos y cabecera del reporte
     */
    public function styles(Worksheet $sheet)
    {
        // Agregar título del reporte arriba
        $sheet->insertNewRowBefore(1, 4);

        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'REPORTE DE AFILIADOS POR ESPECIALIDAD');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

        // Información institucional
        $sheet->mergeCells('A2:E2');
        $sheet->mergeCells('F2:G2');
        $sheet->setCellValue('A2', 'INSTITUCIÓN: Ilustre Colegio de Abogados');
        $sheet->setCellValue('F2', 'GESTIÓN: 2025');

        // Especialidades
        $sheet->mergeCells('A3:G3');
        $sheet->setCellValue('A3', 'ESPECIALIDADES: ' . implode(', ', $this->specialities));

        // Estilos de encabezado
        $headerRow = 5; // porque agregamos 4 filas antes
        $sheet->getStyle("A{$headerRow}:G{$headerRow}")->getFont()->setBold(true);
        $sheet->getStyle("A{$headerRow}:G{$headerRow}")
            ->getFill()->setFillType('solid')
            ->getStartColor()->setRGB('E6E6E6');
        $sheet->getStyle("A{$headerRow}:G{$headerRow}")->getAlignment()->setHorizontal('center');

        // Bordes
        $sheet->getStyle("A{$headerRow}:G" . $sheet->getHighestRow())->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        // Zebra stripes (filas alternadas)
        $highestRow = $sheet->getHighestRow();
        for ($i = $headerRow + 1; $i <= $highestRow; $i++) {
            if ($i % 2 === 0) {
                $sheet->getStyle("A{$i}:G{$i}")
                    ->getFill()->setFillType('solid')
                    ->getStartColor()->setRGB('F9F9F9');
            }
        }

        return [];
    }

    public function title(): string
    {
        return 'Afiliados';
    }
}
