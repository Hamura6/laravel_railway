<?php

namespace App\Livewire;

use App\Models\Discount;
use App\Models\Fee;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class DiscountComponent extends Component
{
    use WithPagination;
    public $id,$start_date,$end_date,$selectedFees=[],$amount;
    public function mount(){
        $this->authorize('discount.view');
    }
     protected function rules()
    {
        return [
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'selectedFees' => 'required|array|min:1',
            'amount' => 'required|numeric|min:1|max:99',
        ];
    }
    public function render()
    {
        $fees=Fee::select('name','id')->get();
        $discounts=Discount::with(['fees:name'])->paginate(9);
        return view('livewire.discounts.discount-component',compact('fees','discounts'));
    }
     public function store()
    {
        $this->authorize('discount.create');
        $this->validate();

        $discount = Discount::create([
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'discount_value' => $this->amount,
        ]);

        $discount->fees()->sync($this->selectedFees);

        $this->clear();
        $this->dispatch('notify', text: 'Descuento creado correctamente', title: 'Registro creado', icon: 'success');
    }

    public function edit(Discount $discount)
    {
        $this->id = $discount->id;
        $this->start_date = $discount->start_date;
        $this->end_date = $discount->end_date;
        $this->amount = $discount->discount_value;
        $this->selectedFees = $discount->fees->pluck('id')->toArray();
        $this->dispatch('show-modal');
    }

    public function update()
    {
        $this->authorize('discount.edit');
        $this->validate();

        $discount = Discount::findOrFail($this->id);
        $discount->update([
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'discount_value' => $this->amount,
        ]);

        $discount->fees()->sync($this->selectedFees);

        $this->clear();
        $this->dispatch('notify', text: 'Registro actualizado correctamente', title: 'Registro actualizado', icon: 'success');
    }

    public function clear()
    {
        $this->id = null;
        $this->start_date = null;
        $this->end_date = null;
        $this->amount = null;
        $this->selectedFees = [];
        $this->dispatch('close-modal');
    }

    #[On('delete')]
    public function delete($id)
    {
        $this->authorize('discount.delete');
        $discount = Discount::findOrFail($id);
        $discount->delete();

        $this->dispatch('notify', text: 'Registro eliminado correctamente', title: 'Registro eliminado', icon: 'success');
    }
}
