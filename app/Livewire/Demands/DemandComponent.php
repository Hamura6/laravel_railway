<?php

namespace App\Livewire\Demands;

use App\Models\Affiliate;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class DemandComponent extends Component
{
    use WithPagination;
    public $search = '';
    public $select = '';
    public function mount(){
        $this->authorize('demands.view');
    }
    public function render()
    {
        $search = $this->search;
        $select = $this->select;
        $affiliates = Affiliate::whereHas('user.roles', function ($query) {
            $query->where('name', 'Afiliado');
        })->select('id', 'user_id','status')
            ->where('status', 'like', ($select=="Activo"?"$select":"%$select%"))
            ->where(function ($query) use ($search) {
                $query->where('id', 'like', "%$search%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where(function ($q2) use ($search) {
                            $q2->where(DB::raw("CONCAT(name, ' ', last_name)"), 'like', "%$search%")
                                ->orWhere('ci', 'like', "%$search%");
                        });
                    });
            })
            ->with('user:name,id,last_name,ci,gender,birthdate', 'user.phones:number,user_id')
            ->orderBy('id', 'desc')
            ->paginate(10);


        return view('livewire.demands.demand-component', compact('affiliates'));
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }
}
