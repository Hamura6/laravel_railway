<div class="col-12">
    <x-card-header title="{{ $this->id <= 0 ? 'Registrar' : 'Actualizar' }} | Usuario" name="Usuario" />
    <x-card-body>
        <x-slot name='header'>
            <h4 class="font-weight-bolder mb-0 text-dark">Datos Personales</h4>
        </x-slot>

        <form role="form text-left" wire:ignore.self>
            <div class="row g-1">
                <div class="col-md-8">
                    <div class="row g-1">
                        <div class="col-md-6">
                            <x-input-label name="form.name" />

                        </div>
                        <div class="col-md-6">
                            <x-input-label title="apellidos" name="form.last_name" />
                        </div>
                        <div class="col-md-6">
                            <x-input-label title="Nro de Identidad" name="form.ci" type="string" />
                        </div>
                        <div class="col-md-6">
                            <x-input-label title="Fecha de Nac." name="form.birthdate" type="date" />
                        </div>
                        <div class="col-md-6">
                            <x-select title="Seleccione el genero" name="form.gender">
                                <option value="Femenino">Femenino</option>
                                <option value="Masculino">Masculino</option>
                            </x-select>
                        </div>
                        <div class="col-md-6">
                            <x-select title="Seleccione el estado civil" name="form.martial_status">
                                <option value="Casado">Casado</option>
                                <option value="Soltero">Soltero</option>
                                <option value="Divorciado">Divorciado</option>
                                <option value="Viudo">Viudo</option>
                                <option value="Comprometido">Comprometido</option>
                            </x-select>
                        </div>
                        <div class="col-md-12">
                            <x-select title="Seleccione el rol" name="rol">
                                @foreach ($roles as $rol)
                                    <option value="{{ $rol->name }}">{{ $rol->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="col-md-12">
                            <x-input-label type="email" name="form.email" title="Correo electronico" />
                        </div>

                    </div>
                </div>
                <div class="col-md-4">



                    <div class="card align-center shadow-none justify-content-center h-100" align="center">
                        <div class="container">
                            <div
                                class="card-header p-0 mx-3 mt-3 position-relative z-index-1 d-flex justify-content-center align-items-center flex-column">

                                {{-- Imagen --}}
                                @if ($photo)
                                    <img class="border-radius-lg rounded-circle" width="200" height="200"
                                        src="{{ $photo->temporaryUrl() }}" alt="Image placeholder" wire:loading.remove
                                        wire:target="photo">
                                @else
                                    <img class="border-radius-lg rounded-circle" width="200" height="200"
                                        src="{{ $this->image ? $this->image : asset('image/user.png') }}"
                                        alt="Image placeholder" wire:loading.remove wire:target="photo">
                                @endif

                                <span class="spinner-grow text-dark" style="width: 3rem; height: 3rem;" wire:loading
                                    wire:target="photo" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </span>

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
                    </div>

                </div>





                <div class="card-header border-bottom pb-0 mb-2">
                    <h4>Telefonos</h4>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3 text-sm-end">
                    <button class="btn btn-sm btn-warning" wire:click.prevent="add()" wire:target="add"
                        wire:loading.attr="disabled"> <i class="fas fa-plus-circle fs-6"></i> Agregar
                        telefono</button>
                </div>
                <div class="col-md-12">
                    @foreach ($phones as $index => $phone)
                        <div class="row g-1">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text">Telefono {{ $index + 1 }}</span>
                                    <input type="number" wire:model="phones.{{ $index }}"
                                        aria-label="First name"
                                        class="form-control @error('phones.' . $index)
                                            is-invalid
                                        @enderror">

                                </div>
                                @error('phones.' . $index)
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="d-grid gap-2 d-md-flex d-md-block justify-content-md-center">
                                    @if ($index)
                                        <button class=" btn btn-sm btn-danger" wire:target="Phone"
                                            wire:loading.attr="disabled"
                                            wire:click.prevent="Phone({{ $index }})">
                                            <i class="fa-solid fa-trash-can-arrow-up fs-6"></i>
                                            Quitar
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3 text-sm-end">
                    <a href="{{ route('users') }}" wire:target="add,update,store"
                        wire:loading.class="disabled pointer-events-none opacity-50" class="btn btn-sm btn-danger">
                        <i class="fas fa-ban fs-6"></i> Cancel</a>
                    @if ($this->id)
                        <button wire:click.prevent="update()" wire:target="add,update,store,photo"
                            wire:loading.attr="disabled" class="btn btn-sm btn-info"> <i
                                class="fas fa-paste fs-6"></i> Actualizar</button>
                    @else
                        <button class="btn btn-sm btn-dark" wire:target="add,update,store,photo"
                            wire:loading.attr="disabled" wire:click.prevent="store()"> <i
                                class="fas fa-save fs-6"></i> Guardar</button>
                    @endif
                </div>
            </div>
        </form>

    </x-card-body>

</div>
