<?php

namespace App\Livewire\Direcories;

use App\Models\BoardMember;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class DirectoryFormComponent extends Component
{
    use WithPagination;
    public $id,$search='',$name,$is_directory='Elegir',$level;
    public function mount(){
        $this->authorize('directories.view');
    }
    public function rules(){
        return [
            'name'=>'required|string|min:4|max:100',
            'is_directory'=>'required|not_in:Elegir',
            'level'=>'required|numeric|digits_between:1,2|min:1|max:20'
        ];
    }
    public function render()
    {
        $directories=BoardMember::where('name','like',"%$this->search%")
        ->orderBy('is_directory', 'desc')
        ->orderBy('id', 'asc')      
        ->paginate(10);
        return view('livewire.direcories.directory-form-component',compact('directories'));
    }
    public function UpdatedSearch(){
        $this->resetPage();
    }
    public function store(){
        $this->authorize('directories.create');
        $this->validate();
        BoardMember::create([
            'name'=>$this->name,
            'is_directory'=>$this->is_directory,
            'level'=>$this->level,
        ]);
        $this->dispatch('notify',text:'El rol de '.($this->is_directory?'Directorio':'Tribunal de Honor').' fue registrado exitosamente',title:'Directorio registrado',icon:'success');
        $this->clear();
    }
    public function edit(BoardMember $board){
        $this->name=$board->name;
        $this->is_directory=$board->is_directory;
        $this->level=$board->level;
        $this->id=$board->id;
        $this->dispatch('show-modal');
        
    }
    public function update(){
        $this->authorize('directories.edit');
        $this->validate();
        $board=BoardMember::find($this->id);
        $board->update([
            'name'=>$this->name,
            'is_directory'=>$this->is_directory,
            'level'=>$this->level,
        ]);
        $this->dispatch('notify',text:'El rol de '.($this->is_directory?'Directorio':'Tribunal de Honor').' fue actualizado exitosamente',title:'Directorio actualizado',icon:'success');
        $this->clear();
    }
    #[On('delete')]
    public function delete($id){
        $this->authorize('directories.delete');
        BoardMember::find($id)->delete();
        $this->dispatch('notify',text:'El rol de '.($this->is_directory?'Directorio':'Tribunal de Honor').' fue eliminado exitosamente',title:'Directorio eliminado',icon:'success');
    }
    public function clear(){
        $this->resetValidation();
        $this->reset(['name','id','level']);
        $this->is_directory='Elegir';
        $this->dispatch('close-modal');
    }
}
