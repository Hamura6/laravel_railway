<?php

namespace App\Livewire\Affiliate;

use App\Models\Affiliate;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class ViewAffiliate extends Component
{
    use WithPagination;
    public $search = '';
    public function mount(){
        $this->authorize('affiliates.view');
        
    }
    public function render()
    {

        $search = $this->search;
        $affiliates = Affiliate::whereHas('user.roles', function ($query) {
            $query->where('name', 'Afiliado');
        })
            ->when(function ($query) use ($search) {
                $query->where('id', 'like', "%$search%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('ci', 'like', "%$search%")
                            ->orWhere('name', 'like', "%$search%")
                            ->orWhere('last_name', 'like', "%$search%");
                    });
            })
            ->with([
                'user:id,name,last_name,ci,email,gender,birthdate,status',
                'user.phones:number,user_id'
            ])
            ->orderBy('id', 'desc')
            ->paginate(10);



        return view('livewire.affiliate.view-affiliate', compact('affiliates'));
    }
    #[On('delete')]
    public function delete($id)
    {
        $this->authorize('affiliates.delete');
        User::find($id)->delete();
        $this->dispatch('notify', text: 'El registro se elimino correctamente', title: 'El afiliado fue eliminado', icon: 'success');
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }
    #[On('changeStatus')]
    public function changeStatus($id)
    {
        $this->authorize('affiliates.block');
        $user = User::find($id);
        if ($user->status == 'ENABLED')
            $user->status = 'DISABLED';
        else
            $user->status = 'ENABLED';
        $user->save();
        $this->dispatch('notify', text: 'El afiliado fue ' . trans($user->status), title: 'Estado actualizado', icon: 'success');
    }
    #[On('resetPassword')]
    public function resetPassword($id)
    {
        $this->authorize('affiliates.reset.password');
        $user = User::find($id);
        $user->password = Hash::make($user->ci);
        $user->save();
        $this->dispatch('notify', title: 'Contrasena restablecida', icon: 'success', text: 'La contrasena se restablecio correctamente');
    }
}
