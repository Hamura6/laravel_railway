<?php

namespace App\Livewire;

use App\Models\Affiliate;
use App\Models\License;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class LicenseComponent extends Component
{
    use WithPagination;
    public $id, $date, $affiliate_id, $description, $idTemp, $search = '';
    public function mount(){
        $this->authorize('licenses.view');
    }
    public function rules()
    {
        return [
            'date' => 'required|date|after_or_equal:today',
            'affiliate_id' => 'required|unique:licenses,affiliate_id|exists:affiliates,id',
            'description' => 'required|string|',
        ];
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $search = $this->search;
        $licenses = License::with([
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
        return view('livewire.licenses.license-component', compact('licenses'));
    }
    public function store()
    {
        $this->authorize('licenses.create');
        $this->validate();
        License::create([
            'date' => $this->date,
            'affiliate_id' => $this->affiliate_id,
            'description' => $this->description,
        ]);
        Affiliate::find($this->affiliate_id)->update([
            'status' => 'Licencia'
        ]);
        $this->dispatch('notify', text: 'El registro se guardo correctamente', title: 'Registro almacenado', icon: 'success');
        $this->clear();
    }
    #[On('delete')]
    public function delete($id)
    {
        $this->authorize('licenses.delete');
        $license = License::with(['affiliate','affiliate.payments'])->find($id);
        if($license->affiliate->deceased){
            $license->affiliate()->update(['status' => 'Fallecido']);
            
        }else if($license->affiliate->debt_aport_count>=24)
            $license->affiliate()->update(['status' => 'Inactivo']);
        else
            $license->affiliate()->update(['status' => 'Activo']);
        $license->delete();
        $this->dispatch('notify', text: 'Registro se elimino correctamente', title: 'Registro eliminado', icon: 'success');
    }
    public function clear()
    {
        $this->resetValidation();
        $this->reset(['date', 'affiliate_id', 'description', 'id']);
        $this->dispatch('close-modal');
    }
}
