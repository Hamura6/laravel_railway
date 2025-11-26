<?php

namespace App\Livewire\Forms;

use App\Models\Affiliate;
use App\Models\Demand;
use Livewire\Attributes\Validate;
use Livewire\Form;

class DemandForm extends Form
{
    public ?Demand $demand;
    #[Validate('required|min:5|max:100|string')]
    public $name = '';
    #[Validate('required|numeric|digits_between:7,8|min:2000000|max:79999999')]
    public $phone = '';
    #[Validate('required|min:5|max:200|string')]
    public $complainant = '';
    #[Validate('required|not_in:Elegir')]
    public $status = 'Elegir';
    #[Validate('required|date|before_or_equal:today')]
    public $date = '';
    #[Validate('required|min:10|max:300|string')]
    public $description = '';
    public function store(Affiliate $affiliate)
    {
        $affiliate->demands()->create(
            $this->all()
        );
    }
    public function setDemand(Demand $demand)
    {
        $fields = ['name', 'phone', 'complainant', 'status', 'date', 'description'];
        foreach ($fields as $field) {
            $this->$field = $demand->$field;
        }
        $this->demand = $demand;
    }
    public function update()
    {
        $this->demand->update(
            $this->all()
        );
    }
}
