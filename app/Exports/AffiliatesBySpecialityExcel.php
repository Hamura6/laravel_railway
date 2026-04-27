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

class AffiliatesBySpecialityExcel implements FromQuery, WithMapping, WithHeadings, WithStyles, WithTitle, ShouldAutoSize
{
    protected $specialities;
    protected $rowNumber = 0;

    public function __construct(array $specialities)
    {
        $this->specialities = $specialities;
    }

    public function query()
    {
        return Affiliate::query()
            ->whereHas('professions.specialty', function ($query) {
                $query->whereIn('name', $this->specialities);
            })
            ->with(['user.phones', 'demands', 'professions'])
            ->select('id', 'user_id', 'address_office', 'address_number', 'zone');
    }


    public function headings(): array
    {
        return [
            '#',
            'Matrícula',
            'Afiliado',
            'Email',
            'Direc. de Oficina Procesal',
            'Celular',
            'Cant. Demandas',
            'Cant. Especialidades',
        ];
    }


    public function map($affiliate): array
    {
        $this->rowNumber++;
        $user = $affiliate->user;
        $phone = $user->phones->first()->number ?? 'Sin número';
        $office = $affiliate->address_office . ' No ' . $affiliate->address_number . ' / ' . $affiliate->zone;
        $specialtiesCount = $affiliate->professions->count();

        return [
            $this->rowNumber,
            $affiliate->id,
            $user->full_name ?? '',
            $user->email ?? '',
            $office,
            $phone,
            $affiliate->demands->count(),
            $specialtiesCount,
        ];
    }


    public function styles(Worksheet $sheet)
    {

        $sheet->insertNewRowBefore(1, 4);


        $sheet->mergeCells('A1:H1');
        $sheet->setCellValue('A1', 'REPORTE DE AFILIADOS POR ESPECIALIDAD');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');


        $sheet->mergeCells('A2:E2');
        $sheet->mergeCells('F2:H2');
        $sheet->setCellValue('A2', 'INSTITUCIÓN: Ilustre Colegio de Abogados');
        $sheet->setCellValue('F2', 'GESTIÓN: 2025');


        $sheet->mergeCells('A3:H3');
        $sheet->setCellValue('A3', 'ESPECIALIDADES: ' . implode(', ', $this->specialities));


        $headerRow = 5; // porque agregamos 4 filas antes
        $sheet->getStyle("A{$headerRow}:H{$headerRow}")->getFont()->setBold(true);
        $sheet->getStyle("A{$headerRow}:H{$headerRow}")
            ->getFill()->setFillType('solid')
            ->getStartColor()->setRGB('E6E6E6');
        $sheet->getStyle("A{$headerRow}:H{$headerRow}")->getAlignment()->setHorizontal('center');


        $sheet->getStyle("A{$headerRow}:H" . $sheet->getHighestRow())->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);


        $highestRow = $sheet->getHighestRow();
        for ($i = $headerRow + 1; $i <= $highestRow; $i++) {
            if ($i % 2 === 0) {
                $sheet->getStyle("A{$i}:H{$i}")
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
