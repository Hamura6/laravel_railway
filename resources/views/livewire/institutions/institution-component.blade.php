<div>
    <x-card-header title="Gestión de Pagos" name="Saldos" />
    <div class="card border m-0  border-dark h-100">
        <div class="card-header p-2 border-bottom">
            <div class="row g-1 ustify-content-between">
                <h4>Configuracion</h4>
                <div class="d-flex justify-content-start">
                    <a href="{{ route('institution.requirement') }}" class="btn btn-sm btn-success"> <i class="fas fa-clipboard-list"></i> Requisitos</a>
                </div>
            </div>
        </div>
        <div class="card-body p-2">
            <fieldset>
                <div class="row  g-2">
                    <div class="col-md-12">
                        <div
                            class="p-0 mx-3 mt-3 position-relative z-index-1 d-flex justify-content-center align-items-center flex-column">
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
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text"
                                class="form-control @error('institution.initials') is-invalid @enderror"
                                wire:model="institution.initials" id="floatingInput" placeholder="Fecha">
                            <label for="floatingInput">Nombre abreviado de la institucion </label>
                            @error('institution.initials')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('institution.name') is-invalid @enderror"
                                wire:model="institution.name" id="floatingInput" placeholder="Fecha">
                            <label for="floatingInput">Licencia hasta </label>
                            @error('institution.name')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <textarea style="height: 150px" class="form-control @error('institution.mission') is-invalid @enderror"
                                wire:model="institution.mission" id="floatingInput" placeholder="Descripcion" cols="30" rows="20"></textarea>
                            <label for="floatingInput">Mision</label>
                            @error('institution.mission')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <textarea style="height: 150px" class="form-control @error('institution.vision') is-invalid @enderror"
                                wire:model="institution.vision" id="floatingInput" placeholder="Descripcion" cols="30" rows="20"></textarea>
                            <label for="floatingInput">Vision</label>
                            @error('institution.vision')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-floating">
                            <input type="email" class="form-control @error('institution.email') is-invalid @enderror"
                                wire:model="institution.email" id="floatingInput" placeholder="Fecha">
                            <label for="floatingInput">Correo electronico </label>
                            @error('institution.email')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="number" class="form-control @error('institution.phone') is-invalid @enderror"
                                wire:model="institution.phone" id="floatingInput" placeholder="Fecha">
                            <label for="floatingInput">Numero de telefono </label>
                            @error('institution.phone')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-floating">
                            <input type="text"
                                class="form-control @error('institution.address') is-invalid @enderror"
                                wire:model="institution.address" id="floatingInput" placeholder="Fecha">
                            <label for="floatingInput">Direccion</label>
                            @error('institution.address')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-floating">
                            <select class="form-select @error('institution.city') is-invalid @enderror "
                                wire:model="institution.city" id="floatingSelect"
                                aria-label="Floating label select example">
                                <option value="Elegir" disabled>Seleccion</option>
                                <option value="LP">La Paz</option>
                                <option value="PT">Potosi</option>
                                <option value="OR">Oruro</option>
                                <option value="CB">Cochabamba</option>
                                <option value="SC">Santa Cruz</option>
                                <option value="TJ">Tarija</option>
                                <option value="CH">Chuquisaca</option>
                                <option value="BN">Beni</option>
                                <option value="PD">Pando</option>
                            </select>
                            <label for="floatingSelect">Seleccione una ciudad</label>
                        </div>
                        @error('institution.city')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button class="btn btn-sm  btn-info" wire:click="update()"
                wire:loading.class="disabled pointer-events-none opacity-50"><i class="fas fa-edit"></i> Actualizar
                Informacion</button>
        </div>
    </div>
</div>
