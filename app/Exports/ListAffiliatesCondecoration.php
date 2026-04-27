<?php

namespace App\Exports;

use App\Models\Recognition;
use App\Models\Affiliate;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ListAffiliatesCondecoration implements FromCollection, WithHeadings, WithMapping, WithStyles, WithCustomStartCell
{
  
    protected $recognition;
    protected $affiliates;   // Colección de afiliados resultante de la consulta personalizada

    public function __construct($recognitionId)
    {
        // Obtener el reconocimiento
        $this->recognition = Recognition::findOrFail($recognitionId);

        // Calcular fecha límite (fecha de reconocimiento - años según tipo)
        $fechaLimite = Carbon::parse($this->recognition->date)
            ->subYears(intval($this->recognition->type));

        // Construir la consulta exactamente como la proporcionaste
        $query = Affiliate::query()
            ->select('id', 'user_id', 'created_at', 'status')
            ->with([
                'user:id,name,last_name,gender',
                'user.phones:id,user_id,number',
            ])
            ->whereHas('user.roles', fn($q) => $q->where('name', 'Afiliado'))
            ->whereDate('created_at', '<=', $fechaLimite)
            ->when($this->recognition->type == 'Canaston', function ($query) {
                // Para Canastón: excluir afiliados que deben POR LO MENOS 1 cuota del año pasado
                $query->whereDoesntHave('payments', function ($q) {
                    $q->where('fee_id', 1)
                        ->where('status', 'Por pagar')
                        ->whereYear('date', now()->subYear()->year);
                });
            }, function ($query) {
                // Para otros tipos: solo afiliados Activo/Inactivo y que no tengan reconocimientos previos del mismo tipo
                $query->whereIn('status', ['Activo', 'Inactivo'])
                    ->whereDoesntHave('recognitions', function ($q) {
                        $q->where('type', $this->recognition->type);
                    });
            })
            ->withCount([
                'payments as pending_payments_count' => function ($q) {
                    $q->where('fee_id', 1)
                        ->where('status', 'Por pagar');
                },
            ])
            ->withCasts(['created_at' => 'date:Y-m-d'])
            ->orderBy('id', 'desc');

        // Ejecutar la consulta y guardar el resultado
        $this->affiliates = $query->get();
    }

    public function collection()
    {
        return $this->affiliates;
    }

    public function map($affiliate): array
    {
    
        $fechaLiteral = Carbon::parse($affiliate->created_at)->translatedFormat('d \d\e F \d\e Y');

        // Nombre completo sin título (ya que no se cargó 'title' en la consulta)
        $nombre = Str::ascii($affiliate->user->title . ' ' .$affiliate->user->name . ' ' . $affiliate->user->last_name);

        // Teléfono: tomar el primero si existe
        $telefono = optional($affiliate->user->phones->first())->number ?? 'N/A';

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
        return 'A4';
    }

    public function styles(Worksheet $sheet)
    {
        // Título principal
        $sheet->mergeCells('A1:E1');
        $sheet->setCellValue('A1', 'REPORTE DE ' . strtoupper(trans($this->recognition->type)));
        $sheet->getStyle('A1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 16, 'color' => ['argb' => 'FFFFFFFF']],
            'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF2196F3']],
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
        ]);

        // Información del reconocimiento
        $sheet->setCellValue('A2', 'Fecha: ' . $this->recognition->date);
        $sheet->setCellValue('B2', 'Tipo: ' . utf8_decode(trans($this->recognition->type)));
        $sheet->setCellValue('C2', 'Nombre: ' . $this->recognition->name);
        // Cantidad de participantes: usamos la colección obtenida por la consulta personalizada
        $sheet->setCellValue('D2', 'Cantidad de participantes: ' . $this->affiliates->count());
        $sheet->setCellValue('E2', 'Tiempo restante: ' . $this->recognition->remaining_days);

        $sheet->getStyle('A2:E2')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FFF5F5F5']],
        ]);

        // Estilo de los encabezados (fila 4)
        $sheet->getStyle('A4:E4')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
            'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF4CAF50']],
            'alignment' => ['horizontal' => 'center'],
        ]);

        // Ajustar automáticamente el ancho de las columnas
        foreach (range('A', 'E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }
}
