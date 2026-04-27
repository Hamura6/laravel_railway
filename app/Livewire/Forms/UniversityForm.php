<?php

namespace App\Livewire\Forms;

use App\Models\University;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UniversityForm extends Form
{
    public function rules(){
        return [
            'name'=>['required','min:10','max:200',Rule::unique('universities','name')->ignore($this->id)]
        ];

    }
    public $id=0;
    public $name='';
    #[Validate('required|not_in:Elegir')]
    public $entity='Elegir';
    public? University $university;

    public function store(){
        $this->validate();
        University::create(
            $this->all()
        );
    }
    public function setUniversity(University $university){
        $this->university=$university;
        $this->id=$university->id;
        $this->name=$university->name;
        $this->entity=$university->entity;
    }
    public function update(){
        $this->university->update(
            $this->all()
        );
    }
}
