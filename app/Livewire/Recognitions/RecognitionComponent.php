<?php

namespace App\Livewire\Recognitions;

use App\Models\Recognition;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;


class RecognitionComponent extends Component
{
    use WithPagination;
    public $search;
    public $id,$name,$date,$type='Elegir';
    public function rules(){
        return [
            'name'=>'required|string|min:3|max:50',
            'date' => 'required|date|after_or_equal:today',
            'type'=>'required|not_in:Elegir',
        ];
    }
    public function mount(){
       $this->authorize('recognitions.view');
        $this->search=Carbon::parse(now())->firstOfYear()->year;
    }
    public function render()
    {
        $recognitions = Recognition::whereYear('date', $this->search)
        ->withCount(['Affiliates as cant'])->get();

        return view('livewire.recognitions.recognition-component',compact('recognitions'));
    }
    public function store(){
        $this->authorize('recognitions.create');
        $this->validate();
        Recognition::create([
            'name'=>$this->name,
            'date'=>$this->date,
            'type'=>$this->type,
        ]);
        $this->dispatch('notify',text:'Registro almacenado',title:'El registro fue almacenado correctamente',icon:'success');
        $this->clear();
    }
    public function edit(Recognition $recognition){
        $this->name=$recognition->name;
        $this->date=$recognition->date;
        $this->type=$recognition->type;
        $this->id=$recognition->id;
        $this->dispatch('show-modal');
        
    }
    public function update(){
        $this->authorize('recognitions.edit');
        $this->validate();
        $recognition=Recognition::find($this->id);
        $recognition->update([
            'name'=>$this->name,
            'date'=>$this->date,
            'type'=>$this->type,
        ]);
        $this->dispatch('notify',text:'Registro actualizado',title:'El registro fue actualizado correctamente',icon:'success');
        $this->clear();

        
    }
    #[On('delete')]
    public function delete($id){
        $this->authorize('recognitions.delete');
        Recognition::find($id)->delete();
        $this->dispatch('notify',text:'Registro eliminado',title:'El registro fue eliminado correctamente',icon:'success');
    }
    public function UpdatedSearch(){

        $this->search = (int) $this->search;

    }
    public function clear(){
        $this->reset(['name','date']);
        $this->type='Elegir';
        $this->id=0;
        $this->resetValidation();
        $this->dispatch('close-modal');
    }
}
