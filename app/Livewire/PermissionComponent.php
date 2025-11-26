<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class PermissionComponent extends Component
{
    use WithPagination;
    public $role, $search;
    public function mount()
    {
        
        $this->authorize('permissions.assign');
        $this->role = 0;
        $this->search = '';
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $permissions = Permission::where('name', 'like', '%' . $this->search . '%')
            ->select('name', 'description', 'id', DB::raw('0 as checked'))
            ->orderBy('id', 'asc')
            ->paginate(12);

        $roles = Role::select('name', 'id')/* ->whereNot('name', 'Administrador') */->orderBy('name')->get();

        if ($this->role) {
            $role = Role::with('permissions:id')->find($this->role);

            $rolePermissionIds = $role->permissions->pluck('id')->toArray();

            foreach ($permissions as $permission) {
                $permission->checked = in_array($permission->id, $rolePermissionIds) ? 1 : 0;
            }
        }

        return view('livewire.permission-component', compact('roles', 'permissions'));
    }
    public function syncPermission($stated, $id)
    {
        if ($this->role) {
            $roleName = Role::find($this->role);
            if ($stated) {
                $roleName->givePermissionTo($id);
                $this->dispatch('notify', title: 'permiso  asignado', icon: 'success', text: 'El permiso fue asignado');
            } else {
                $roleName->revokePermissionTo($id);
                $this->dispatch('notify', title: 'permiso revocado', icon: 'success', text: 'El permiso fue revocado');
            }
        } else {
            return  $this->dispatch('notify', title: 'Rol invalido', icon: 'error', text: 'Seleccione un rol valido');
        }
    }
    public function syncAll()
    {
        if (!$this->role)
            return  $this->dispatch('notify', title: 'Rol invalido', icon: 'error', text: 'Seleccione un rol valido');
        $roleN = Role::find($this->role);
        $permissionsAll = Permission::pluck('id')->toArray();
        $roleN->syncPermissions($permissionsAll);
        $this->dispatch('notify', title: 'Permisos asignados', icon: 'success', text: 'Los permisos fueron asignados');
    }
    public function revokeAll()
    {
        if (!$this->role)
            return  $this->dispatch('notify', title: 'Rol invalido ', icon: 'error', text: 'Seleccione un rol valido');
        $roleN = Role::find($this->role);
        $roleN->syncPermissions([0]);
        $this->dispatch('notify', title: 'Permisos revocados', icon: 'success', text: 'Los permisos fueron revocados ');
    }
}
