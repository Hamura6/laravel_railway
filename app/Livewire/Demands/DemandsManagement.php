<?php

namespace App\Livewire\Demands;

use App\Models\Affiliate;
use App\Models\Demand;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class DemandsManagement extends Component
{
    use WithPagination;
    public Affiliate $affiliate;
    public $id = 0, $year;

    public function mount($ide)
    {
        $this->authorize('demands.view');
        $this->year = date('Y');
        $this->affiliate = Affiliate::select('id', 'user_id', 'address_home', 'address_number_home', 'zone_home', 'address_office', 'address_number', 'zone')
            ->with(['user:name,last_name,id,ci,email', 'user.phones:number,user_id'])
            ->find($ide);
    }
    public function render()
    {
        $managements = Demand::select(
            DB::raw('YEAR(date) as year'),
            DB::raw('COUNT(*) as total')
        )
            ->where('affiliate_id', $this->affiliate->id)
            ->groupBy(DB::raw('YEAR(date)'))
            ->orderBy(DB::raw('YEAR(date)'), 'desc')
            ->paginate(10);
        $demands = Demand::where('affiliate_id', $this->affiliate->id)
            ->whereYear('date', $this->year)
            ->paginate(6, pageName: 'demands-pages');
        return view('livewire.demands.demands-management', compact('managements', 'demands'));
    }
    public function selected($year)
    {
        $this->year = $year;
    }
}
