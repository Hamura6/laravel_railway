<?php

namespace App\Livewire\Reports;

use Livewire\Component;

class AffiliatesReport extends Component
{
    public $tab='status';
    public function mount(){
        $this->authorize('reports');

    }
    public function render()
    {
        return view('livewire.reports.affiliates-report');
    }
    public function setTab($value){
        $this->tab=$value;
    }
    
}
