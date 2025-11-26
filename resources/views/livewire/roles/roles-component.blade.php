<div>
    <x-card-header title="Gestión de roles" />

    <x-card-body title="Control de roles">
        <x-slot name="header">
            <div class="col-sm-12 col-md-6 order-2 order-md-1">
                <x-search />
            </div>
            <div class="col-md-6 order-1 order-md-2 col-ms-12">
                @can('roles.create')
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" wire:target="search" wire:loading.attr="disabled" class="btn btn-sm btn-success"
                            data-bs-toggle="modal" data-bs-target="#myModal">
                            <i class="far fa-file-alt fs-6"></i> Nuevo
                        </button>
                    </div>
                @endcan
            </div>
        </x-slot>
        <x-table-registers>
            <x-slot name="header">
                <th>#</th>
                <th>Nombres</th>
                <th>Opciones</th>
            </x-slot>
            @forelse ($roles as $rol)
                <tr>
                    <td>
                        <span class="text-sm font-weight-normal">{{ $loop->iteration }}</span>
                    </td>
                    <td class="align-middle">

                        <span class="text-sm font-weight-normal">{{ $rol->name }}</span>
                    </td>
                    <td class="text-center" align="center">
                        @if ($rol->id != 1 && $rol->id != 2)
                            @can('roles.edit')
                                <x-btn-edit id="{{ $rol->id }}" />
                            @endcan
                            @can('roles.delete')
                                <x-btn-delete id="{{ $rol->id }}" />
                            @endcan
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" align="center">
                        <h5>
                            <i class="far fa-sad-tear"></i>

                            No se encontraron registros...
                        </h5>
                    </td>
                </tr>
            @endforelse
        </x-table-registers>

        <div class="border-top py-3 px-3 d-flex align-items-center">
            {{ $roles->links() }}
        </div>

    </x-card-body>
    @include('livewire.roles.form')

</div>
