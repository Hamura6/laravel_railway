<?php

namespace App\Livewire\Reports;

use App\Models\Affiliate;
use App\Models\Specialty;
use Livewire\Component;
use Livewire\WithPagination;

class SpecialtyAffiliate extends Component
{
    use WithPagination;
    public $specialities = [];
    public $searchTerm = '';
    public $filteredSpecialties = [];
    public $showList = false;
    public function mount()
    {
        $this->specialities = Specialty::orderBy('id', 'asc')->limit(3)->pluck('name')->toArray();
    }

    public function render()
    {
        //dd($this->specialities);
        $specialities = $this->specialities;
        $affiliates = Affiliate::whereHas('professions.specialty', function ($query) {
            $query->whereIn('name', $this->specialities);
        })
            ->with([
                'user:id,name,email,last_name',
                'demands:id,affiliate_id',
                'professions',
            ])
            ->select('id', 'status', 'user_id')
            ->paginate(20);
        return view('livewire.reports.specialty-affiliate', compact('affiliates'));
    }
    public function refreshData()
    {
        $this->specialities = Specialty::orderBy('id', 'asc')->limit(3)->pluck('name')->toArray();
    }
    public function deleteItem($key)
    {
        unset($this->specialities[$key]);
    }
    public function update()
    {
        $this->specialities[] = $this->searchTerm;
        $this->searchTerm = "";
    }
    public function updatedSearchTerm()
    {
        $this->filteredSpecialties = Specialty::where('name', 'like', '%' . $this->searchTerm . '%')
            ->whereNotIn('name',  $this->specialities)
            ->select('id', 'name')
            ->take(5)
            ->get();
    }
    public function selectUniversity($id)
    {
        $specialty = Specialty::find($id);
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
