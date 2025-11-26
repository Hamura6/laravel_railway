<div>
    <x-card-header title="Gestión de Directorio" />

    <x-card-body>
        <x-slot name="header">
            <div class="col-sm-12 col-md-6 order-2 order-md-1">
                <x-search />
            </div>
            @can('directories.create')
                <div class="col-md-6 order-1 order-md-2 col-ms-12">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" wire:target="search" wire:loading.attr="disabled"
                            class="btn btn-sm btn-success  mb-0 me-2" data-bs-toggle="modal" data-bs-target="#myModal">
                            <i class="far fa-file-alt fs-6"></i> Nuevo
                        </button>
                    </div>
                </div>
            @endcan
        </x-slot>
        <x-table-registers>
            <x-slot name="header">

                <th>#</th>
                <th>Nombres</th>
                <th>Tipo</th>
                <th>Nivel de cargo</th>
                <th>Opciones</th>
            </x-slot>
            <tbody wire:target='search' wire:loading.remove>
                @forelse ($directories as $directory)
                    <tr class="align-middle">
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $directory->name }}
                        </td>
                        <td class="text-secondary">
                            {{ $directory->label }}
                        </td>
                        <td class="text-center">
                            {{ $directory->level }}
                        </td>
                        <td align="center">
                            @can('directories.delete')
                                <x-btn-delete id="{{ $directory->id }}" />
                            @endcan
                            @can('directories.edit')
                                <x-btn-edit id="{{ $directory->id }}" />
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" align="center">
                            <h5>
                                <i class="far fa-sad-tear"></i>

                                No se encontraron registros...
                            </h5>
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </x-table-registers>
        <div class="border-top py-3 px-3 d-flex align-items-center">
            {{ $directories->links() }}
        </div>
    </x-card-body>
    @include('livewire.direcories.form_create')
</div>
