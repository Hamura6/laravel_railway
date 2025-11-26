<?php

namespace App\Livewire\Reports;

use App\Models\Affiliate;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;


class ContributionReport extends Component
{
    use WithPagination;
    public $from, $to,$search='';
    public function mount()
    {
        $this->authorize('reports');
        $this->from = Carbon::now()->firstOfYear()->format('Y-m-d');
        $this->to   = Carbon::now()->lastOfYear()->format('Y-m-d');
    }
    public function render()
    {
        $toSearch=$this->search;
        $affiliates = Affiliate::select('id', 'user_id', 'created_at')
            ->when($toSearch, function ($q) use ($toSearch) {
                $q->where('id', $toSearch)
                    ->orWhereHas('user', function ($u) use ($toSearch) {
                        $u->whereRaw("CONCAT(name, ' ', last_name) LIKE ?", ["%{$toSearch}%"]);
                    });
            })
            ->withSum(['payments' => function ($paymentsQuery) {
                $paymentsQuery
                    ->where('fee_id', 1)
                    ->where('status', 'Pagado')
                    ->whereBetween('created_at', [$this->from, $this->to]);
            }], 'amount')
            ->with(['user:id,name,last_name', 'user.phones:number,user_id'])
            ->orderBy('id', 'desc')->paginate(15);
        return view('livewire.reports.contribution-report', compact('affiliates'));
    }
    public function update()
    {
        $this->from = Carbon::parse($this->from)->format('Y-m-d');
        $this->to   = Carbon::parse($this->to)->format('Y-m-d');
    }
}
