<?php

namespace App\Livewire;

use App\Models\Affiliate;
use App\Models\Deceased;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class DeceasedComponent extends Component
{
    use WithPagination;
    public $id, $affiliate_id, $date, $description, $mausoleum = 'Elegir',$search='';
    public function mount(){
        $this->authorize('deceaseds.view');
    }
    public function rules()
    {
        return [
            'date' => 'required|date|before:today',
            'affiliate_id' => 'required|unique:deceaseds,affiliate_id|exists:affiliates,id',
            'description' => 'required|string',
            'mausoleum' => 'required||not_in:Elegir',
        ];
    }
    public function render()
    {
        $search = $this->search;
        $deceaseds = Deceased::with([
            'affiliate:id,created_at,user_id',
            'affiliate.user:name,last_name,id,ci'
        ])
            ->where(function ($query) use ($search) {
                $query->whereHas('affiliate', function ($q) use ($search) {
                    $q->where('id', 'like', "%{$search}%")
                        ->orWhereHas('user', function ($u) use ($search) {
                            $u->where(DB::raw("CONCAT(name, ' ', last_name)"), 'like', "%{$search}%")
                                ->orWhere('ci', 'like', "%{$search}%")
                                ->orWhere('name', 'like', "%{$search}%")
                                ->orWhere('last_name', 'like', "%{$search}%");
                        });
                });
            })
            ->paginate(10);
        return view('livewire.deceaseds.deceased-component',compact('deceaseds'));
    }
    public function store()
    {
        $this->authorize('deceaseds.create');
        $this->validate();
        Deceased::create([
            'affiliate_id' => $this->affiliate_id,
            'date' => $this->date,
            'description' => $this->description,
            'mausoleum' => $this->mausoleum
        ]);
        Affiliate::find($this->affiliate_id)->update([
            'status' => 'Fallecido'
        ]);
        $this->dispatch('notify', text: 'El registro se guardo correctamente', title: 'Registro almacenado', icon: 'success');

        $this->clear();
    }
    #[On('delete')]
    public function delete($id)
    {
        $this->authorize('deceaseds.delete');
        $deceased = Deceased::with(['affiliate','affiliate.payments'])->find($id);
        if($deceased->affiliate->license){
            $deceased->affiliate()->update(['status' => 'Licencia']);
            
        }else if($deceased->affiliate->debt_aport_count>=24)
            $deceased->affiliate()->update(['status' => 'Inactivo']);
        else
            $deceased->affiliate()->update(['status' => 'Activo']);
        $deceased->delete();
        $this->dispatch('notify', text: 'Registro se elimino correctamente', title: 'Registro eliminado', icon: 'success');
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function clear()
    {
        $this->resetValidation();
        $this->mausoleum = 'Elegir';
        $this->affiliate_id = '';
        $this->date = '';
        $this->description = '';
        $this->dispatch('close-modal');
    }
}
