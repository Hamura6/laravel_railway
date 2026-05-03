<?php

namespace App\Livewire;

use App\Models\Affiliate;
use App\Models\Fee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class UserComponent extends Component
{
    use WithPagination;

    public $search = '';
    public function mount()
    {
        $this->authorize('Ver usuarios');
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $users = User::select('users.id', 'users.ci', 'users.email', 'users.status')
            ->with('roles:id,name')
            ->whereDoesntHave('roles', function ($query) {
                $query->Where('id', 1);
            })
            ->when($this->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('ci', 'like', "{$search}%")
                        ->orWhere('email', 'like', "{$search}%");
                });
            })
            ->paginate(10);

        return view('livewire.users.user-component', compact('users'));
    }
    #[On('changeStatus')]
    public function changeStatus($id)
    {
        $this->authorize('Bloquear usuarios');
        $user = User::find($id);
        if ($user->name_role === 'Administrador') {
            return $this->dispatch('notify', title: 'Error de acceso', icon: 'error', text: 'Acción no autorizada');
        }
        if ($user->status == 'ENABLED') {
            $user->status = 'DISABLED';
        } else {
            $user->status = 'ENABLED';
        }
        $user->save();

        $this->dispatch('notify', title: 'Estado actualizado', icon: 'success', text: 'Se actualizado el estado del usuario ' . $user->full_name . ' a ' . trans($user->status));
    }
    #[On('delete')]
    public function delete($id)
    {
        $this->authorize('Eliminar usuarios');
        $user = User::find($id);
        if ($user->name_role === 'Administrador') {
            return $this->dispatch('notify', title: 'Error de acceso', icon: 'error', text: 'Acción no autorizada');
        }
        $user->delete();
        $this->dispatch('notify', title: 'Usuario eliminado', icon: 'success', text: 'registro eliminado Correctamente');
    }
    #[On('resetPassword')]
    public function resetPassword($id)
    {
        $this->authorize('Restablecer usuarios.password');
        $user = User::find($id);
        if ($user->name_role === 'Administrador') {
            return $this->dispatch('notify', title: 'Error de acceso', icon: 'error', text: 'Acción no autorizada');
        }
        $user->password = Hash::make($user->ci);
        $user->save();
        $this->dispatch('notify', title: 'Contrasena restablecida', icon: 'success', text: 'La contrasena se restablecio correctamente');
    }
}
