<?php

namespace App\Livewire\Direcories;

use App\Models\Affiliate;
use App\Models\BoardMember;
use Livewire\Component;
use Livewire\WithPagination;
use App\Enums\BoardRole;
use Livewire\Attributes\On;

class DirectoryComponent extends Component
{
    use WithPagination;
    public $id, $name, $rol = 'Elegir', $toSearch, $type = 1;
    public function mount(){
        $this->authorize('directories.view.organization');
    }
    public function rules()
    {
        return [
            'rol' => 'required|not_in:Elegir'
        ];
    }
    public function render()
    {
        $directories = BoardMember::with(['affiliate:id,user_id', 'affiliate.user:name,last_name,id,gender'])
            ->where('affiliate_id', '!=', null)
            ->where('is_directory', $this->type)
            ->orderBy('level', 'asc')
            ->get();

        $roles = BoardMember::select('id', 'name')
            ->whereNull('affiliate_id')
            ->where('is_directory', $this->type)
            ->get();


        $toSearch = $this->toSearch;
        $affiliates = Affiliate::query()
            ->whereIn('status', ['Activo', 'Inactivo', 'Exento'])
            ->whereDoesntHave('boardMember')
            ->when($toSearch, function ($q) use ($toSearch) {
                $q->where('id', $toSearch)
                    ->orWhereHas('user', function ($u) use ($toSearch) {
                        $u->whereRaw("CONCAT(name, ' ', last_name) LIKE ?", ["%{$toSearch}%"]);
                    });
            })
            ->select('id', 'status', 'user_id')
            ->with(['user:id,name,last_name'])
            ->orderBy('id', 'desc')
            ->simplePaginate(10);


        return view('livewire.direcories.directory-component', compact('directories', 'affiliates', 'roles'));
    }
    public function UpdatedToSearch()
    {
        $this->resetPage();
    }
    public function selected(Affiliate $affiliate)
    {
        $this->id = $affiliate->id;
        $this->name = $affiliate->user->full_name;
        $this->dispatch('show-modal');
    }
    public function update()
    {
        $this->authorize('directories.assign');
        $this->validate();
        $boardMember = BoardMember::find($this->rol)->affiliate()->associate($this->id);
        $boardMember->save();
        $this->clear();
        $this->dispatch('notify', text: 'Rol asignado exitosament a ' . $this->name, title: 'Rol asignado', icon: 'success');
    }
    #[On('delete')]
    public function delete($id)
    {
        $this->authorize('directories.assign');
        $boardMember = BoardMember::find($id)->affiliate()->dissociate();
        $boardMember->save();
        $this->dispatch('notify', text: 'Se quito un elemento del directorio', title: 'Un rol fue alterado', icon: 'success');
    }
    public function clear()
    {
        $this->resetValidation();
        $this->rol = 'Elegir';
        $this->dispatch('close-modal');
    }
}
