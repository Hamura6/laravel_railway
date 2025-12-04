<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Intervention\Image\Laravel\Facades\Image;

class Create extends Component
{
    use WithFileUploads;
    public UserForm $form;
    public $phones = [], $rol = 'Elegir', $photo, $id = 0, $image;
    public function rules()
    {
        return [
            'rol' => 'required|not_in:Elegir',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png',
            'phones' => 'required|array|min:1',
            'phones.*' => 'required|numeric|digits_between:7,8|min:2000000|max:79999999'
        ];
    }
    public function mount($id = 0)
    {
        if (! (Auth::user()->can('users.create') || Auth::user()->can('users.edit'))) {
            abort(403, 'No tienes permiso');
        }
        if ($id <= 0) {
            $this->phones = [''];
            return;
        }

        $user = User::with(['roles', 'phones'])->find($id);
        if (!$user) return;
        $this->form->setUser($user);
        $this->id = $id;
        $this->image = $user->image;

        $this->rol = $user->roles->first()?->name ?? null;
        $this->phones = $user->phones->pluck('number')->toArray();
    }
    public function render()
    {
        $roles = Role::select('name', 'id')->WhereNot('name', 'Afiliado')->get();
        return view('livewire.auth.create', compact('roles'));
    }
    public function store()
    {
        $this->authorize('users.create');
        $this->validate();
        if ($this->photo instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
            $disk = User::storageDisk();
            $avatarName = $this->photo->hashName();
            $avatarPath = $disk->path($avatarName);
            Image::read($this->photo)->resize(250, 250)->toJpeg()->save($avatarPath);
            $this->form->photo = $avatarName;
        }
        $user = $this->form->store();
        $user->assignRole($this->rol);
        $user->phones()->createMany(
            collect($this->phones)->map(fn($phone) => ['number' => $phone])->toArray()
        );

        return $this->redirect('/users');
    }
    public function update()
    {
        $this->authorize('users.edit');
        $this->validate();
        $user = User::find($this->id);
        $user->phones()->delete();
        $user->phones()->createMany(
            collect($this->phones)->map(fn($phone) => ['number' => $phone])->toArray()
        );
        $newPhotoName = '';
        if ($this->photo instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {

            $disk = User::storageDisk();
            $avatarName = $this->photo->hashName();
            $avatarPath = $disk->path($avatarName);

            $pass = true;
            try {
                Image::read($this->photo)->resize(250, 250)->toJpeg()->save($avatarPath);
            } catch (\Throwable $th) {
                $pass = false;
            }

            if ($pass) {
                $avatarNameOld = $user->photo;
                if (!empty($avatarNameOld) && $disk->exists($avatarNameOld))
                    $disk->delete($avatarNameOld);
                $newPhotoName = $avatarName;
            } else {
                $newPhotoName = $user->photo;
            }
        } else {
            $newPhotoName = $user->photo;
        }

        $this->form->photo = $newPhotoName;
        $this->form->update();
        $user->syncRoles($this->rol);
        return $this->redirect('/users');
    }
    public function add()
    {
        $this->phones[] = "";
    }
    public function Phone($index)
    {
        unset($this->phones[$index]);
    }
}
