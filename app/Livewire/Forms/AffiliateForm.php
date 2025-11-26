<?php

namespace App\Livewire\Forms;

use App\Models\Affiliate;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class AffiliateForm extends Form
{
    public function rules()
    {
        return [
            'enrollment_conalab' => ['required', 'numeric', Rule::unique('affiliates', 'enrollment_conalab')->ignore($this->id)],
/*             'enrollment_RPA' => ['required', 'numeric', Rule::unique('affiliates', 'enrollment_RPA')->ignore($this->id)],
 */         'number' => ['required', 'string','min:2','max:15', Rule::unique('affiliates', 'number')->ignore($this->id)],
            'date' => ['required', 'date', 'before:' . now()->subYears(18)->toDateString(),],
        ];
    }
    public ?Affiliate $affiliate;
    public $id = 0;
    #[Validate('required|string|min:2|max:20')]
    public $enrollment_conalab = '';
    public $enrollment_RPA = '';
    #[Validate('required|not_in:Elegir')]
    public $sede = 'Elegir';
    #[Validate('required|string|min:3|max:50')]
    public $profession = '';
    #[Validate('required|not_in:Elegir')]
    public $profession_status = 'Elegir';
    #[Validate('nullable|min:3|max:100')]
    public $institution = '';
    #[Validate('required|min:3|max:100')]
    public $address_office = '';
    #[Validate('required|string|min:1|max:20')]
    public $address_number = '';
    #[Validate('required|string|min:3|max:100')]
    public $zone = '';
    #[Validate('required|string|min:3|max:100')]
    public $address_home = '';
    #[Validate('required|string|min:1|max:20')]
    public $address_number_home = '';
    #[Validate('required|string|min:1|max:100')]
    public $zone_home = '';
    #[Validate('required|string|min:3|max:50')]
    public $sport = '';
    #[Validate('required|string|min:3|max:50')]
    public $place = '';
    #[Validate('required|not_in:Elegir')]
    public $university_id = 'Elegir';
    public $date = '';
    public $number = '';
    #[Validate('required|not_in:Elegir')]
    public $status = 'Elegir';


    public function setAffiliate(Affiliate $affiliate)
    {
        $this->affiliate = $affiliate;

        $this->fill($affiliate->only([
            'id',
            'enrollment_conalab',
            'enrollment_RPA',
            'sede',
            'profession',
            'profession_status',
            'institution',
            'address_office',
            'address_number',
            'zone',
            'address_home',
            'address_number_home',
            'zone_home',
            'sport',
            'place',
            'university_id',
            'date',
            'number',
            'status',
        ]));
    }
    public function store(User $user)
    {
        $this->enrollment_RPA = $user->ci . $this->getInitials($user->name) . $this->getInitials($user->last_name);
        $user->affiliate()->create($this->all());
    }
    function getInitials($string)
    {
        $words = explode(' ', $string);
        $initials = '';
        foreach ($words as $word) {
            if (strlen($word) > 0) {
                $initials .= strtoupper($word[0]);
            }
        }
        return $initials;
    }
    public function update()
    {
        $this->affiliate->update(
            $this->all()
        );
        return $this->affiliate;
    }
}
