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

    public $enrollment_conalab = '';
    public $sede = 'Elegir';
    public $profession = '';
    public $profession_status = 'Elegir';
    public $institution = '';
    public $address_office = '';
    public $address_number = '';
    public $zone = '';



    public $place = '';
    public $sport = '';
    public $address_home = '';
    public $address_number_home = '';
    public $zone_home = '';
    public $phones = [];
    public $idAffiliate=0;
    public function mount(): void
    {

        $user = Auth::user();

        $this->name = $user->name;
        $this->last_name = $user->last_name;
        $this->ci = $user->ci;
        $this->birthdate = $user->birthdate;
        $this->gender = $user->gender;
        $this->martial_status = $user->martial_status;

        $this->photo = '';
        $this->image = $user->image;
        $this->email = $user->email;
        if (Auth::user()?->getRoleNames()->first() == 'Afiliado') {
            $this->idAffiliate=$user->affiliate->id;
            $this->enrollment_conalab = $user->affiliate->enrollment_conalab;
            $this->sede = $user->affiliate->sede;
            $this->profession = $user->affiliate->profession;
            $this->profession_status = $user->affiliate->profession_status;
            $this->institution = $user->affiliate->institution;
            $this->address_office = $user->affiliate->address_office;
            $this->address_number = $user->affiliate->address_number;
            $this->zone = $user->affiliate->zone;
            $this->place = $user->affiliate->place;
            $this->sport = $user->affiliate->sport;
            $this->address_home = $user->affiliate->address_home;
            $this->address_number_home = $user->affiliate->address_number_home;
            $this->zone_home = $user->affiliate->zone_home;
            $this->phones = $user->affiliate->phones;
            $this->phones = $user->phones->pluck('number')->toArray();
        }
    }
    public function render()
    {
        return view('livewire.settings.profile');
    }
    public function saveAffiliate(){
        $affiliate=Auth::user()->affiliate;
        $this->validate([
            'enrollment_conalab'=>['required', 'numeric', Rule::unique('affiliates', 'enrollment_conalab')->ignore($affiliate->id)],
            'sede'=> ['required','not_in:Elegir'],
            'profession'=>['required','string','min:3','max:50'],
            'profession_status'=>['required','not_in:Elegir'],
            'institution'=>['nullable','min:3','max:100'],
            'address_office'=>['required','min:3','max:100'],
            'address_number'=>['required','string','min:1','max:20'],
            'zone'=>['required','string','min:3','max:100'],
        ]);
        $affiliate->enrollment_conalab=$this->enrollment_conalab;
        $affiliate->sede=$this->sede;
        $affiliate->profession=$this->profession;
        $affiliate->profession_status=$this->profession_status;
        $affiliate->institution=$this->institution;
        $affiliate->address_office=$this->address_office;
        $affiliate->address_number=$this->address_number;
        $affiliate->zone=$this->zone;
        $affiliate->save();
        $this->dispatch('notify', title: 'Datos actualizados', icon: 'success', text: 'Los datos de afiliado fueron actualizados correctamente');

    }
    public function saveUser()
    {

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

        $this->dispatch('notify', text: 'Los datos de usuario fueron actualizados', title: 'Usuario actualizado', icon: 'success');
    }
    public function savePeople()
    {
        $this->validate([
            'birthdate' => ['required', 'date', 'before:' . now()->subYears(18)->toDateString(),],
            'name' => ['required','string','regex:/^[^0-9]*$/','min:3','max:50'],
            'ci' => ['required', 'string', 'min:6', 'max:15', Rule::unique('users', 'ci')->ignore(Auth::user()->id)],
            'gender' => ['required','not_in:Elegir'],
            'martial_status' => ['required','not_in:Elegir']
        ]);
        if ($this->idAffiliate) {
            $this->validate([

                'place' => ['required','string','min:3','max:50'],
                'sport' => ['required','string','min:3','max:50'],
                'address_home' => ['required','string','min:3','max:100'],
                'address_number_home' => ['required','string','min:1','max:20'],
                'zone_home' => ['required','string','min:1','max:100'],
                'phones' => ['required','array','min:1'],
                'phones.1' => ['nullable','numeric','digits:7','min:2000000','max:2999999'],
                'phones.0' => ['required','numeric','digits:8','min:60000000','max:79999999'],
            ]);
            $affiliate = Auth::user()->affiliate;
            $affiliate->place = $this->place;
            $affiliate->sport = $this->sport;
            $affiliate->address_home = $this->address_home;
            $affiliate->address_number_home = $this->address_number_home;
            $affiliate->zone_home = $this->zone_home;
            $affiliate->save();
            $affiliate->user->phones()->delete();
            $affiliate->user->phones()->createMany(
                collect($this->phones)->map(fn($phone) => ['number' => $phone])->toArray()
            );
        }

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

