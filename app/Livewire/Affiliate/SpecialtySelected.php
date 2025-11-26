<?php

namespace App\Livewire\Affiliate;

use App\Models\Specialty;
use Livewire\Attributes\Modelable;
use Livewire\Component;

class SpecialtySelected extends Component
{
    #[Modelable]
    public $value = ''; // Aquí se guarda el ID (university_id o specialty_id)
    public $index = null;
    public $searchTerm = '';
    public $filteredSpecialties = [];
    public $showList = false;
    public function mount()
    {
        

        if ($this->value && is_numeric($this->value)) { 
            $model = Specialty::find($this->value);
            $this->searchTerm = $model?->name ?? '';
        }
    }

    public function render()
    {
        return view('livewire.affiliate.specialty-selected');
    }

    public function updatedSearchTerm()
    {
        $this->filteredSpecialties = Specialty::where('name', 'like', '%' . $this->searchTerm . '%')
            ->select('id', 'name')
            ->take(5)
            ->get();
    }

    public function selectUniversity($id)
    {
        $specialty = Specialty::find($id);
        $this->value = $specialty->name;
        $this->searchTerm = $specialty ? $specialty->name : '';
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
}
