<?php

namespace App\Livewire\Institutions;

use App\Models\Institution;
use Livewire\Component;
use Livewire\WithFileUploads;

use function Laravel\Prompts\text;

class InstitutionComponent extends Component
{
    use WithFileUploads;
    public $photo, $image;
    public array $institution = [];
    public function mount()
    {
        $this->authorize('configuration');
        $inst = Institution::find(1);
        $this->image = $inst->image;
        $this->institution = $inst ? $inst->toArray() : [];
    }
    public function render()
    {
        return view('livewire.institutions.institution-component');
    }
    public function rules()
    {
        return [
            'institution.name' => 'required|string|max:200',
            'institution.email' => 'required|email|max:150',
            'institution.phone' => 'required|string|max:10',
            'institution.address' => 'required|string|max:255',
            'institution.initials' => 'required|string|max:10',
            'institution.city' => 'required|not_in:Elegir',
            'institution.mission' => 'required|string',
            'institution.vision' => 'required|string',
            'photo' => $this->image ? 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }

    public function update()
    {
        $this->validate();

        $inst = Institution::find(1);
        if ($inst) {
/*             dd($this->photo);   
 */            if ($this->photo) {
/*     dd("dsd");
 */                $custome_name = uniqid() . '.' . $this->photo->extension();
                $this->photo->storeAs('institution', $custome_name, 'public');
                if ($inst->logo) {
                    if (file_exists(public_path('storage/institution/' . $inst->logo))) {
                        unlink(public_path('storage/institution/' . $inst->logo));
                    }
                }
                $this->image = $custome_name;
            } else {
                $this->image = $inst->logo;
            }
            $inst->update([
                "id" => $this->institution['id'],
                "name" => $this->institution['name'],
                "initials" => $this->institution['initials'],
                "logo" => $this->image,
                "phone" => $this->institution['phone'],
                "email" => $this->institution['email'],
                "address" => $this->institution['address'],
                "city" => $this->institution['city'],
                "mission" => $this->institution['mission'],
                "vision" => $this->institution['vision']

            ]);
            $this->dispatch('notify', text: 'Los datos de la institución se modificaron correctamente', title: 'Datos se actualizaron', icon: 'success');
        } else {
            $this->dispatch('notify', text: 'No se pudo encontrar el registro que desea modificar', title: 'Registro invalido', icon: 'error');
        }
        $this->photo=null;
        $this->image = $inst->image;
    }
}
