<?php

namespace App\Livewire;

use App\Models\Affiliate;
use Livewire\Attributes\Modelable;
use Livewire\Component;

class AffiliateSelected extends Component
{
    #[Modelable]
    public $value = '';
    public $searchTerm = '';
    public $filteredAffiliates = [];
    public $showList = false;
    public function render()
    {
        return view('livewire.affiliate-selected');
    }
    public function updatedSearchTerm()
    {
        $search = $this->searchTerm;
        $this->filteredAffiliates = Affiliate::whereHas('user.roles', function ($query) {
            $query->where('name', 'Afiliado');
        })
            ->where(function ($query) use ($search) {
                $query->where('id', 'like', "%$search%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('ci', 'like', "%$search%")
                        ->orWhere('last_name','like',"%$search%")
                        ->orWhere('name','like',"%$search%");
                    });
            })
            ->with('user:name,last_name,ci,id')
            ->select('status', 'user_id', 'id')
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();
    }

    public function selectUniversity($id)
    {
        $affiliate = Affiliate::find($id);
        if($affiliate->status=='Exento' || $affiliate->status=='Licencia' ||$affiliate->status=='Fallecido' )
            return $this->dispatch('notify',text:'El afiliado se encuentra '.$affiliate->status,title:'Afiliado no valido',icon:'error');
        $this->value=$affiliate->id;
        $this->searchTerm = $affiliate ? $affiliate->user->full_name  : '';
        $this->showList = false;
    }

    public function showDropdown()
    {
        $this->showList = true;
    }

    public function hideDropdown()
    {
        usleep(200000);
        $this->showList = false;
    }
    protected $listeners = ['update' => 'update'];
    public function update($value)
    {
        $this->value = $value;
        if (!$value || $value == 0) {
            $this->searchTerm = '';
            $this->filteredAffiliates = [];
            $this->showList = false;
        } else {
            $model = Affiliate::find($value);
            $this->searchTerm = $model?->user?->full_name ?? '';
        }
    }
}
