<?php

namespace App\Exports;

use App\Models\Affiliate;
use App\Models\Recognition;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ListAffiliatesCondecoration implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithStyles,
    WithCustomStartCell
{
    protected Recognition $recognition;
    protected Collection $affiliates;

    public function __construct(int $recognitionId)
    {
        $this->recognition = Recognition::findOrFail($recognitionId);
        $this->affiliates  = $this->buildQuery()->get();
    }

    // =========================================================
    // MAATWEBSITE CONTRACTS
    // =========================================================

    public function collection(): Collection
    {
        return $this->affiliates;
    }

    public function headings(): array
    {
        return [
            'Matrícula',
            'Nombre Completo',
            'Antigüedad',
            'Fecha Inscripción',
            'Teléfono',
        ];
    }

    public function map($affiliate): array
    {
        return [
            $affiliate->id,
            Str::ascii(
                trim("{$affiliate->user->title} {$affiliate->user->name} {$affiliate->user->last_name}")
            ),
            $affiliate->antique,
            Carbon::parse($affiliate->created_at)->translatedFormat('d \d\e F \d\e Y'),
            optional($affiliate->user->phones->first())->number ?? 'N/A',
        ];
    }

    public function startCell(): string
    {
        return 'A4';
    }

    public function styles(Worksheet $sheet): void
    {
        // ── Título principal ──────────────────────────────────
        $sheet->mergeCells('A1:E1');
        $sheet->setCellValue('A1', 'REPORTE DE ' . strtoupper(trans($this->recognition->type)));
        $sheet->getStyle('A1')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 16, 'color' => ['argb' => 'FFFFFFFF']],
            'fill'      => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF2196F3']],
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
        ]);

        // ── Metadata del reconocimiento ───────────────────────
        $sheet->setCellValue('A2', 'Fecha: '  . $this->recognition->date);
        $sheet->setCellValue('B2', 'Tipo: '   . trans($this->recognition->type));
        $sheet->setCellValue('C2', 'Nombre: ' . $this->recognition->name);
        $sheet->setCellValue('D2', 'Participantes: ' . $this->affiliates->count());
        $sheet->setCellValue('E2', 'Tiempo restante: ' . $this->recognition->remaining_days);

        $sheet->getStyle('A2:E2')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FFF5F5F5']],
        ]);

        // ── Encabezados (fila 4) ──────────────────────────────
        $sheet->getStyle('A4:E4')->applyFromArray([
            'font'      => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
            'fill'      => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF4CAF50']],
            'alignment' => ['horizontal' => 'center'],
        ]);

        // ── Ancho automático ──────────────────────────────────
        foreach (range('A', 'E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }

    // =========================================================
    // QUERY BUILDER
    // =========================================================

    private function buildQuery(): Builder
    {
        return Affiliate::query()
            ->select('id', 'user_id', 'created_at', 'status')
            ->with([
                'user:id,name,last_name,gender',
                'user.phones:id,user_id,number',
            ])
            ->whereHas('user.roles', fn (Builder $q) => $q->where('name', 'Afiliado'))
            ->tap(fn (Builder $q) => $this->applyTypeFilter($q))
            ->withCount([
                'payments as pending_payments_count' => fn (Builder $q) => $q
                    ->where('fee_id', 1)
                    ->where('status', 'Por pagar'),
            ])
            ->withCasts(['created_at' => 'date:Y-m-d'])
            ->orderByDesc('id');
    }

    // =========================================================
    // FILTROS POR TIPO
    // =========================================================

    private function applyTypeFilter(Builder $query): void
    {
        match ($this->recognition->type) {
            'Canaston'            => $this->applyCanastonFilter($query),
            'professional_career' => $this->applyProfessionalCareerFilter($query),
            'Inscripcion'         => $this->applyInscripcionFilter($query),
            default               => $this->applyDefaultFilter($query),
        };
    }

    /**
     * Sin filtro de fecha ni status.
     * Excluye afiliados con cuota 1 pendiente del año anterior.
     */
    private function applyCanastonFilter(Builder $query): void
    {
        $query->whereDoesntHave(
            'payments',
            fn (Builder $q) => $q
                ->where('fee_id', 1)
                ->where('status', 'Por pagar')
                ->whereYear('date', now()->subYear()->year)
        );
    }

    /**
     * Solo afiliados con al menos 15 años de antigüedad.
     */
    private function applyProfessionalCareerFilter(Builder $query): void
    {
        $query->whereDate('affiliates.created_at', '<=', now()->subYears(15));
    }

    /**
     * Afiliados inscritos en la ventana de un año alrededor de la fecha límite.
     * Sin reconocimiento previo del mismo tipo.
     */
    private function applyInscripcionFilter(Builder $query): void
    {
        ['limit' => $fechaLimite] = $this->getDateBoundaries();

        $query
            ->whereIn('status', ['Activo', 'Inactivo'])
            ->whereDate('affiliates.created_at', '>=', $fechaLimite->copy()->subYear()->addDay())
            ->whereDate('affiliates.created_at', '<=', $fechaLimite->copy()->addYear()->subDay())
            ->whereDoesntHave(
                'recognitions',
                fn (Builder $q) => $q->where('type', $this->recognition->type)
            );
    }

    /**
     * Afiliados dentro de la ventana de antigüedad calculada según el tipo.
     * Sin reconocimiento previo del mismo tipo.
     */
    private function applyDefaultFilter(Builder $query): void
    {
        ['limit' => $fechaLimite, 'from' => $fechaHasta] = $this->getDateBoundaries();

        $query
            ->whereIn('status', ['Activo', 'Inactivo'])
            ->whereDate('affiliates.created_at', '<=', $fechaLimite)
            ->whereDate('affiliates.created_at', '>=', $fechaHasta)
            ->whereDoesntHave(
                'recognitions',
                fn (Builder $q) => $q->where('type', $this->recognition->type)
            );
    }

    // =========================================================
    // HELPERS
    // =========================================================

    /**
     * Calcula las fechas límite una sola vez.
     * Siempre usar copy() antes de operar para evitar mutación de Carbon.
     *
     * @return array{ limit: Carbon, from: Carbon }
     */
    private function getDateBoundaries(): array
    {
        $limit = Carbon::parse($this->recognition->date)
            ->subYears((int) $this->recognition->type)
            ->startOfDay();

        return [
            'limit' => $limit,
            'from'  => $limit->copy()->subYears(1)->addDay(),
        ];
    }
}