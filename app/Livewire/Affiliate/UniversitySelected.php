<?php

namespace App\Livewire\Affiliate;

use App\Models\University;
use Livewire\Attributes\Modelable;
use Livewire\Component;

class UniversitySelected extends Component
{
    #[Modelable]
    public $value = ''; // Aquí se guarda el ID (university_id o specialty_id)
    public $index = null;
    public $searchTerm = '';
    public $filteredUniversities = [];
    public $showList = false;
    public $displayName = '';
    /*     public function rules(){
        return[
            'value'=>'required|not_in:Elegir'
        ];
    } */
    public function mount()
    {
        if ($this->value && is_numeric($this->value)) {
            $model = University::find($this->value);
            $this->searchTerm = $model ? $model->name . ' - ' . $model->entity : '';
        }
    }
    public function render()
    {
        $universities = University::select('id', 'name', 'entity')->get();
        return view('livewire.affiliate.university-selected', compact('universities'));
    }
    public function updatedSearchTerm()
    {
        $this->filteredUniversities = University::where('name', 'like', '%' . $this->searchTerm . '%')
            ->select('id', 'name', 'entity')
            ->take(5)
            ->get();
    }

    public function selectUniversity($id)
    {
        $this->value = $id;
        $university = University::find($id);
        $this->searchTerm = $university ? $university->name . ' - ' . $university->entity : '';
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
