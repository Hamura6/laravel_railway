{{-- <section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your name and email address')">
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
            <flux:input wire:model="name" :label="__('Name')" type="text" required autofocus autocomplete="name" />

            <div>
                <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email" />

                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                    <div>
                        <flux:text class="mt-4">
                            {{ __('Your email address is unverified.') }}

                            <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                                {{ __('Click here to re-send the verification email.') }}
                            </flux:link>
                        </flux:text>

                        @if (session('status') === 'verification-link-sent')
                            <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </flux:text>
                        @endif
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>

        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
 --}}

<div>
    <div class="col-12">
        <x-card-header title="Perfil" name="Perfil" />

    </div>
    <div class="row g-1">
        <div class="col-md-12">
            <x-card-body>
                <x-slot name="header">
                    <div class="d-flex justify-content-start">
                        <h6 class="px-2 my-auto py-0">Datos personales</h6>
                    </div>
                </x-slot>
                <div class="row g-1">
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" wire:model="name"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                id="floatingInputInvalid" placeholder="...">
                            <label for="floatingInputInvalid">
                                Nombres
                            </label>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" wire:model="last_name"
                                class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                id="floatingInputInvalid" placeholder="...">
                            <label for="floatingInputInvalid">
                                Apellidos
                            </label>
                            @error('last_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" wire:model="ci" class="form-control @error('ci') is-invalid @enderror"
                                name="ci" id="floatingInputInvalid" placeholder="...">
                            <label for="floatingInputInvalid">
                                Nro de C.I.
                            </label>
                            @error('ci')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="date" wire:model="birthdate"
                                class="form-control @error('birthdate') is-invalid @enderror" name="birthdate"
                                id="floatingInputInvalid" placeholder="...">
                            <label for="floatingInputInvalid">
                                Fecha de Nacimiento
                            </label>
                            @error('birthdate')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="form-floating">
                            <select wire:model="gender" class="form-select  @error('gender') is-invalid @enderror"
                                id="gender" aria-label="Seleccion genero">
                                <option value="Elegir" disabled>Eligir</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                            </select>
                            <label for="floatingSelect">Seleccione un genero</label>
                        </div>
                        @error('gender')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <select wire:model="martial_status"
                                class="form-select @error('martial_status') is-invalid @enderror" id="gender"
                                aria-label="Seleccion genero">
                                <option value="Elegir" disabled>Eligir</option>
                                <option value="Casado">Casado</option>
                                <option value="Soltero">Soltero</option>
                                <option value="Divorciado">Divorciado</option>
                                <option value="Viudo">Viudo</option>
                                <option value="Comprometido">Comprometido</option>
                            </select>
                            <label for="floatingSelect">Seleccione su estado civil</label>
                        </div>
                        @error('martial_status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <div class="card-footer pt-2 m-0 pb-0 mt-2 border-top">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn  btn-sm btn-dark me-md-2" type="button" wire:click="savePeople()"> <i
                                class="fas fa-save fs-6"></i> Guardar</button>
                    </div>
                </div>
            </x-card-body>
        </div>
        <div class="col-md-6">
            <x-card-body>
                <x-slot name="header">
                    <div class="d-flex justify-content-start">
                        <h6 class="px-2 my-auto py-0">Datos de usuario</h6>
                    </div>
                </x-slot>


                <div class="row g-1">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-center mb-4" wire:ignore>
                            <!-- Imagen que se actualizará -->
                            <img id="profileImage" class="border-radius-lg rounded-circle" width="200" height="200"
                                src="{{ $this->image ? $this->image : 'https://i.pinimg.com/originals/bd/2e/0d/bd2e0d56cc9b061d694979158bda4d0b.jpg' }}"
                                alt="Imagen de perfil" wire:loading.remove wire:target="photo">

                            <!-- Spinner de carga -->
                            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" wire:loading
                                wire:target="photo" role="status">
                                <span class="visually-hidden">Cargando...</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="basic-url">Elija imagen</label>
                            <div class="input-group">
                                <input type="file" wire:model="photo" wire:target="photo"
                                    wire:loading.attr="disabled"
                                    class="form-control @error('photo')
                                is-invalid
                            @enderror"
                                    id="basic-url" aria-describedby="basic-addon3">
                                @error('photo')
                                    <div id="validationServer05Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <script>
                        // Vista previa de imagen antes de subir
                        document.addEventListener('DOMContentLoaded', function() {
                            const inputFile = document.querySelector('input[type="file"][wire\\:model="photo"]');
                            const profileImage = document.getElementById('profileImage');

                            if (inputFile) {
                                inputFile.addEventListener('change', function(e) {
                                    if (e.target.files && e.target.files[0]) {
                                        const reader = new FileReader();
                                        reader.onload = function(event) {
                                            // Mostrar la vista previa local
                                            profileImage.src = event.target.result;
                                        };
                                        reader.readAsDataURL(e.target.files[0]);
                                    }
                                });
                            }

                            // Escuchar el evento de Livewire cuando la foto se haya actualizado
                            window.livewire.on('photoUpdated', () => {
                                // Aquí podríamos recargar la imagen del servidor, pero Livewire ya actualizará la vista
                                // Sin embargo, si quieres forzar un refresco de la imagen para evitar caché, podrías hacer:
                                // profileImage.src = profileImage.src + '?t=' + new Date().getTime();
                                // Pero Livewire ya actualizará la propiedad $this->image, por lo que la imagen se actualizará automáticamente.
                            });
                        });
                    </script>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="email" wire:model="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                id="floatingInputInvalid" placeholder="...">
                            <label for="floatingInputInvalid">
                                Correo electornico
                            </label>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer pt-2 m-0 pb-0 border-top">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn  btn-sm btn-dark me-md-2" type="button" wire:click="saveUser()"> <i
                                class="fas fa-save fs-6"></i> Guardar</button>
                    </div>
                </div>
            </x-card-body>
        </div>
        <div class="col-md-6">
            <x-card-body>
                <x-slot name="header">
                    <div class="d-flex justify-content-start">
                        <h6 class="px-2 my-auto py-0">Cambiar contrasena</h6>
                    </div>
                </x-slot>
                <div class="row g-1">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="password"
                                class="form-control @error('current_password') is-invalid @enderror"
                                name="current_password" id="floatingInputInvalid" placeholder="..."
                                wire:model="current_password">
                            <label for="floatingInputInvalid">
                                Contraseña actual
                            </label>
                            @error('current_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" id="floatingInputInvalid" placeholder="..." wire:model="password">
                            <label for="floatingInputInvalid">
                                Contraseña
                            </label>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation" id="floatingInputInvalid" placeholder="..."
                                wire:model="password_confirmation">
                            <label for="floatingInputInvalid">
                                Confirmar contraseña
                            </label>
                            @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer pt-2 m-0 pb-0 border-top">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn  btn-sm btn-dark me-md-2" type="button" wire:click="savePassword()"> <i
                                class="fas fa-save fs-6"></i> Guardar</button>
                    </div>
                </div>
            </x-card-body>
        </div>
    </div>


</div>
