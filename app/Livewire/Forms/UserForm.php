<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserForm extends Form
{
    public function rules()
    {
        return [
            'birthdate' => ['required', 'date', 'before:' . now()->subYears(18)->toDateString(),],
            'ci' => ['required', 'string', 'min:6','max:15', Rule::unique('users', 'ci')->ignore($this->id)],
            'email' => ['required', 'max:210', 'email:rfc,dns', Rule::unique('users', 'email')->ignore($this->id)],
        ];
    }

    public ?User $user;
    public  $id = 0;
    #[Validate('required|string|regex:/^[^0-9]*$/|min:3|max:50')]
    public $name = '';
    #[Validate('required|string|regex:/^[^0-9]*$/|min:3|max:50')]
    public $last_name = '';
    public $birthdate = '';
    #[Validate('required|not_in:Elegir')]
    public $gender = 'Elegir';
    #[Validate('required|not_in:Elegir')]
    public $martial_status = 'Elegir';
    public $ci = '';
    public $email = '';

    public $photo = '';
    #[Validate('required|not_in:Elegir')]
    public $status = 'ENABLED';
    public $password = '';
    public function store()
    {
        $this->password = Hash::make($this->ci);
        $this->status = 'ENABLED';
        $user = User::create($this->all());
        return $user;
    }
    public function setUser(User $user)
    {
        $this->fill($user->only([
            'name',
            'last_name',
            'birthdate',
            'gender',
            'martial_status',
            'ci',
            'email',
            'photo',
            'status'
        ]));
        $this->id = $user->id;
        $this->user = $user;
    }
    public function update()
    {
        $this->user->update(
            $this->all()
        );
    }
}
