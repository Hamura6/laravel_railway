<div>
    <x-card-header title="Asignar | Permisos " name="Permisos" />
    <x-card-body>
        <x-slot name="header">
            <div class="col-md-6 col-ms-12">
                <div class="input-group">
                    <label class="input-group-text" for="inputGroupSelect01">Seleccionar</label>
                    <select class="form-select" id="inputGroupSelect01" wire:model.live="role">
                        <option value="0">Seleccionar</option>
                        @foreach ($roles as $rol)
                            <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="col-md-6">
                <div class="d-grid gap-2 d-md-flex d-md-block justify-content-md-end">
                    <button class="btn btn-outline-success w-100 " type="button" wire:loading.attr="disabled"
                        wire:target="syncAll" wire:click="syncAll()">
                        <span class="spinner-grow spinner-grow-sm" wire:loading wire:target="syncAll"
                            aria-hidden="true"></span>
                        <i class="fas fa-sync fs-6" wire:target="syncAll" wire:loading.remove></i>
                        Asignar todo</button>
                    <button class="btn btn-outline-danger w-100 " type="button" wire:loading.attr="disabled"
                        wire:click="revokeAll()">
                        <span class="spinner-grow spinner-grow-sm" wire:loading wire:target="revokeAll"
                            aria-hidden="true"></span>
                        <i class="fas fa-eraser fs-6" wire:loading.remove wire:target="revokeAll"></i>
                        Revocar todo
                    </button>
                </div>
            </div>

            <div class="col-sm-12 col-md-6">
                <x-search />
            </div>

        </x-slot>
        <div class="row g-2">
            @forelse ($permissions as $permission)
                <div class="col-md-3">
                    <div class="card border-secondary border h-100">
                        <div class="card-body">
                            <div class="d-grid gap-2 d-md-flex  justify-content-md-between justify-content-sm-end">

                                <button
                                    class="btn p-0 m-0 border-0 rounded-circle 
              d-flex align-items-center justify-content-center
              {{ $permission->checked ? 'bg-success text-white' : 'bg-light text-muted' }}"
                                    style="width: 20px; height: 20px; font-size: 0.7rem;"
                                    wire:click="syncPermission({{ $permission->checked ? 'false' : 'true' }}, '{{ $permission->name }}')"
                                    wire:loading.attr="disabled" data-toggle="tooltip" data-placement="top"
                                    title="{{ $permission->checked ? 'Revocar permiso' : 'Asignar permiso' }}">
                                    <i class="fas {{ $permission->checked ? 'fa-check' : 'fa-circle' }}"></i>
                                </button>


                                @if ($permission->checked == 0)
                                    <span class="badge badge-danger">Asignar</span>
                                @else
                                    <span class="badge badge-info">Asignado</span>
                                @endif
                            </div>
                            <h5 class="card-title">{{ $permission->name }} </h5>
                            <p class="card-text">{{ $permission->description }} </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12" align="center" wire:target="search" wire:loading.remove>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="far fa-sad-tear"></i> No se encontraron
                                registros... </h5>
                        </div>
                    </div>
                </div>
            @endforelse
            <div class="text-center py-4 color-dark" wire:loading wire:target="search">
                <div class="spinner-border " style="width: 4rem; height: 4rem;" role="status">
                    <span class="visually-hidden ">Loading...</span>
                </div>
            </div>

        </div>
        {{ $permissions->links() }}

    </x-card-body>
</div>
