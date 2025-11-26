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
    }

    public function render()
    {
        /* $totales = Affiliate::whereHas('user.roles', function ($q) {
            $q->where('id', 1);
        })
            ->whereNotIn('status', ['Exento', 'Retirada', 'Licencia'])
            ->withSum(['payments as aportes' => function ($query) {
                $query->where('status', 'Por pagar')
                    ->where('fee_id', 1);
            }], 'amount')
            ->withSum(['payments as prest' => function ($query) {
                $query->where('status', 'Por pagar');
            }], 'amount')
            ->withSum(['plans as planes' => function ($query) {
                $query->whereHas('payment', fn($q) => $q->where('status', 'Por pagar'));
            }], 'amount')
            ->withCount(['payments as aportes_cant' => function ($query) {
                $query->where('status', 'Por pagar')
                    ->where('fee_id', 1);
            }])
            ->get()
            ->reduce(function ($carry, $item) {
                $carry['aportes']       += $item->aportes ?? 0;
                $carry['prest']         += $item->prest ?? 0;
                $carry['planes']        += $item->planes ?? 0;
                $carry['aportes_cant']  += $item->aportes_cant ?? 0;
                return $carry;
            }, [
                'aportes'      => 0,
                'prest'        => 0,
                'planes'       => 0,
                'aportes_cant' => 0
            ]);
            
        $total_tramites = $totales['prest'] - $totales['planes'];
        $porc_aportes = $total_tramites > 0 ? ($totales['aportes'] / $total_tramites) * 100 : 0;
        $porc_restante = $total_tramites > 0 ? 100 - $porc_aportes : 0;
        $result = [
            "aportes" => $totales['aportes'],
            "total_tramites" => $total_tramites,
            "porcentaje_aportes" => round($porc_aportes, 2),
            "porcentaje_restante" => round($porc_restante, 2)
        ];



        $fees = Fee::select('id', 'name')
            // Suma de pagos pendientes
            ->withSum(['payments as total_por_pagar' => function ($q) {
                $q->where('status', 'Por pagar');
            }], 'amount')
            // Suma de montos pagados en planes, solo si el payment está 'Por pagar'
            ->withSum(['plans as total_pagado' => function ($q) {
                $q->whereHas('payment', function ($q2) {
                    $q2->where('status', 'Por pagar');
                });
            }], 'amount')
            ->get()
            ->map(function ($fee) {
                $fee->saldo_final =
                    ($fee->total_por_pagar ?? 0) -
                    ($fee->total_pagado ?? 0);

                return $fee;
            });


        $feesJson = $fees->map(function ($f) {
            return [
                'name' => $f->name,
                'total_por_pagar' => $f->total_por_pagar ?? 0,
                'total_pagado' => $f->total_pagado ?? 0,
                'saldo_final' => $f->saldo_final ?? 0
            ];
        })->toJson();







        $pagos = DB::table('payments')
            ->select(
                DB::raw("MONTH(updated_at) as month"),
                DB::raw("SUM(amount) as total")
            )
            ->where('status', 'pagado')
            ->where('fee_id', 1)
            ->whereYear('updated_at', 2025)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        $mesesEsp = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre'
        ];

        $totalesPorMes = [];
        foreach ($mesesEsp as $num => $nombre) {
            $totalesPorMes[] = [
                'mes' => $nombre,
                'total' => isset($pagos[$num]) ? $pagos[$num]->total : 0
            ];
        }

        $totalesJson = json_encode($totalesPorMes);


        $estatus = Affiliate::selectRaw('status, COUNT(*) as subtotal')
            ->groupBy('status')
            ->get();
        $estatusJson = $estatus->map(function ($e) {
            return [
                'status' => $e->status, 
                'total'  => (int)$e->subtotal,
            ];
        })->toJson();

 */
$currentYear = now()->year;

// Solo 2 consultas rápidas sin JOINs complejos
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
    ->withSum(['payments as total_por_pagar' => function($q) use ($currentYear) {
        $q->where('status', 'Por pagar')
          ->whereYear('date', $currentYear);
    }], 'amount')
    ->withSum(['plans as total_pagado' => function($q) use ($currentYear) {
        $q->whereHas('payment', function($q2) use ($currentYear) {
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

// Payments pagados
/* $paymentsPagados = DB::table('payments')
    ->selectRaw("MONTH(date) as month, SUM(amount) as total")
    ->whereYear('updated_at', $currentYear)
    ->where('status', 'pagado')
    ->where('fee_id', 1)
    ->groupBy(DB::raw('MONTH(date)'))
    ->get()
    ->keyBy('month');

// Plans de payments por pagar
$plansPorPagar = DB::table('plans')
    ->join('payments', 'payments.id', '=', 'plans.payment_id')
    ->selectRaw("MONTH(payments.updated_at) as month, SUM(plans.amount) as total")
    ->whereYear('payments.updated_at', $currentYear)
    ->where('payments.status', 'Por pagar')
    ->where('payments.fee_id', 1)
    ->groupBy(DB::raw('MONTH(payments.updated_at)'))
    ->get()
    ->keyBy('month');

// Combinar resultados
$meses = [
    1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio',
    7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
];

$totalesJson = collect($meses)->map(function ($nombre, $num) use ($paymentsPagados, $plansPorPagar) {
    $totalPagado = $paymentsPagados->get($num)->total ?? 0;
    $totalPorPagar = $plansPorPagar->get($num)->total ?? 0;
    
    return [
        'mes' => $nombre,
        'total' => $totalPagado + $totalPorPagar
    ];
})->values()->toJson(); */

// Solo payments pagados con fee_id = 1
$pagos = DB::table('payments')
    ->selectRaw("MONTH(updated_at) as month, SUM(amount) as total")
    ->whereYear('updated_at', $currentYear)
    ->where('status', 'pagado')
    ->where('fee_id', 1)
    ->groupBy(DB::raw('MONTH(updated_at)'))
    ->orderBy('month')
    ->get()
    ->keyBy('month');

$meses = [
    1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio',
    7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
];

$totalesJson = collect($meses)->map(function ($nombre, $num) use ($pagos) {
    return [
        'mes' => $nombre,
        'total' => $pagos->get($num)->total ?? 0
    ];
})->values()->toJson();
/* $estatusJson = Affiliate::selectRaw('status, COUNT(*) as total')
    ->groupBy('status')
    ->get()
    ->toJson(); */
   $estatus = Affiliate::selectRaw('status, COUNT(*) as subtotal')
    ->groupBy('status')
    ->get();

$estatusJson = $estatus->map(function ($e) {
    return [
        'status' => $e->status, 
        'total'  => (int)$e->subtotal,
    ];
})->toJson();




        return view('livewire.dashboard.index', compact('result', 'feesJson', 'estatusJson', 'totalesJson'));
    }
}
