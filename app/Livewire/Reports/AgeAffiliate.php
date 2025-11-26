<?php

namespace App\Livewire\Reports;

use App\Models\Affiliate;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AgeAffiliate extends Component
{
    use WithPagination;
    public  $minor, $max,$status;
    public function mount(){
        $this->minor=18;
        $this->max=40;
        $this->status='';
    }
    public function render()
    {
        $minor = $this->minor;
        $max = $this->max;
        $query = Affiliate::select('user_id')
        ->where('status','like',"%$this->status%")
        ->with(['user:last_name,id,name,birthdate,email,gender','user.phones:number,user_id'])
            ->whereHas('user', function ($query) use ($minor, $max) {
                $query->whereBetween(
                    DB::raw('TIMESTAMPDIFF(YEAR, birthdate, CURDATE())'),
                    [$minor, $max]
                );
            })
            ->orderByDesc(
                User::select('birthdate')
                    ->whereColumn('users.id', 'affiliates.user_id')
                    ->limit(1)
            );
 

        $masculino = (clone $query)
            ->whereHas('user', fn($q) => $q->where('gender', 'Masculino'))
            ->count();

        $femenino = (clone $query)
            ->whereHas('user', fn($q) => $q->where('gender', 'Femenino'))
            ->count();

        $affiliates = $query->paginate(20);

        return view('livewire.reports.age-affiliate', compact('affiliates', 'masculino', 'femenino'));
    }
    public function update(){
        $this->dispatch('notify',text: 'La consulta fue realizada correctamente', title: 'Consulta realizada', icon: 'success');
    }
    public function refreshData(){
        $this->minor=18;
        $this->max=40;
        $this->status='';
        $this->dispatch('notify',text: 'La consulta fue restablecida correctamente', title: 'Consulta restablecida', icon: 'success');
    }
}
