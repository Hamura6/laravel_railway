<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Laravel\Facades\Image;

class Profile extends Component
{
    use WithFileUploads;
    public string $name = '';
    public string $last_name = '';
    public string $ci = '';
    public string $birthdate = '';
    public string $gender = '';
    public string $martial_status = '';

    public string $email = '';
    public $photo;
    public string $image = '';

    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $photoPreview = '';
    public function mount(): void
    {
      
        $this->name = Auth::user()->name;
        $this->last_name = Auth::user()->last_name;
        $this->ci = Auth::user()->ci;
        $this->birthdate = Auth::user()->birthdate;
        $this->gender = Auth::user()->gender;
        $this->martial_status = Auth::user()->martial_status;

        $this->photo = '';
        $this->image = Auth::user()->image;
        $this->email = Auth::user()->email;
    }
    public function render()
    {
        return view('livewire.settings.profile');
    }
    public function saveUser()
    {
        /*  if ($this->photo) {
            $custome_name = uniqid() . '.' . $this->photo->extension();
            $this->photo->storeAs('users', $custome_name, 'public');
            if (Auth::user()->photo) {
                if (file_exists(public_path('storage/users/' . Auth::user()->photo))) {
                    unlink(public_path('storage/users/' . Auth::user()->photo));
                }
            }
            $this->photo = $custome_name;
        } else {
            $this->photo = Auth::user()->photo;
        }  */
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
                $avatarNameOld = Auth::user()->photo;
                if (!empty($avatarNameOld) && $disk->exists($avatarNameOld))
                    $disk->delete($avatarNameOld);
                $newPhotoName = $avatarName;
            } else {
                $newPhotoName = Auth::user()->photo;
            }
        } else {
            $newPhotoName = Auth::user()->photo;
        }
        Auth::user()->update([
            'photo' => $newPhotoName,
            'email' => $this->email
        ]);

        $this->image = Auth::user()->image;
        $this->photo = '';
        /*         dd($this->image);
 */
        $this->dispatch('notify', text: 'Los datos de usuario fueron actualizados', title: 'Usuario actualizado', icon: 'success');
    }
    public function savePeople()
    {
        Auth::user()->update([
            'name' => $this->name,
            'last_name' => $this->last_name,
            'ci' => $this->ci,
            'birthdate' => $this->birthdate,
            'gender' => $this->gender,
            'martial_status' => $this->martial_status,
        ]);
        $this->dispatch('notify', text: 'Los datos personales fueron actualizados', title: 'Datos personales actualizado', icon: 'success');
    }
    public function savePassword()
    {

        $this->validate([
            'current_password' => ['required'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
        ]);

        if (! Hash::check($this->current_password, Auth::user()->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'La contraseña actual no es correcta.',
            ]);
        }
        Auth::user()->update([
            'password' => Hash::make($this->password)
        ]);
        $this->dispatch('notify', text: 'La contraseña fue actualizada', title: 'Contraseña actualizada', icon: 'success');
        $this->reset(['current_password', 'password', 'password_confirmation']);
    }





    /*     public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id),
            ],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    } */
}
