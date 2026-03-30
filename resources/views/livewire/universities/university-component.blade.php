<div>
    <x-card-header title="Universidades" name="Universidades" />
    <x-card-body>
        <x-slot name="header">
            <div class="col-12 col-md-6 order-1 order-md-2">
                @can('Crear universidades')
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" class="btn btn-sm  btn-success" data-bs-toggle="modal"
                            data-bs-target="#myModal">
                            <i class="far fa-file-alt fs-6"></i> Nuevo
                        </button>
                    </div>
                @endcan
            </div>
            <div class="col-12 col-md-6 order-2  order-md-1">
                <x-selected-live name='selected' title='Tipo de universidad'>
                    <option value="">Todas</option>
                    <option value="Publica">Publica</option>
                    <option value="Privada">Privada</option>
                </x-selected-live>
            </div>
            <div class="col-12 col-md-6  order-3">
                <x-search />
            </div>
        </x-slot>
        <x-table-registers>
            <x-slot name="header">

                <th>#</th>
                <th>Nombres</th>
                <th>Entidad</th>
                <th>Opciones</th>
            </x-slot>
            <tbody wire:loading.remove wire:target="search">
                @forelse ($universities as $university)
                    <tr class="align-middle">
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $university->name }}
                        </td>
                        <td>
                            {{ $university->entity }}
                        </td>
                        <td class="d-flex flex-row justify-content-center align-items-center gap-1">
                            @can('Editar universidades')
                                <x-btn-edit id="{{ $university->id }}" />
                            @endcan
                            @can('Eliminar universidades')
                                <x-btn-delete id="{{ $university->id }}" />
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" align="center">
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
            {{ $universities->links() }}
        </div>
    </x-card-body>
    @include('livewire.universities.form')

</div>
