<?php

namespace App\Livewire;

use App\Models\Specialty;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class SpecialtyComponent extends Component
{
    use WithPagination;
    public $id='',$search,$name='';
    public function mount(){
        $this->authorize('specialties.view');
    }
    public function rules(){
        return [
            'name'=>'required|min:5|max:20|unique:specialties,name,'.$this->id
        ];
    }
    public function updatedSearch(){
        $this->resetPage();
    }
    public function render()
    {
        $specialties=Specialty::where('name','like','%'.$this->search.'%')
        ->select('name','id')
        ->orderBy('id','desc')
        ->paginate(10);
        return view('livewire.specialties.specialty-component',compact('specialties'));
    }
    public function store(){
        $this->authorize('specialties.create');
        $this->validate();
        Specialty::create([
            'name'=>$this->name
        ]);
        $this->clear();
        $this->dispatch('notify', title: 'Especialidad registrado', icon: 'success', text: 'La especialidad se registro exitosamente');

    }
    public function edit(Specialty $specialty){
        $this->name=$specialty->name;
        $this->id=$specialty->id;
        $this->dispatch('show-modal');
    }
    public function update(){
        $this->authorize('specialties.edit');
        $this->validate();
        $specialty=Specialty::find($this->id);
        $specialty->name=$this->name;
        $specialty->save();
        $this->clear();
                $this->dispatch('notify', title: 'La especialidad actualizada', icon: 'success', text: 'El registro fue actualizado correctamente');


    }
    public function search(){
        $this->resetPage();
    }
    #[On('delete')]
    public function delete($id){
        $this->authorize('specialties.delete');
        $specialty=Specialty::find($id);
        if($specialty->professions->count()){
            $this->dispatch('notify', title: 'Especialidad asociada', icon: 'error', text: 'La especialidad se encuentra asociada a 1 o mas affiliados');
        }else{
            
            Specialty::find($id)->delete();
            $this->dispatch('notify', title: 'Especialidad Eliminada', icon: 'success', text: 'La especialidad fue eliminado correctamente');
        }

    }
    public function clear(){
        $this->dispatch('close-modal');
        $this->reset(['name','id']);
        $this->resetValidation();
    }
}
