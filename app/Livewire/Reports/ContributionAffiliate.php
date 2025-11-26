<?php

namespace App\Livewire\Reports;

use App\Models\Affiliate;
use App\Models\Payment;
use Carbon\Carbon;
use Livewire\Component;

class ContributionAffiliate extends Component
{
    public $affiliate,$from,$to,$date;
    public function mount($id,$from,$to)
    {
        $this->authorize('reports');
        $this->from=$from;
        $this->to=$to;
        $this->date=Carbon::parse($from)->isoFormat('ddd, D \d\e MMM \d\e\l Y') .' al ' .Carbon::parse($to)->isoFormat('ddd, D \d\e MMM \d\e\l Y');
        $this->affiliate=Affiliate::select('id','user_id','status')
        ->with([
            'user:id,name,last_name',
            'user.phones:number,user_id'
            ])->find($id);

    }
    public function render()
    {
        /*  $pagosAgrupados = Payment::where('status', 'pagado')
            ->where('affiliate_id', $this->id)
            ->orderBy('updated_at')
            ->get()
            ->groupBy(function ($item) {
                return $item->updated_at->format('Y-m-d H:i:s');
            });

        $resultado = [];

        foreach ($pagosAgrupados as $updatedAt => $grupo) {

            $ordenados = $grupo->sortBy('date');
            $primer = $ordenados->first();
            $ultimo = $ordenados->last();

            $resultado[] = [
                'updated_at' => $updatedAt,
                'inicio'     => \Carbon\Carbon::parse($primer->date)->format('m/Y'),
                'fin'        => \Carbon\Carbon::parse($ultimo->date)->format('m/Y'),
                'total'      => $grupo->sum('amount'),
                'cantidad'   => $grupo->count(),
            ];
        } */
        /* $pagosAgrupados = Payment::where('status', 'pagado')
    ->where('affiliate_id', $this->id)
    ->orderBy('updated_at')
    ->get()
    ->groupBy(function ($item) {
        return $item->updated_at->format('Y-m-d'); 
    });

$resultado = [];

foreach ($pagosAgrupados as $updatedAt => $grupo) {

    $ordenados = $grupo->sortBy('date');

    $primer = $ordenados->first();
    $ultimo = $ordenados->last();

    $resultado[] = [
        'updated_at' => $updatedAt, 
        'inicio'     => \Carbon\Carbon::parse($primer->date)->format('m/Y'),
        'fin'        => \Carbon\Carbon::parse($ultimo->date)->format('m/Y'),
        'total'      => $grupo->sum('amount'),
        'cantidad'   => $grupo->count(),
    ];
} */
        $pagos = Payment::where('status','Pagado')
            ->where('affiliate_id', $this->affiliate->id)
            ->whereBetween('created_at', [$this->from, $this->to])
            ->with(['user:id,name,last_name',])
            ->paginate(15);
        return view('livewire.reports.contribution-affiliate', compact('pagos'));
    }
}
