<?php

namespace App\Livewire\Demands;

use App\Livewire\Forms\DemandForm;
use App\Models\Affiliate;
use App\Models\Demand;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class DemandsDetails extends Component
{
    use WithPagination;
    public DemandForm $form;
    public Affiliate $affiliate;
    public $id=0;
    public function mount($ide){
        $this->affiliate=Affiliate::
        select('id','user_id','address_home','address_number_home','zone_home','address_office','address_number','zone')
        ->with(['user:name,last_name,id,ci,email','user.phones:number,user_id'])
        ->find($ide);
    }
    public function render()
    {
        $demands=Demand::where('affiliate_id',$this->affiliate->id)
        ->orderBy('id','desc')
        ->paginate(9);
        return view('livewire.demands.demands-details',compact('demands'));
    }
    public function store(){
        $this->authorize('demands.create');
        $this->form->validate();
        $this->form->store($this->affiliate);
        $this->clear();
        $this->dispatch('notify',text:'El registro fue almacenado correctamente',title:'Registro almacenado',icon:'success');
    }
    public function edit(Demand $demand){
        $this->form->setDemand($demand);
        $this->id=$demand->id;
        $this->dispatch('show-modal');
    }
    public function update(){
        $this->authorize('demands.edit');
        $this->form->update();
        $this->clear();
        $this->dispatch('notify',text:'El registro fue modificado satisfactoriamente',title:'Registro actualizado',icon:'success');
    }
    #[On('delete')]
    public function delete($id){
        $this->authorize('demands.delete');
        Demand::find($id)->delete();
        $this->dispatch('notify',text:'El registro fue eliminado correctamente',title:'Registro eliminado',icon:'success');
    }
    public function clear(){
        $this->form->reset();
        $this->reset(['id']);
        $this->dispatch('close-modal');
    }
}
