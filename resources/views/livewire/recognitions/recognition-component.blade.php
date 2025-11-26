<div>
    <x-card-header title="Reconocimientos Oficiales" name="Reconocimientos" />
    <x-card-body>
        <x-slot name="header">
            <div class="col-sm-12 col-md-6 order-2 order-md-1">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" placeholder="Escriba un año" wire:model="search">
                    <button wire:click="UpdatedSearch()" class="btn btn-outline-secondary" type="button"
                        id="button-addon2">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                </div>


            </div>
            @can('recognitions.create')
                <div class="col-md-6 order-1 order-md-2 col-ms-12">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" wire:target="search" wire:loading.attr="disabled"
                            class="btn btn-sm btn-success " data-bs-toggle="modal" data-bs-target="#myModal">
                            <i class="far fa-file-alt fs-6"></i> Nuevo
                        </button>
                    </div>
                </div>
            @endcan
        </x-slot>
        <div class="row g-1">


            @forelse ($recognitions as $recognition)
                <div class="col-md-3">
                    <div class="card border  mb-0 h-100 d-flex flex-column">
                        <div class="card-header py-1 d-flex justify-content-center >
                            <h6 class="text-center
                            p-0 m-0 ">
                                <i class="{{ $recognition->icon }}"></i>
                                {{ __($recognition->type) }}
                            </h6>
                        </div>
                        <div class="card-body px-0 ">
                            <ul class="list-group list-group-flush ">
                                <li class="list-group-item py-0 pb-1 border-0"> <i class="fas fa-flag"></i> Nombre:
                                    </strong>{{ $recognition->name }} </li>
                                <li class="list-group-item py-0 pb-1 border-0"> <strong><i class="far fa-calendar-alt"></i>
                                        Fecha:
                                    </strong> {{ $recognition->date }} </li>
                                
                                <li class="list-group-item py-0 pb-1 border-0"><strong><i class="fas fa-user-edit"></i>
                                        Participantes:
                                    </strong>{{ $recognition->cant }}
                                </li>
                               {{--  <li class="list-group-item py-0 pb-1 border-0"><strong><i class="fas fa-comments-dollar"></i>
                                        Cant. de Aportes:
                                    </strong>{{ $recognition->quantity }}
                                </li> --}}
                                <li class="list-group-item py-0 pb-1 border-0 text-center {{ $recognition->is_date ? 'text-success' : 'text-danger' }}"> <strong><i class="fas fa-clock"></i> {{ $recognition->remaining_days }}
                                    </strong> </li>
                            </ul>
                        </div>
                        <div class="card-footer py-1 d-flex gap-1 justify-content-center">
                            @can('recognitions.edit')
    <button type="button" wire:target="changeStatus, delete, edit" wire:loading.attr="disabled"
                                        wire:click="edit({{ $recognition->id }})"
                                        class="btn-uc-circle" data-bs-toggle="tooltip"
                                        data-bs-title="Editar" wire:loading.attr="disabled">
                                        <i class="fas fa-edit fs-6"></i>
                                    </button>
@endcan
                            @can('recognitions.delete')
    <button type="button" wire:target="changeStatus, delete, edit" wire:loading.attr="disabled"
                                    onclick="Confirm({{ $recognition->id }})"
                                    class="btn-dc-circle outlined " data-bs-toggle="tooltip"
                                    data-bs-title="Eliminar" wire:loading.attr="disabled">
                                    <i class="fas fa-trash fs-6"></i>
                                    </button>
@endcan
                            @can('recognitions.view')
    <a type="button" wire:target="changeStatus, delete, edit" wire:loading.attr="disabled"
                                    href="{{ route('recognitions.details', $recognition->id) }}" wire:navigate
                                    class="btn-purple-circle"
                                    data-bs-toggle="tooltip" data-bs-title="Detalle" wire:loading.attr="disabled">
                                    <i class="fas fa-eye fs-6"></i>
                                    </a>
@endcan
                        </div>
                    </div>
                </div>
@empty
                <div class="col-12">
                    <div class="alert alert-info text-center rounded-3 py-3 shadow-sm">
                        <i class="far fa-sad-tear"></i> No se encontraron registros.
                    </div>
                </div>
 @endforelse
                        </div>
    </x-card-body>
    @include('livewire.recognitions.form')
</div>
