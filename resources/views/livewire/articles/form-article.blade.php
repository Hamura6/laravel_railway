<div class="col-12">
    <x-card-header title="{{ $this->id <= 0 ? 'Crear' : 'Actualizar' }} | Artículo" name="articulo" />
    <x-card-body>
        <x-slot name='header'>
            <h4 class="my-0">Datos del artículo</h4>
        </x-slot>
        <form role="form text-left" wire:ignore.self>
            <div class="row g-1">
                <div class="col-md-6">
                    <div class="row g-1">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text"
                                    class="form-control @error('title')
            is-invalid @enderror"
                                    wire:model="title" id="floatingInput" placeholder="Titulo">
                                <label for="floatingInput">Titulo</label>
                            </div>
                            @error('title')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea type="date" class="form-control @error('description')
            is-invalid @enderror"
                                    wire:model="description" id="floatingInput" placeholder="Description" style="height: 150px" cols="30"
                                    rows="20"></textarea>
                                <label for="floatingInput">Descripcion</label>
                            </div>
                            @error('description')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="formFileSm" class="form-label">Subir archivo</label>
                                <input
                                    class="form-control form-control-sm @error('file')
                                    is-invalid @enderror"
                                    id="formFileSm" type="file" wire:model="file" accept=".pdf,.doc,.docx">
                                @error('file')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card align-center shadow-none justify-content-center h-100" align="center">
                        <div class="container">
                            <div
                                class="card-header p-0 mx-3 mt-3 position-relative z-index-1 d-flex justify-content-center align-items-center flex-column">
                                @if ($photo)
                                    <img class="border-radius-lg rounded-circle" width="200" height="200"
                                        src="{{ $photo->temporaryUrl() }}" alt="Image placeholder" wire:loading.remove
                                        wire:target="photo">
                                @else
                                    <img class="border-radius-lg rounded-circle" width="200" height="200"
                                        src="{{ $this->image ? $this->image : 'https://i.pinimg.com/originals/bd/2e/0d/bd2e0d56cc9b061d694979158bda4d0b.jpg' }}"
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
                <div class="d-grid gap-1 d-md-flex justify-content-md-end">
                    <a href="{{ route('articles') }}" wire:target="add,update,store"
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
            </div>
        </form>
    </x-card-body>

</div>
