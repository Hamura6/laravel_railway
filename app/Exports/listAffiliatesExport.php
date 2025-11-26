<?php

namespace App\Exports;

use App\Models\Recognition;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Illuminate\Support\Str;
use Carbon\Carbon;
class listAffiliatesExport implements  FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnFormatting, WithCustomStartCell
{
    
    protected $recognition;

    public function __construct($recognitionId)
    {
        $this->recognition = Recognition::select('id', 'date', 'type', 'name')
            ->with([
                'affiliates' => function ($query) {
                    $query->select('affiliates.id', 'user_id',  'affiliates.created_at')
                        ->with([
                            'user' => function ($q) {
                                $q->select('id', 'name', 'last_name', 'gender')
                                    ->with(['phones:id,user_id,number']);
                            }
                        ]);
                }
            ])->findOrFail($recognitionId);
    }

    public function collection()
    {
        return $this->recognition->affiliates;
    }

    public function map($affiliate): array
    {
        $fechaLiteral = Carbon::parse($affiliate->created_at)->translatedFormat('d \d\e F \d\e Y');
        $nombre = Str::ascii($affiliate->user->title . ' ' . $affiliate->user->name . ' ' . $affiliate->user->last_name);

        return [
            $affiliate->id,
            $nombre,
            $affiliate->antique,
            $fechaLiteral,
            optional($affiliate->user->phones->first())->number ?? 'N/A',
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Nombre Completo',
            'Antigüedad',
            'Fecha Inscripción',
            'Teléfono',
        ];
    }

    public function startCell(): string
    {
        return 'A4'; // Dejamos espacio para título e info general
    }

    public function styles(Worksheet $sheet)
    {
        // Fila 1: título principal
        $sheet->mergeCells('A1:E1');
        $sheet->setCellValue('A1', 'REPORTE DE ' . strtoupper($this->recognition->type));
        $sheet->getStyle('A1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 16, 'color' => ['argb' => 'FFFFFFFF']],
            'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF2196F3']],
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
        ]);

        // Fila 2: información general
        $sheet->setCellValue('A2', 'Fecha: ' . $this->recognition->date);
        $sheet->setCellValue('B2', 'Tipo / Deuda: ' . $this->recognition->type);
        $sheet->setCellValue('C2', 'Nombre: ' . $this->recognition->name);
        $sheet->setCellValue('D2', 'Cantidad de participantes: ' . $this->recognition->affiliates->count());
        $sheet->setCellValue('E2', 'Tiempo restante: ' . $this->recognition->remaining_days);

        $sheet->getStyle('A2:E2')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FFF5F5F5']],
        ]);

        // Cabeceras de la tabla (fila 4)
        $sheet->getStyle('A4:E4')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
            'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF4CAF50']],
            'alignment' => ['horizontal' => 'center'],
        ]);

        // Ajuste de ancho de columnas
        foreach (range('A', 'E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
