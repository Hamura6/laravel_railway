<?php

namespace App\Livewire\Agreements;

use App\Models\Agreement;
use Livewire\Attributes\On;
use Livewire\Component;

class AgrementComponent extends Component
{
    public $search;
    public function mount(){
        $this->authorize('agreements.view');
    }
    public function render()
    {
        $agreements = Agreement::with('socials:type,url,sociable_id,sociable_type,id')
        ->where('name', 'like', "%$this->search%")->paginate(10);
        return view('livewire.agreements.agrement-component', compact('agreements'));
    }
    #[On('delete')]
    public function delete($id)
    {
        $this->authorize('agreements.view');
        $agreement = Agreement::find($id);
        if ($agreement->images) {
            if (file_exists(public_path('storage/agreements/' . $agreement->images))) {
                unlink(public_path('storage/agreements/' . $agreement->images));
            }
        }
        $agreement->socials()->delete();
        $agreement->delete();
        $this->dispatch('notify', text: 'El registro fue eliminado correctamente', title: 'Registro eliminado', icon: 'success');
    }
}
