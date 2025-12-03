<?php

namespace App\Livewire;

use App\Models\Affiliate;
use App\Models\Fee;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DashboardComponent extends Component
{
    public string $title = '';
    public $date=2025;

    public function mount()
    {
        $this->title = 'Dashboard';
        $this->authorize('manager');
    }

    public function render()
    {
         $currentYear = now()->year;
        \DB::listen(fn($q) => logger()->debug('SQL ' . make_query_sql($q)));

        // $sql = "
        //     SELECT
        //         SUM(CASE WHEN p.fee_id = 1 THEN p.amount ELSE 0 END) AS aportes,
        //         SUM(p.amount) AS prest
        //     FROM payments p
        //     INNER JOIN affiliates a
        //         ON a.id = p.affiliate_id
        //         AND a.status NOT IN ('Exento', 'Retirada', 'Licencia')
        //     WHERE
        //         p.status = 'Por pagar'
        //         AND YEAR(p.date) = $currentYear
        // ";

        // $paymentsData = DB::selectOne($sql);
        // dd($paymentsData);


        $paymentsData = DB::table('payments')
            ->selectRaw("
                SUM(CASE WHEN fee_id = 1 THEN amount ELSE 0 END) as aportes,
                SUM(amount) as prest
            ")
            ->where('status', 'Por pagar')
            ->whereYear('date', $currentYear)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('affiliates')
                    ->whereColumn('affiliates.id', 'payments.affiliate_id')
                    ->whereNotIn('affiliates.status', ['Exento', 'Retirada', 'Licencia']);
            })
            ->first();


        $planes = DB::table('plans')
            ->selectRaw('SUM(plans.amount) as total')
            ->whereExists(function ($query) use ($currentYear) {
                $query->select(DB::raw(1))
                    ->from('payments')
                    ->whereColumn('payments.id', 'plans.payment_id')
                    ->where('payments.status', 'Por pagar')
                    ->whereYear('payments.date', $currentYear)
                    ->whereExists(function ($subQuery) {
                        $subQuery->select(DB::raw(1))
                            ->from('affiliates')
                            ->whereColumn('affiliates.id', 'payments.affiliate_id')
                            ->whereNotIn('affiliates.status', ['Exento', 'Retirada', 'Licencia']);
                    });
            })
            ->first()
            ->total ?? 0;

        $aportes = $paymentsData->aportes ?? 0;
        $prest = $paymentsData->prest ?? 0;
        $total_tramites = $prest - $planes;
        $porc_aportes = $total_tramites > 0 ? ($aportes / $total_tramites) * 100 : 0;

        $result = [
            "aportes" => $aportes,
            "total_tramites" => $total_tramites - $aportes,
            "porcentaje_aportes" => round($porc_aportes, 2),
            "porcentaje_restante" => round(100 - $porc_aportes, 2)
        ];

        $currentYear = now()->year;

        // Consulta de fees corregida
        $fees = Fee::select('id', 'name')
            ->withSum(['payments as total_por_pagar' => function ($q) use ($currentYear) {
                $q->where('status', 'Por pagar')
                    ->whereYear('date', $currentYear);
            }], 'amount')
            ->withSum(['plans as total_pagado' => function ($q) use ($currentYear) {
                $q->whereHas('payment', function ($q2) use ($currentYear) {
                    $q2->where('status', 'Por pagar')
                        ->whereYear('date', $currentYear);
                });
            }], 'amount')
            ->get()
            ->map(function ($fee) {
                return [
                    'name' => $fee->name,
                    'total_por_pagar' => $fee->total_por_pagar ?? 0,
                    'total_pagado' => $fee->total_pagado ?? 0,
                    'saldo_final' => ($fee->total_por_pagar ?? 0) - ($fee->total_pagado ?? 0),
                ];
            });

        $feesJson = $fees->toJson();

        // Solo payments pagados con fee_id = 1
        $pagos = DB::table('payments')
            ->selectRaw("MONTH(updated_at) as month, SUM(amount) as total")
            ->whereYear('updated_at', $currentYear)
            ->where('status', 'pagado')
            ->where('fee_id', 1)
            ->groupBy(DB::raw('MONTH(updated_at)'))
            ->get()->keyBy('month');

        $dataMonths = [
            [
                'mes' => 'Enero',
                'total' => 0,
            ],
            [
                'mes' => 'Febrero',
                'total' => 0,
            ],
            [
                'mes' => 'Marzo',
                'total' => 0,
            ],
            [
                'mes' => 'Abril',
                'total' => 0,
            ],
            [
                'mes' => 'Mayo',
                'total' => 0,
            ],
            [
                'mes' => 'Junio',
                'total' => 0,
            ],
            [
                'mes' => 'Julio',
                'total' => 0,
            ],
            [
                'mes' => 'Agosto',
                'total' => 0,
            ],
            [
                'mes' => 'Septiembre',
                'total' => 0,
            ],
            [
                'mes' => 'Octubre',
                'total' => 0,
            ],
            [
                'mes' => 'Noviembre',
                'total' => 0,
            ],
            [
                'mes' => 'Diciembre',
                'total' => 0,
            ]
        ];

        foreach ($dataMonths as $mothIndex => $value)
            $dataMonths[$mothIndex + 1]['total'] = $pagos[$mothIndex + 1]->total ?? 0;

        $estatus = Affiliate::selectRaw('status, COUNT(*) as subtotal')
            ->groupBy('status')
            ->get();

        $estatusJson = $estatus->map(function ($e) {
            return [
                'status' => $e->status,
                'total'  => (int)$e->subtotal,
            ];
        })->toJson();



 return view('livewire.dashboard.index', compact('result', 'feesJson', 'estatusJson', 'dataMonths'));    }
}
