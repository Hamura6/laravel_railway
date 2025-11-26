<div>
    <x-card-header title="Especialidades" name="Especialidades" />
    <x-card-body>
        <x-slot name="header">
            <div class="col-sm-12 col-md-6 order-2 order-md-1">
                <x-search />
            </div>
            @can('specialties.create')
                <div class="col-md-6 order-1 order-md-2 col-ms-12">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" class="btn btn-sm  btn-success  mb-0 me-2" data-bs-toggle="modal"
                            data-bs-target="#myModal">
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
                <th>Acciones</th>
            </x-slot>
            <tbody wire:target="search" wire:loading.remove>
                @forelse ($specialties as $specialty)
                    <tr class="align-middle">
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $specialty->name }}
                        </td>
                        <td class="text-center">
                            @can('specialties.edit')
                            <x-btn-edit id="{{ $specialty->id }}" />
                            @endcan
                            @can('specialties.delete')
                            <x-btn-delete id="{{ $specialty->id }}" />
                            @endcan
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
            </tbody>
        </x-table-registers>
        <div class="border-top py-3 px-3 d-flex align-items-center">
            {{ $specialties->links() }}
        </div>
    </x-card-body>
    @include('livewire.specialties.form')
</div>
