<div>
    <div class="col-12">
        <x-card-header title="Perfil" name="Perfil" />

    </div>
    <div class="row g-1">
        @if ($this->idAffiliate)
            
        <div class="col-md-12">
            <div class="card border  mb-0 h-100 d-flex flex-column">
                <div class="card-header">
                    <h6 class="px-2 my-auto py-0">Datos de afiliado</h6>
                </div>
                <div class="card-body ">
                    <div class="row g-1">

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" wire:model="enrollment_conalab"
                                    class="form-control @error('enrollment_conalab') is-invalid @enderror"
                                    name="enrollment_conalab" id="enrollment_conalab" placeholder="...">
                                <label for="enrollment_conalab">
                                    Matrícula CONALAB
                                </label>
                                @error('enrollment_conalab')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-floating">
                                <select wire:model="sede"
                                    class="form-select  @error('sede') is-invalid @enderror" id="sede"
                                    aria-label="Seleccion sede">
                                    <option value="Elegir">Eligir</option>
                                    <option value="La paz">La paz</option>
                                    <option value="Cochabamba">Cochabamba</option>
                                    <option value="Santa Cruz">Santa Cruz</option>
                                    <option value="Oruro">Oruro</option>
                                    <option value="Potosí">Potosí</option>
                                    <option value="Chuquisaca">Chuquisaca</option>
                                    <option value="Tarija">Tarija</option>
                                    <option value="Beni">Beni</option>
                                    <option value="Pando">Pando</option>
                                </select>
                                <label for="sede">Sede</label>
                            </div>
                            @error('sede')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" wire:model="profession"
                                    class="form-control @error('profession') is-invalid @enderror"
                                    name="profession" id="profession" placeholder="...">
                                <label for="profession">
                                    Ejercicio Profesional
                                </label>
                                @error('profession')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-floating">
                                <select wire:model="profession_status"
                                    class="form-select  @error('profession_status') is-invalid @enderror"
                                    id="profession_status" aria-label="Seleccion sede">
                                    <option value="Libre">Libre</option>
                                    <option value="Funcion publica">Funcion publica</option>
                                    <option value="privada">privada</option>
                                </select>
                                <label for="sede"></label>
                            </div>
                            @error('profession_status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" wire:model="institution"
                                    class="form-control @error('institution') is-invalid @enderror"
                                    name="institution" id="institution" placeholder="...">
                                <label for="institution">
                                    Institución
                                </label>
                                @error('institution')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-floating">
                                <input type="text" wire:model="address_office"
                                    class="form-control @error('address_office') is-invalid @enderror"
                                    name="address_office" id="address_office" placeholder="...">
                                <label for="address_office">
                                    Domicilio Procesal
                                </label>
                                @error('address_office')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <input type="number" wire:model="address_number"
                                    class="form-control @error('address_number') is-invalid @enderror"
                                    name="address_number" id="address_number" placeholder="...">
                                <label for="address_number">
                                    No.
                                </label>
                                @error('address_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-floating">
                                <input type="text" wire:model="zone"
                                    class="form-control @error('zone') is-invalid @enderror" name="zone"
                                    id="zone" placeholder="...">
                                <label for="zone">
                                    Zona
                                </label>
                                @error('zone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer py-1 d-flex gap-1 justify-content-md-end">
                    <button class="btn  btn-sm btn-dark me-md-2" type="button" wire:click="saveAffiliate()"> <i
                            class="fas fa-save fs-6"></i> Guardar</button>
                </div>
            </div>
        </div>
                @endif

        <div class="col-md-12">
            <div class="card border  mb-0 h-100 d-flex flex-column">
                <div class="card-header">
                    <div class="d-flex justify-content-start">
                        <h6 class="px-2 my-auto py-0">Datos personales</h6>
                    </div>
                </div>
                <div class="card-body ">
                    <div class="row g-1">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" wire:model="name"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    id="name" placeholder="...">
                                <label for="name">
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
                                    id="last_name" placeholder="...">
                                <label for="last_name">
                                    Apellidos
                                </label>
                                @error('last_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" wire:model="ci"
                                    class="form-control @error('ci') is-invalid @enderror" name="ci"
                                    id="ci" placeholder="...">
                                <label for="ci">
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
                                    id="birthdate" placeholder="...">
                                <label for="birthdate">
                                    Fecha de Nacimiento
                                </label>
                                @error('birthdate')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select wire:model="gender"
                                    class="form-select  @error('gender') is-invalid @enderror" id="gender"
                                    aria-label="Seleccion genero">
                                    <option value="Elegir" disabled>Eligir</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                                <label for="gender">Seleccione un genero</label>
                            </div>
                            @error('gender')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select wire:model="martial_status"
                                    class="form-select @error('martial_status') is-invalid @enderror" id="martial_status"
                                    aria-label="Seleccion genero">
                                    <option value="Casado">Casado(a)</option>
                                    <option value="Soltero">Soltero(a)</option>
                                    <option value="Divorciado">Divorciado(a)</option>
                                    <option value="Viudo">Viudo(a)</option>
                                </select>
                                <label for="martial_status">Seleccione su estado civil</label>
                            </div>
                            @error('martial_status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        @if ($this->idAffiliate)
                            
                        <div class="col-md-8">
                            <div class="form-floating">
                                <input type="text" wire:model="place"
                                    class="form-control @error('place') is-invalid @enderror" name="place"
                                    id="place" placeholder="...">
                                <label for="place">
                                    Lugar
                                </label>
                                @error('place')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" wire:model="sport"
                                    class="form-control @error('sport') is-invalid @enderror" name="sport"
                                    id="sport" placeholder="...">
                                <label for="sport">
                                    Deporte que práctica
                                </label>
                                @error('sport')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-floating">
                                <input type="text" wire:model="address_home"
                                    class="form-control @error('address_home') is-invalid @enderror"
                                    name="address_home" id="address_home" placeholder="...">
                                <label for="address_home">
                                    Domicilio
                                </label>
                                @error('address_home')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <input type="number" wire:model="address_number_home"
                                    class="form-control @error('address_number_home') is-invalid @enderror"
                                    name="address_number_home" id="address_number_home" placeholder="...">
                                <label for="address_number_home">
                                    No.
                                </label>
                                @error('address_number_home')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-floating">
                                <input type="text" wire:model="zone_home"
                                    class="form-control @error('zone_home') is-invalid @enderror"
                                    name="zone_home" id="zone_home" placeholder="...">
                                <label for="zone">
                                    Zona
                                </label>
                                @error('zone_home')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" wire:model="phones.0"
                                    class="form-control @error('phones.0') is-invalid @enderror" name="phones.0"
                                    id="phones.0" placeholder="...">
                                <label for="phones.0">
                                    Celular
                                </label>
                                @error('phones.0')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" wire:model="phones.1"
                                    class="form-control @error('phones.1') is-invalid @enderror" name="phones.1"
                                    id="phones.1" placeholder="...">
                                <label for="phones.1">
                                    Teléfono
                                </label>
                                @error('phones.1')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                                                @endif

                    </div>
                </div>
                <div class="card-footer py-1 d-flex gap-1 justify-content-md-end">
                    <button class="btn  btn-sm btn-dark me-md-2" type="button" wire:click="savePeople()"> <i
                            class="fas fa-save fs-6"></i> Guardar</button>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="card border  mb-0 h-100 d-flex flex-column">
                <div class="card-header">
                    <div class="d-flex justify-content-start">
                        <h6 class="px-2 my-auto py-0">Datos de usuario</h6>
                    </div>
                </div>

                <div class="card-body ">
                    <div class="row g-1">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-center mb-4">
                                <img id="profileImage" class="border-radius-lg rounded-circle" width="200"
                                    height="200"
                                    src="{{ $this->photo ? $this->photo->temporaryUrl() : ($this->image ? $this->image : 'image/user.png') }}"
                                    alt="Imagen de perfil" wire:loading.remove wire:target="photo">
                                <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;"
                                    wire:loading wire:target="photo" role="status">
                                    <span class="visually-hidden">Cargando...</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="basic-url">Elija imagen</label>
                                <div class="input-group">
                                    <input type="file" wire:model.lazy="photo" wire:target="photo"
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

                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="email" wire:model="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    id="email" placeholder="...">
                                <label for="email">
                                    Correo electornico
                                </label>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer py-1 d-flex gap-1 justify-content-md-end">
                    <button class="btn  btn-sm btn-dark me-md-2" type="button" wire:click="saveUser()"> <i
                            class="fas fa-save fs-6"></i> Guardar</button>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border  mb-0 h-100 d-flex flex-column">
                <div class="card-header">
                    <div class="d-flex justify-content-start">
                        <h6 class="px-2 my-auto py-0">Cambiar contrasena</h6>
                    </div>
                </div>
                <div class="card-body ">
                    <div class="row g-1">
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="password"
                                    class="form-control @error('') is-invalid @enderror"
                                    name="current_password" id="current_password" placeholder="..."
                                    wire:model="current_password">
                                <label for="current_password">
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
                                    name="password" id="password" placeholder="..."
                                    wire:model="password">
                                <label for="password">
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
                                    name="password_confirmation" id="password_confirmation" placeholder="..."
                                    wire:model="password_confirmation">
                                <label for="password_confirmation">
                                    Confirmar contraseña
                                </label>
                                @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer py-1 d-flex gap-1 justify-content-md-end">
                    <button class="btn  btn-sm btn-dark me-md-2" type="button" wire:click="savePassword()">
                        <i class="fas fa-save fs-6"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>


</div>
