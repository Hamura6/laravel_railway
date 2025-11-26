<?php

namespace App\Livewire;

use App\Livewire\Forms\UniversityForm;
use App\Models\University;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class UniversityComponent extends Component
{
    use WithPagination;
    public UniversityForm $form;
    public $search,$selected='';
    public function  mount(){
        $this->authorize('universities.view');
    }
    public function render()
    {
        $universities=University::select('id','name','entity')
        ->where('name','like','%'.$this->search.'%')
        ->where('entity','like','%'.$this->selected.'%')->paginate(10);
        return view('livewire.universities.university-component',compact('universities'));
    }
    public function edit(University $university){
        $this->form->setUniversity($university);
        $this->dispatch('show-modal');

    }
    public function store(){
        $this->authorize('universities.create');
        $this->form->store();
        $this->clear();
        $this->dispatch('notify',title:'Universidad registrada',icon:'success',text:'El registro se guardo correctamente');
        
    }
    #[On('delete')]
    public function delete($id){
        $this->authorize('universities.delete');
        $university=University::find($id);
        if($university->professions()->count()){
            $this->dispatch('notify',title:'Registro asociado',icon:'error',text:'El registro se encuentra asociado a 1 o mas affiliados');

        }else{

            $university->delete();
            $this->dispatch('notify',title:'Registro eliminado',icon:'success',text:'El registro se elimino correctamente');
        }
    }
    public function update(){
        $this->authorize('universities.edit');
        $this->form->update();
        $this->clear();
        $this->dispatch('notify',title:'Registro actualizado',icon:'success',text:'El registro se modifico correctamente');
    }
    public function clear(){
        $this->dispatch('close-modal');
        $this->form->reset();
        $this->resetValidation();
    }
    public function updatedSearch(){
        $this->resetPage();
    }
}
