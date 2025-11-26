<div class="col-12">
    <x-card-header title="{{ $this->id <= 0 ? 'Crear' : 'Actualizar' }} | Convenio" name="Convenio" />
    <x-card-body>
        <x-slot name='header'>
            <h4 class="py-0">Datos de convenio</h4>
        </x-slot>
        <form role="form text-left" wire:ignore.self>
            <div class="row g-1">
                <div class="col-md-4">
                    <div class="row g-1">
                        <div class="col-md-12">
                            <div class="card align-center shadow-none justify-content-center h-100" align="center">
                                <div class="container">
                                    <div
                                        class="card-header p-0 mx-3 mt-3 position-relative z-index-1 d-flex justify-content-center align-items-center flex-column">
                                        @if ($photo)
                                            <img class="border-radius-lg rounded-circle" width="200" height="200"
                                                src="{{ $photo->temporaryUrl() }}" alt="Image placeholder"
                                                wire:loading.remove wire:target="photo">
                                        @else
                                            <img class="border-radius-lg rounded-circle" width="200" height="200"
                                                src="{{ $this->image ? $this->image : 'https://i.pinimg.com/originals/bd/2e/0d/bd2e0d56cc9b061d694979158bda4d0b.jpg' }}"
                                                alt="Image placeholder" wire:loading.remove wire:target="photo">
                                        @endif

                                        <span class="spinner-grow text-dark" style="width: 3rem; height: 3rem;"
                                            wire:loading wire:target="photo" role="status">
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
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text"
                                    class="form-control @error('name')
                                    is-invalid @enderror"
                                    wire:model="name" id="floatingInput" placeholder="Titulo">
                                <label for="floatingInput">Institucion</label>
                            </div>
                            @error('name')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-8" x-data="{ social: @entangle('social') }">
                    <!-- Botón Agregar -->
                    <div class="d-flex justify-content-end mb-2">
                        <button type="button" @click="social.push({ type: '', url: '' })"
                            class="btn btn-sm btn-success d-flex align-items-center gap-1">
                            <i class="fas fa-plus-circle fs-6"></i> Agregar
                        </button>
                    </div>

                    <!-- Lista de sociales -->
                    <template x-for="(item, index) in social" :key="index">
                        <div class="row g-1 mb-2">
                            <div class="col-md-5">
                                <div class="form-floating mb-2">
                                    <select x-model="item.type" class="form-select">
                                        <option value="" disabled>Seleccione</option>
                                        <option value="facebook">Facebook</option>
                                        <option value="twitter">Twitter</option>
                                        <option value="instagram">Instagram</option>
                                        <option value="linkedin">LinkedIn</option>
                                        <option value="web">Sitio Web</option>
                                        <option value="whatsapp">WhatsApp</option>
                                    </select>
                                    <label>Plataforma digital</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" x-model="item.url" class="form-control" placeholder="URL">
                                    <label>URL o usuario</label>
                                </div>
                            </div>
                            <div class="col-md-1 d-flex align-items-center">
                                <button type="button" @click="social.splice(index, 1)"
                                    class="btn btn-sm btn-danger rounded-circle p-2 m-0">
                                    <i class="fas fa-trash-alt fs-6"></i>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>

                <div class="d-grid gap-1 d-md-flex justify-content-md-end">
                    <a href="{{ route('agreements') }}" wire:target="add,update,store"
                        wire:loading.class="disabled pointer-events-none opacity-50" class="btn btn-sm btn-danger m-0">
                        <i class="fas fa-ban fs-6"></i> Cancel</a>
                    @if ($this->id)
                        @can('articles.edit')
                            <button wire:click.prevent="update()" wire:target="add,update,store,photo"
                                wire:loading.attr="disabled" class="btn btn-sm btn-info m-0"> <i
                                    class="fas fa-paste fs-6"></i>
                                Actualizar</button>
                        @endcan
                    @else
                        @can('articles.create')
                            <button class="btn btn-sm btn-dark m-0" wire:target="add,update,store,photo"
                                wire:loading.attr="disabled" wire:click.prevent="store()"> <i class="fas fa-save fs-6"></i>
                                Guardar</button>
                        @endcan
                    @endif
                </div>
        </form>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </x-card-body>

</div>
