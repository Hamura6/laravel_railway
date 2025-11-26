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
use Carbon\Carbon;

class ContributionExport implements FromCollection, WithHeadings, WithEvents, WithCustomStartCell, WithTitle
{
    protected $from;
    protected $to;
    protected $institution;
    protected $affiliates;

    public function __construct($from, $to)
    {
        $this->institution = cache('institution');
        $this->from = Carbon::parse($from)->startOfDay();
        $this->to = Carbon::parse($to)->endOfDay();

        $this->affiliates = Affiliate::select('id', 'user_id', 'created_at')
            ->withSum(['payments' => function ($query) {
                $query->where('fee_id', 1)
                      ->where('status', 'Pagado')
                      ->whereBetween('created_at', [$this->from, $this->to]);
            }], 'amount')
            ->with(['user:id,name,last_name,email,ci', 'user.phones:number,user_id'])
            ->orderBy('id', 'desc')
            ->get();
    }

    public function collection()
    {
        return new Collection(
            $this->affiliates->map(function ($affiliate, $index) {
                return [
                    '#' => $index + 1,
                    'Matrícula' => $affiliate->id,
                    'Nombre Completo' => $affiliate->user->name . ' ' . $affiliate->user->last_name,
                    'Monto Aportes' => $affiliate->payments_sum_amount ?? 0,
                    'Fecha Registro' => Carbon::parse($affiliate->created_at)->format('d/m/Y'),
                    'Teléfonos' => $affiliate->user->phones->pluck('number')->implode(', '),
                ];
            })
        );
    }

    public function headings(): array
    {
        return [
            ['#', 'Matrícula', 'Nombre Completo', 'Monto Aportes', 'Fecha Registro', 'Teléfonos']
        ];
    }

    public function startCell(): string
    {
        return 'A7';
    }

    public function title(): string
    {
        return 'Reporte de Pagos';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $lastRow = $sheet->getHighestRow();
                $lastColumn = $sheet->getHighestColumn();

                // === Título ===
                $sheet->mergeCells('A1:F1');
                $sheet->setCellValue('A1', 'REPORTE DE PAGOS');
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
                $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // === Institución y Fechas ===
                $sheet->mergeCells('A2:C2');
                $sheet->mergeCells('D2:F2');
                $sheet->setCellValue('A2', 'INSTITUCIÓN: ' . $this->institution->name);
                $sheet->setCellValue('D2', 'GESTIÓN: ' . now()->year);

                $sheet->mergeCells('A3:C3');
                $sheet->mergeCells('D3:F3');
                $sheet->setCellValue('A3', 'Fecha Desde: ' . $this->from->format('d/m/Y'));
                $sheet->setCellValue('D3', 'Fecha Hasta: ' . $this->to->format('d/m/Y'));

                $sheet->mergeCells('A4:C4');
                $sheet->mergeCells('D4:F4');
                $sheet->setCellValue('A4', 'Cantidad de Afiliados: ' . count($this->affiliates));
                $sheet->setCellValue('D4', 'Total Aportes: ' . number_format($this->affiliates->sum('payments_sum_amount'), 2) . ' Bs.');

                // === Encabezados de tabla ===
                $headerRow = 7;
                $sheet->getStyle("A{$headerRow}:{$lastColumn}{$headerRow}")->applyFromArray([
                    'font' => ['bold' => true],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'E6E6E6']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
                ]);

                // === Bordes generales ===
                $sheet->getStyle("A{$headerRow}:{$lastColumn}{$lastRow}")->applyFromArray([
                    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
                ]);

                // Zebra stripes
                for ($i = $headerRow + 1; $i <= $lastRow; $i++) {
                    if ($i % 2 === 0) {
                        $sheet->getStyle("A{$i}:{$lastColumn}{$i}")->getFill()
                              ->setFillType(Fill::FILL_SOLID)
                              ->getStartColor()->setRGB('F9F9F9');
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
