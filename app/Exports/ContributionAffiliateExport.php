<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use App\Models\Affiliate;
use App\Models\Payment;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithTitle;

use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Carbon\Carbon;

class ContributionAffiliateExport implements     FromCollection, WithHeadings, WithEvents, WithCustomStartCell, WithTitle
{ protected $from;
    protected $to;
    protected $affiliate;
    protected $institution;
    protected $pagos;

    public function __construct($id, $from, $to)
    {
        $this->institution = cache('institution');

        $this->from = Carbon::parse($from)->startOfDay();
        $this->to   = Carbon::parse($to)->endOfDay();

        $this->affiliate = Affiliate::select('id','user_id','status')
            ->with(['user:id,name,last_name','user.phones:number,user_id'])
            ->find($id);

        $this->pagos = Payment::where('status','Pagado')
            ->where('affiliate_id', $this->affiliate->id)
            ->whereBetween('created_at', [$this->from, $this->to])
            ->with(['user:id,name,last_name'])
            ->get();
    }

    public function collection()
    {
        return new Collection(
            $this->pagos->map(function($pago, $index){
                return [
                    '#'           => $index + 1,
                    'Fecha'       => Carbon::parse($pago->updated_at)->format('d/m/Y H:i'),
                    'Recaudador'  => $pago->user->full_name,
                    'Aportes'     => $pago->fecha_display,
                    'Descargo'    => $pago->type,
                    'Total'       => number_format($pago->amount, 2),
                ];
            })
        );
    }

    public function headings(): array
    {
        return [
            ['#', 'Fecha', 'Recaudador', 'Aportes', 'Descargo', 'Total']
        ];
    }

    public function startCell(): string
    {
        return 'A8';
    }

    public function title(): string
    {
        return 'Pagos Afiliado';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();
                $lastRow    = $sheet->getHighestRow();
                $lastColumn = $sheet->getHighestColumn();

                /** ---------------------------------------------
                 * TÍTULO GRANDE
                 ----------------------------------------------*/
                $sheet->mergeCells('A1:F1');
                $sheet->setCellValue('A1', 'REPORTE DE PAGOS POR AFILIADO');
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
                $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

                /** ---------------------------------------------
                 * INFORMACIÓN GENERAL (igual a tu PDF)
                 ----------------------------------------------*/
                // Institución y gestión
                $sheet->mergeCells('A2:C2');
                $sheet->mergeCells('D2:F2');
                $sheet->setCellValue('A2', 'INSTITUCIÓN: '.$this->institution->name);
                $sheet->setCellValue('D2', 'GESTIÓN: '.now()->year);

                // Nombre - Matrícula
                $sheet->mergeCells('A3:C3');
                $sheet->mergeCells('D3:F3');
                $sheet->setCellValue('A3', 'Nombre: '.$this->affiliate->user->full_name);
                $sheet->setCellValue('D3', 'Matrícula: '.$this->affiliate->id);

                // Fecha - Estado
                $sheet->mergeCells('A4:C4');
                $sheet->mergeCells('D4:F4');
                $sheet->setCellValue('A4', 'Fecha: '.$this->from->format('d/m/Y').' al '.$this->to->format('d/m/Y'));
                $sheet->setCellValue('D4', 'Estado: '.$this->affiliate->status);

                /** ---------------------------------------------
                 * ESTILO DEL ENCABEZADO DE TABLA
                 ----------------------------------------------*/
                $headerRow = 8;

                $sheet->getStyle("A{$headerRow}:{$lastColumn}{$headerRow}")
                    ->applyFromArray([
                        'font' => ['bold' => true],
                        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => ['rgb' => 'E6E6E6']
                        ],
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN
                            ]
                        ]
                    ]);

                /** ---------------------------------------------
                 * BORDES GENERALES
                 ----------------------------------------------*/
                $sheet->getStyle("A{$headerRow}:{$lastColumn}{$lastRow}")
                    ->applyFromArray([
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN
                            ]
                        ]
                    ]);

                /** ---------------------------------------------
                 * ZEBRA STRIPES (filas alternadas)
                 ----------------------------------------------*/
                for ($i = $headerRow + 1; $i <= $lastRow; $i++) {
                    if ($i % 2 === 0) {
                        $sheet->getStyle("A{$i}:{$lastColumn}{$i}")
                            ->getFill()->setFillType(Fill::FILL_SOLID)
                            ->getStartColor()->setRGB('F9F9F9');
                    }
                }

                /** ---------------------------------------------
                 * AUTO-SIZE COLUMNAS
                 ----------------------------------------------*/
                foreach(range('A', $lastColumn) as $col){
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            }
        ];
    }
}
