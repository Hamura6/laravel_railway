<?php

namespace App\Livewire\Agreements;

use App\Models\Agreement;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Laravel\Facades\Image;

use function Laravel\Prompts\text;

class FormAgreement extends Component
{
    use WithFileUploads;
    public $id, $name, $photo, $image, $social = [];
    public function mount($id = 0)
    {
        if (! (Auth::user()->can('Crear convenios') || Auth::user()->can('Editar convenios'))) {
            abort(403, 'No tienes permiso');
        }
        $this->id = $id;

        if ($id <= 0) {
            return;
        }

        $agreement = Agreement::with('socials')->find($id);
        if (!$agreement) return;
        $this->name = $agreement->name;
        $this->image = $agreement->image_view;
        $this->social = $agreement->socials->map(function ($s) {
            return ['type' => $s->type, 'url' => $s->url];
        })->toArray();
    }
    public function render()
    {
        return view('livewire.agreements.form-agreement');
    }
    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'photo' => $this->id ? 'nullable|image|mimes:jpg,jpeg,png|max:2048'
                : 'required|image|mimes:jpg,jpeg,png|max:2048',
            'social' => 'array',
            'social.*.type' => 'required|string',
            'social.*.url' => 'required|url',
        ];
    }
    public function store()
    {
        $this->authorize('Crear convenios');
        $this->validate();
        if ($this->photo) {
            $this->image = uniqid() . '.webp' ;
            $storagePath  = storage_path('app/public/agreements/' . $this->image);
            if (!file_exists(dirname($storagePath))) {
                mkdir(dirname($storagePath), 0755, true);
            }
            Image::read($this->photo->getRealPath())
                ->toWebp(quality: 60)
                ->save($storagePath);
            //$this->photo->storeAs('agreements', $this->image, 'public');
        }
        $agreement = Agreement::create([
            'name' => $this->name,
            'images' => $this->image,
        ]);
        foreach ($this->social as $s) {
            $agreement->socials()->create($s);
        }
        return redirect()->route('agreements');
    }
    public function update()
    {
        $this->authorize('Editar convenios');
        $this->validate();
        $agreement = Agreement::find($this->id);
        if ($this->photo) {
            $custome_name = uniqid() . '.webp';
            $storagePath  = storage_path('app/public/agreements/' . $custome_name);
            Image::read($this->photo->getRealPath())
                ->toWebp(quality: 60)
                ->save($storagePath);
            //$this->photo->storeAs('agreements', $custome_name, 'public');
            if ($agreement->images) {
                if (file_exists(public_path('storage/agreements/' . $agreement->images))) {
                    unlink(public_path('storage/agreements/' . $agreement->images));
                }
            }
            $this->image = $custome_name;
        } else {
            $this->image = $agreement->images;
        }
        $agreement->update([
            'name' => $this->name,
            'images' => $this->image,
        ]);
        $agreement->socials()->delete();
        foreach ($this->social as $s) {
            $agreement->socials()->create($s);
        }
        return redirect()->route('agreements');
    }
    /*     public function addSocial(){
        $this->social=[];
    } */
}
