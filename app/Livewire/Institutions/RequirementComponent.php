<?php

namespace App\Livewire\Institutions;

use App\Models\Institution;
use Livewire\Component;

class RequirementComponent extends Component
{
    public $requirement;
    public function mount()
    {
        $this->requirement = Institution::first()->requirement;
    }

    public function render()
    {
        return view('livewire.institutions.requirement-component');
    }
}
