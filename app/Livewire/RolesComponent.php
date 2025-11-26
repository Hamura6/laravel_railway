<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RolesComponent extends Component
{
    use WithPagination;
    public $name = '', $search = '', $id;
    public function  mount()
    {
        $this->authorize('roles.view');
        $this->id = 0;
        $this->name = '';
    }
    public function rules(){
        return [
            'name'=>'required|string|min:3|max:20|unique:roles,name,'.$this->id,
        ];
    }
    public function render()
    {

        $roles = Role::select('id', 'name')
            ->where('name', 'like', '%' . $this->search . '%')
            ->paginate(10);
        return view('livewire.roles.roles-component', compact('roles'));
    }
    public function store()
    {
        $this->authorize('roles.create');
        $this->validate();
        Role::Create(
            $this->only(['name'])
        );
        $this->clear();
        $this->dispatch('notify', title: 'Rol registrado', icon: 'success', text: 'El rol se registro exitosamente');
    }
    public function edit(Role $rol)
    {
        $this->id = $rol->id;
        $this->name = $rol->name;
        $this->dispatch('show-modal');
    }
    public function update()
    {
        $this->authorize('roles.edit');
        $this->validate();
        Role::where('id', $this->id)->Update(
            [
                'name' => $this->name
            ]
        );
        $this->clear();
        $this->dispatch('notify', title: 'Rol fue actualizado correctamente', icon: 'success', text: 'El rol fue actualizado correctamente');
    }
    public function clear()
    {
        $this->dispatch('close-modal');
        $this->mount();
        $this->resetValidation(); 
    }

    #[On('delete')]
    public function delete($id)
    {
        $this->authorize('roles.delete');
        $rol=Role::find($id);
        if($rol->users->count())     
            $this->dispatch('notify', title: 'Rol Asociado', icon: 'error', text: 'El rol se encuentra asociado con 1 o mas usuarios');
        else {

            $rol->delete();
            $this->dispatch('notify', title: 'Rol Eliminado', icon: 'success', text: 'El rol fue eliminado');
        }

    }
    public function updatedSearch()
    {
        $this->resetPage();
    }
}
