<?php

namespace App\Livewire\Reports;

use App\Models\Affiliate;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class StatusAffiliate extends Component
{
    use WithPagination;

    public $statusTotal = [];
    public $status = 'Activo';
    public function mount()
    {
        $this->statusTotal['Activo'] = Affiliate::where('status', 'Activo')->count();
    }
    public function refreshData()
    {
        $this->statusTotal = [];
        $this->statusTotal['Activo'] = Affiliate::where('status', 'Activo')->count();
    }
    public function render()
    {
        $query = Affiliate::select('id', 'user_id', 'status', 'created_at')
        ->addSelect([
                'ultimoPago' => Payment::selectRaw("
        CASE 
            WHEN status = 'Por pagar' 
                THEN DATE_SUB(`date`, INTERVAL 1 MONTH)
            ELSE `date`
        END
    ")
                    ->whereColumn('affiliate_id', 'affiliates.id')
                    ->where('fee_id', 1)
                    ->orderByRaw("
        CASE
            WHEN status = 'Por pagar' THEN 1
            ELSE 2
        END ASC
    ")
                    ->orderByRaw("
        CASE
            WHEN status = 'Por pagar' THEN `date`
            ELSE NULL
        END ASC
    ")
                    ->orderByRaw("
        CASE
            WHEN status != 'Por pagar' THEN `date`
            ELSE NULL
        END DESC
    ")
                    ->limit(1)
            ])
            ->with(['user:id,name,last_name']);
        $query->whereIn('status', array_keys($this->statusTotal));


        $affiliates = $query->paginate(20);
        return view('livewire.reports.status-affiliate', compact('affiliates'));
    }
    public function update()
    {
        $this->statusTotal[$this->status] = Affiliate::where('status', $this->status)->count();
    }
    public function deleteItem($key)
    {
        unset($this->statusTotal[$key]);
    }
}
