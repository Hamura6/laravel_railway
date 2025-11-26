<?php

namespace App\Livewire;

use App\Livewire\Forms\FeeForm;
use App\Models\Fee;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

use function Laravel\Prompts\text;

class FeesComponent extends Component
{
    use WithPagination;
    public FeeForm $form;
    public $search;
    public function mount(){
        $this->authorize('fees.view');
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $fees=Fee::where('name','like','%'.$this->search.'%')
        ->select('name','id','amount','type')
        ->paginate(10);
        return view('livewire.fees.fees-component',compact('fees'));
    }
    public function store(){
        $this->authorize('fees.create');
        $this->validate();
        $this->form->store();
        $this->clear();
        $this->dispatch('notify',text:'La tarifa fue registrada correctamente',icon:'success',title:'Registro guardado');
    }
    public function edit(Fee $fee){
        $this->form->setFee($fee);
        $this->dispatch('show-modal');
        
    }
    public function update(){
        $this->authorize('fees.edit');
        $this->validate();
        $this->form->update();
        $this->clear();
        $this->dispatch('notify',text:'La tarifa fue actualizada correctamente',icon:'success',title:'Registro modificado');
    }
    #[On('delete')]
    public function delete($id){
        $this->authorize('fees.delete');
        $fee=Fee::find($id);
        if($fee->payments->count()){
            $this->dispatch('notify',text:'La tarifa asociada',icon:'error',title:'La tarifa se encuentra vinculada');
            
        }else
        {
            $this->dispatch('notify',text:'La tarifa fue elimina correctamente',icon:'success',title:'Registro eliminado');
            $fee->delete();

        }
    }
    public function clear(){
        $this->form->reset();
       $this->resetValidation();
        $this->dispatch('close-modal');
    }
}
