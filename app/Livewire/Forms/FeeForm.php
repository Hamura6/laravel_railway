<?php

namespace App\Livewire\Forms;

use App\Models\Fee;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FeeForm extends Form
{
    public function rules()
    {
        return [
            'name' => ['required', 'min:3', 'max:100', 'string', Rule::unique('fees', 'name')->ignore($this->id)],
            'amount' => ['required', 'decimal:0,2', 'gte:1.00', 'lte:99999.99'],
            'type' => ['required', 'not_in:Elegir'],
        ];
    }
    public ?Fee $fee;
    public $id = 0;
    public $name = '';
    public $amount = '';
    public $type ='Elegir';
    public function store()
    {
        Fee::create(
            $this->all()
        );
    }
    public function setFee(Fee $fee)
    {
        $this->fee = $fee;

        foreach (['id', 'name', 'amount', 'type'] as $prop) {
            $this->$prop = $fee->$prop;
        }
    }

    public function update()
    {
        $this->fee->update(
            $this->all()
        );
    }
}
