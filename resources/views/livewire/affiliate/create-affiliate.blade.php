<div class="row g-1">
    <x-card-header title="{{ $this->form->id > 0 ? 'Actualizar' : 'Registrar' }} | Afiliado"
        name=" {{ $this->form->id > 0 ? 'Actualizar' : 'Registrar' }}" />
    <div class="col-md-12">
        <x-card-body>
            <x-slot name="header">
                <div class="d-flex justify-content-start">
                    <h4 class="px-2 my-auto py-0">1. Datos personales</h4>
                </div>
            </x-slot>
            <div class="row my-1 mx-1 g-1">
                <div class="col-md-6 p-1">
                    <div class="align-center justify-content-center" align="center">
                        <div class="container">
                            <div
                                class=" p-0 mx-3 mt-3 position-relative z-index-1 d-flex justify-content-center align-items-center flex-column">
                                <img class="border-radius-lg rounded-circle" width="110" height="115" wire:loading.remove
                                        wire:target="photo"
                                    src="{{ $photo ? $photo->temporaryUrl() : ($this->image ?: asset('image/user.png')) }}">
                                <span class="spinner-grow text-dark" style="width: 3rem; height: 3rem;" wire:loading
                                    wire:target="photo" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="basic-url">Elija imagen</label>
                        <div class="input-group">
                            <input type="file" wire:model.lazy="photo"
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
                <div class="col-md-6">
                    <div class="row g-1">
                        <div class="col-md-6">
                            <x-input-label title='Nombres' name='userForm.name' />
                        </div>

                        <div class="col-md-6">
                            <x-input-label title='Apellidos' name="userForm.last_name" />
                        </div>
                        <div class="col-md-6">
                            <x-input-label title="C.I" type='text' name='userForm.ci' />
                        </div>
                        <div class="col-md-6">
                            <x-input-label title="Fecha de Nacimiento" type='date' name='userForm.birthdate' />
                        </div>
                        <div class="col-md-6">
                            <x-select name='form.status' title='Seleccione el estado'>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                                <option value="Exento">Exento</option>
                                <option value="Retirada">Retirada</option>
                                <option value="Licencia">Licencia</option>
                            </x-select>
                        </div>
                        <div class="col-md-6">
                            <x-input-label title="Lugar" name='form.place' />
                        </div>


                    </div>

                </div>
                <div class="col-md-4">
                    <x-select name='userForm.gender' title='Seleccione un genero'>
                        <option value="Femenino">Femenino</option>
                        <option value="Masculino">Masculino</option>
                    </x-select>

                </div>
                <div class="col-md-4">
                    <x-select title="Seleccione el estado civil" name="userForm.martial_status">
                        <option value="Casado">Casado</option>
                        <option value="Soltero">Soltero</option>
                        <option value="Divorciado">Divorciado</option>
                        <option value="Viudo">Viudo</option>
                        <option value="Comprometido">Comprometido</option>
                    </x-select>
                </div>
                <div class="col-md-4">
                    <x-input-label title="Deporte que practica" name='form.sport' />
                </div>



                <div class="col-md-5">
                    <x-input-label title="Domicilio" name='form.address_home' />
                </div>
                <div class="col-md-2">
                    <x-input-label title="No." type='number' name='form.address_number_home' />
                </div>
                <div class="col-md-5">
                    <x-input-label title="Zona" name='form.zone_home' />
                </div>




                <div class="col-md-3">
                    <x-input-label title="Celular" type='number' name='phones.0' />
                </div>
                <div class="col-md-3">
                    <x-input-label title="Teléfono" type='number' name='phones.1' />
                </div>
                <div class="col-md-6">
                    <x-input-label title="Correo electrónico" type="email" name='userForm.email' />
                </div>
            </div>
        </x-card-body>
    </div>
    <div class="col-md-8">
        <x-card-body>
            <x-slot name="header">
                <div class="d-flex justify content-start">

                    <h4 class="px-2 my-auto py-0">2. Datos de Afiliado</h4>
                </div>
            </x-slot>
            <div class="row g-1">

                <div class="col-md-6">
                    <x-input-label title="Matrícula CONALAB" type='number' name='form.enrollment_conalab' />
                </div>
                <div class="col-md-6">
                    <x-select title="Sede" name='form.sede'>
                        <option value="La paz">La paz</option>
                        <option value="Cochabamba">Cochabamba</option>
                        <option value="Santa Cruz">Santa Cruz</option>
                        <option value="Oruro">Oruro</option>
                        <option value="Potosí">Potosí</option>
                        <option value="Chuquisaca">Chuquisaca</option>
                        <option value="Tarija">Tarija</option>
                        <option value="Beni">Beni</option>
                        <option value="Pando">Pando</option>
                    </x-select>
                </div>
                <div class="col-md-4">
                    <x-input-label title="Ejercicio Profesional" name='form.profession' />
                </div>
                <div class="col-md-4">
                    <x-select name='form.profession_status' title=''>
                        <option value="Libre">Libre</option>
                        <option value="Funcion publica">Funcion publica</option>
                        <option value="privada">privada</option>
                    </x-select>
                </div>
                <div class="col-md-4">
                    <x-input-label title="Institución" name='form.institution' />
                </div>

                <div class="col-md-5">
                    <x-input-label title="Domicilio Procesal" name='form.address_office' />
                </div>
                <div class="col-md-2">
                    <x-input-label title="No." type='number' name='form.address_number' />
                </div>
                <div class="col-md-5">
                    <x-input-label title="Zona" name='form.zone' />
                </div>
            </div>
        </x-card-body>
    </div>
    <div class="col-md-4">
        <x-card-body>
            <x-slot name="header">
                <h4 class="px-2 my-auto py-0">3. Datos Profesionales</h4>
            </x-slot>

            <!-- Universidad -->
            <div class="mb-3" x-data="universityData()">
                <label for="university" class="form-label">Universidad</label>
                <input type="text" id="university" class="form-control" x-model="universityText"
                    list="university-list" placeholder="Seleccionar o escribir universidad"
                    @change="handleUniversityChange()">

                <datalist id="university-list">
                    @foreach ($universities as $university)
                        <option value="{{ $university['text'] }}">{{ $university['text'] }}</option>
                    @endforeach
                </datalist>

                @error('form.university_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-12">
                <x-input-label title="Fecha de extensión del Título en Provisión Nacional" type="date"
                    name='form.date' />
            </div>

            <div class="col-md-12 ">
                <x-input-label title="Número de Título" type="number" name='form.number' />
            </div>
        </x-card-body>
    </div>
    <script>
        function universityData() {
            return {
                universityText: '',
                universities: @json($universities),
                init() {
                    // Si ya hay una universidad seleccionada, establecer el texto
                    const currentUniversityId = @this.get('form.university_id');
                    if (currentUniversityId && currentUniversityId !== 'Elegir') {
                        const university = this.universities.find(u => u.value == currentUniversityId);
                        if (university) {
                            this.universityText = university.text;
                        }
                    }
                },
                handleUniversityChange() {
                    const selectedUniversity = this.universities.find(u => u.text === this.universityText);

                    if (selectedUniversity) {
                        @this.set('form.university_id', selectedUniversity.value);
                    } else {
                        @this.set('form.university_id', 'Elegir');
                    }
                }
            }
        }
    </script>
    <div class="col-md-12" x-data="{
        specialtiesArray: @entangle('specialtiesArray'),
        ...specialtiesComponent()
    }">
        <x-card-body>
            <x-slot name="header">
                <h4 class="px-2 my-auto py-0">4. Especialidades</h4>
                <div class="d-grid gap-1 d-md-flex justify-content-md-end">
                    <template x-if="specialtiesArray.length > 0">
                        <button @click="deleteSpeciality()" class="btn btn-danger m-0 btn-sm" type="button"
                            :disabled="loading">
                            <i class="fas fa-minus-circle fs-6"></i> Quitar
                        </button>
                    </template>
                    <button class="btn btn-sm btn-success m-0" :disabled="loading"
                        @click.prevent="addSpeciality()">
                        <i class="fas fa-plus-circle fs-6"></i>
                        Agregar
                    </button>
                </div>
            </x-slot>

            <div class="row g-1">
                <template x-for="(specialty, index) in specialtiesArray" :key="index">
                    <div class="col-md-12">
                        <div class="row">
                            <!-- Universidad -->
                            <div class="col-md-12 mb-2">
                                <label class="form-label">Universidad</label>
                                <input type="text" class="form-control" x-model="specialty.university_text"
                                    :list="`universities-list-${index}`"
                                    placeholder="Seleccionar o escribir universidad"
                                    @change="handleUniversityChange(index)">

                                <datalist :id="`universities-list-${index}`">
                                    <template x-for="university in universities" :key="university.value">
                                        <!-- Mostrar el texto pero el value contiene ambos datos -->
                                        <option :value="university.text" :data-id="university.value"></option>
                                    </template>
                                </datalist>

                                <!-- Campo oculto para el ID real -->
                                <input type="hidden" x-model="specialty.university_id">

                                <span x-show="hasError(`specialtiesArray.${index}.university_id`)" class="text-danger"
                                    x-text="getError(`specialtiesArray.${index}.university_id`)">
                                </span>
                            </div>

                            {{-- <div class="col-md-6 mb-2">
                                <label class="form-label">Especialidad</label>
                                <select class="form-select search-select" x-model="specialty.specialty_id"
                                    :id="`specialty-${index}`" :data-index="index" data-type="specialty">
                                    <option value="">Seleccionar especialidad</option>
                                    <template x-for="speciality in specialties" :key="speciality.value">
                                        <option :value="speciality.value" x-text="speciality.text"></option>
                                    </template>
                                </select>
                                <div x-show="specialty.custom_specialty && !specialty.specialty_id" class="mt-1">
                                    <small class="text-muted">Especialidad personalizada:
                                        <span x-text="specialty.custom_specialty"></span>
                                    </small>
                                </div>
                                <span x-show="hasError(`specialtiesArray.${index}.specialty_id`)" class="text-danger"
                                    x-text="getError(`specialtiesArray.${index}.specialty_id`)">
                                </span>
                            </div> --}}
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Especialidad</label>
                                <input type="text" class="form-control" x-model="specialty.specialty_id"
                                    :list="`specialties-list-${index}`"
                                    placeholder="Seleccionar o escribir especialidad">

                                <datalist :id="`specialties-list-${index}`">
                                    <template x-for="speciality in specialties" :key="speciality.value">
                                        <option :value="speciality.text"></option>
                                    </template>
                                </datalist>

                                <span x-show="hasError(`specialtiesArray.${index}.specialty_id`)" class="text-danger"
                                    x-text="getError(`specialtiesArray.${index}.specialty_id`)">
                                </span>
                            </div>
                            <!-- Área -->
                            <div class="col-md-3 mb-2">
                                <label class="form-label">Área</label>
                                <input type="text" class="form-control" x-model="specialty.area"
                                    placeholder="Área">
                            </div>

                            <!-- Fecha -->
                            <div class="col-md-3 mb-2">
                                <label class="form-label">Fecha</label>
                                <input type="date" class="form-control" x-model="specialty.date">
                            </div>

                            <!-- Botón para eliminar esta especialidad específica -->
                            <div class="col-md-12 text-end mb-3">
                                <button @click="deleteSpecificSpeciality(index)" class="btn btn-outline-danger btn-sm"
                                    type="button" x-show="specialtiesArray.length > 1">
                                    <i class="fas fa-trash"></i> Eliminar esta especialidad
                                </button>
                            </div>
                        </div>
                        <hr class="border border-dark border-3 opacity-75">
                    </div>
                </template>
            </div>
        </x-card-body>
    </div>



    <!-- Incluir Choices.js desde CDN más reciente -->
    <script>
        function specialtiesComponent() {
            return {
                loading: false,
                universities: @json($universities),
                specialties: @json($specialties),
                errors: {},

                init() {
                    if (this.specialtiesArray.length === 0) {
                        this.addSpeciality();
                    }
                },

                addSpeciality() {
                    this.specialtiesArray.push({
                        university_id: '', // Aquí irá el VALUE (ID numérico)
                        university_text: '', // Aquí irá el TEXT (nombre visible)
                        specialty_id: '',
                        area: '',
                        date: ''
                    });
                },

                handleUniversityChange(index) {
                    if (this.specialtiesArray[index]) {
                        const displayText = this.specialtiesArray[index].university_text;

                        // Buscar la universidad que coincida con el texto mostrado
                        const university = this.universities.find(u => u.text === displayText);

                        if (university) {
                            // Si encontró coincidencia, guardar el VALUE (ID)
                            this.specialtiesArray[index].university_id = university.value;
                        } else {
                            // Si no encontró, es texto personalizado (limpiar el ID)
                            this.specialtiesArray[index].university_id = '';
                        }
                    }
                },

                deleteSpeciality() {
                    if (this.specialtiesArray.length > 0) {
                        this.specialtiesArray.pop();
                    }
                },

                deleteSpecificSpeciality(index) {
                    if (this.specialtiesArray.length > 1) {
                        this.specialtiesArray.splice(index, 1);
                    }
                },

                hasError(field) {
                    return this.errors && this.errors[field];
                },

                getError(field) {
                    return this.errors && this.errors[field] ? this.errors[field][0] : '';
                }
            }
        }
    </script>
    <div class="d-grid gap-1 d-md-flex justify-content-md-end mt-3">
        <a href="{{ route('report.affiliate') }}" wire:navigate class="btn btn-sm btn-secondary"> <i
                class="fas fa-ban fs-6"></i> Cancel</a>
        @if ($this->id)
            <button class="btn btn-sm btn-dark" wire:click.prevent="update()" wire:loading.attr="disabled"> <i
                    class="fas fa-paste fs-6" wire:loading.attr="disabled"></i>
                Actualizar</button>
        @else
            <button class="btn btn-sm btn-dark" wire:click.prevent="store()" wire:loading.attr="disabled"> <i
                    class="fas fa-save fs-6" wire:loading.attr="disabled"></i> Guardar</button>
        @endif
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</div>
