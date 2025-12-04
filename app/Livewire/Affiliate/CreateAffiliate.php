<?php

namespace App\Livewire\Affiliate;

use App\Livewire\Forms\AffiliateForm;
use App\Livewire\Forms\UserForm;
use App\Models\Affiliate;
use App\Models\Fee;
use App\Models\Specialty;
use App\Models\University;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;

use Livewire\WithFileUploads;

class CreateAffiliate extends Component
{
    use WithFileUploads;
    public UserForm $userForm;
    public AffiliateForm $form;
    public $photo, $photoName, $image, $phones = [], $id = 0;
    public $specialtiesArray = [['university_id' => '', 'specialty_id' => '', 'area' => '', 'date' => '']];
    public $universities = [];
    public $specialties = [];

    public function mount($id = 0)
    {
        if (! (Auth::user()->can('affiliates.create') || Auth::user()->can('affiliates.edit'))) {
            abort(403, 'No tienes permiso');
        }
        if ($id) {
            $this->loadAffiliateData($id);
        }
        $this->universities = University::select('id', 'name', 'entity')
            ->orderBy('name')
            ->get()
            ->map(fn($u) => [
                'value' => $u->id,
                'text'  => $u->name . ' - ' . $u->entity
            ])->toArray();

        $this->specialties = Specialty::select('id', 'name')
            ->orderBy('name')
            ->get()
            ->map(fn($s) => [
                'value' => $s->id,
                'text'  => $s->name,
            ])->toArray();
    }
    private function loadAffiliateData(int $id): void
    {
        $affiliate = Affiliate::with(['user.phones', 'professions.university', 'professions.specialty'])
            ->find($id);

        if (!$affiliate) {
            return;
        }

        $this->id = $id;
        $this->userForm->setUser($affiliate->user);
        $this->form->setAffiliate($affiliate);
        $this->image = $affiliate->user->image;
        $this->photoName = $affiliate->user->photo;
        $this->phones = $this->getPhonesArray($affiliate->user);
        $this->specialtiesArray = $this->getSpecialtiesArray($affiliate->professions);
    }
    public function render()
    {
        return view('livewire.affiliate.create-affiliate');
    }

    public function store()
    {
        $this->authorize('affiliates.create');
        DB::transaction(function () {
            $this->validate();
            if ($this->photo instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
                $disk = User::storageDisk();
                $$custome_name = $this->photo->hashName();
                $avatarPath = $disk->path($$custome_name);
                Image::read($this->photo)->resize(250, 250)->toJpeg()->save($avatarPath);
                $this->userForm->photo = $custome_name;
                /*    $custome_name = uniqid() . '.' . $this->photo->extension();
                $this->photo->storeAs('users', $custome_name, 'public');
                $this->userForm->photo = $custome_name; */
            }
            $user = $this->userForm->store();
            $this->form->store($user);
            $user->assignRole('Afiliado');

            // Crear teléfonos
            $user->phones()->createMany(
                collect($this->phones)->map(fn($phone) => ['number' => $phone])->toArray()
            );

            // Crear especialidades/profesiones
            foreach ($this->specialtiesArray as $specialty) {
                $firstOrCreate = Specialty::firstOrCreate(
                    ['name' => $specialty['specialty_id']],
                    ['name' => $specialty['specialty_id']]
                );

                $user->affiliate->professions()->create([
                    'area' => $specialty['area'],
                    'date' => $specialty['date'],
                    'university_id' => $specialty['university_id'],
                    'specialty_id' => $firstOrCreate->id
                ]);
            }

            // Crear pagos
            $fees = [2, 1]; // IDs de los fees
            foreach ($fees as $fee_id) {
                $user->affiliate->payments()->create([
                    'fee_id' => $fee_id,
                    'date' => now(),
                    'amount' => Fee::find($fee_id)->amount,
                    'status' => 'Por pagar'
                ]);
            }

            // Redirigir al final de la transacción
            return redirect()->route('form.affiliate', $user->affiliate->id);
        });
    }
    public function update()
    {
        $this->authorize('affiliates.edit');
        $this->validate();
       /*  if ($this->photo instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
            $disk = User::storageDisk();
            $custome_name = $this->photo->hashName();
            $avatarPath = $disk->path($custome_name);
            Image::read($this->photo)->resize(250, 250)->toJpeg()->save($avatarPath);
            $this->userForm->photo = $custome_name;
               $custome_name = uniqid() . '.' . $this->photo->extension();
                $this->photo->storeAs('users', $custome_name, 'public');
                $this->userForm->photo = $custome_name; 
        } */
        if ($this->photo instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
            $disk = User::storageDisk();
            $custome_name = $this->photo->hashName();
            $avatarPath = $disk->path($custome_name);
            $pass = true;
            try {
                Image::read($this->photo)->resize(250, 250)->toJpeg()->save($avatarPath);
            } catch (\Throwable $th) {
                $pass = false;
            }
            if ($pass) {
                if (!empty($this->userForm->photo) && $disk->exists($this->userForm->photo))
                    $disk->delete($this->userForm->photo);
                $newPhotoName = $custome_name;
            } else {
                $newPhotoName = $this->userForm->photo;
            }
            /*  $custome_name = uniqid() . '.' . $this->photo->extension();
            $this->photo->storeAs('users', $custome_name, 'public'); */
            
            $this->userForm->photo = $newPhotoName;
            /* $custome_name = uniqid() . '.' . $this->photo->extension();
            $this->photo->storeAs('users', $custome_name, 'public');
            if ($this->userForm->photo) {
                if (file_exists(public_path('storage/users/' . $this->userForm->photo))) {
                    unlink(public_path('storage/users/' . $this->userForm->photo));
                }
            }
            $this->userForm->photo = $custome_name; */
        }
        $this->userForm->update();
        $affiliate = $this->form->update();
        $affiliate->professions()->delete();
        foreach ($this->specialtiesArray as $specialty) {
            $firstOrCreate = Specialty::firstOrCreate(
                ['name' => $specialty['specialty_id']],
                ['name' => $specialty['specialty_id']]
            );

            $affiliate->professions()->create([
                'area' => $specialty['area'],
                'date' => $specialty['date'],
                'university_id' => $specialty['university_id'],
                'specialty_id' => $firstOrCreate->id
            ]);
        }
        /*  foreach ($this->specialtiesArray as $specialty) {
            if (!Specialty::find($specialty['specialty_id'])) {
                $firstOrCreate = Specialty::firstOrCreate(['name' => $specialty['specialty_id']], ['name' => $specialty['specialty_id']]);
            } else {
                $firstOrCreate = Specialty::find($specialty['specialty_id']);
            }
            $affiliate->professions()->create([
                'area' => $specialty['area'],
                'date' => $specialty['date'],
                'university_id' => $specialty['university_id'],
                'specialty_id' => $firstOrCreate->id
            ]);
        } */
        $affiliate->user->phones()->delete();
        $affiliate->user->phones()->createMany(
            collect($this->phones)->map(fn($phone) => ['number' => $phone])->toArray()
        );
        return $this->redirect('/affiliates', navigate: true);
    }

    public function rules()
    {
        $fechaMaxima = now()->subYears(18)->toDateString();
        return [
            'photo' => $this->photoName ? 'nullable|image|mimes:jpg,jpeg,png' : 'required|image|mimes:jpg,jpeg,png',
            'phones' => 'required|array|min:1',
            'phones.1' => 'nullable|numeric|digits:7|min:2000000|max:2999999',
            'phones.0' => 'required|numeric|digits:8|min:60000000|max:79999999',
            'specialtiesArray.*' => 'nullable|array',
            'specialtiesArray.*.university_id' => 'required|not_in:Elegir|exists:universities,id',
            'specialtiesArray.*.specialty_id' => 'required|not_in:Elegir',
            'specialtiesArray.*.area' => 'required|not_in:Elegir',
            'specialtiesArray.*.date' => [
                'required',
                'date',
                'before_or_equal:' . $fechaMaxima
            ],
        ];
    }


    protected function getPhonesArray($user)
    {
        return $user->phones->pluck('number')->toArray();
    }
    protected function getSpecialtiesArray($professions)
    {
        return $professions->map(fn($profession) => [
            'area' => $profession->area,
            'date' => $profession->date,
            'university_id' => $profession->university_id,
            'specialty_id' => $profession->specialty->name,
            'university_text' => $profession->university->name . ' - ' . $profession->university->entity
        ])->toArray();
    }
}
