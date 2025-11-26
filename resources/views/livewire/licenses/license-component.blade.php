<div>
    <x-card-header title="Control de Licencias" name="Licencia" />
    <x-card-body>
        <x-slot name="header">
            <div class="col-sm-12 col-md-6 order-2 order-md-1">
                <x-search />
            </div>
            @can('licenses.create')
                <div class="col-md-6 order-1 order-md-2 col-ms-12">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" wire:target="search" wire:loading.attr="disabled"
                            class="btn btn-sm btn-success  mb-0 me-2" data-bs-toggle="modal" data-bs-target="#myModal">
                            <i class="far fa-file-alt fs-6"></i> Agregar
                        </button>
                    </div>
                </div>
            @endcan
            {{--                 <div class="col-md-6 order-1 order-md-2 col-ms-12">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button onclick="hola()" type="button" class="btn btn-sm  btn-success  mb-0">
                            <i class="fa-solid fa-circle-plus fs-6"></i> Nueasdfasdvo
                        </button>

                    </div>
                </div> --}}

        </x-slot>
        <x-table-registers>
            <x-slot name="header">
                <th>Matrícula</th>
                <th>Nombre Completo</th>
                <th>C.I.</th>
                <th>Fecha de registro</th>
                <th>Descripción</th>
                <th>Fecha de licencia</th>
                <th>Opciones</th>
            </x-slot>
            <tbody wire:target="search" wire:loading.remove>
                @forelse ($licenses as $license)
                    <tr class="align-middle">
                        <td>
                            {{ $license->affiliate->id }}
                        </td>
                        <td>
                            {{ $license->affiliate->user->full_name }}
                        </td>
                        <td>
                            {{ $license->affiliate->user->ci }}
                        </td>

                        <td class="text-secondary">
                            {{ $license->affiliate->created_at }}

                        </td>

                        <td class="text-secondary">
                            {{ $license->description }}
                        </td>
                        <td class="text-secondary">
                            {{ $license->date }}
                        </td>
                        <td class="text-center">
                            @can('licenses.delete')
                                
                            <x-btn-delete id="{{ $license->id }}" />
                                @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" align="center">
                            <h5>
                                <i class="far fa-sad-tear"></i>

                                No se encontraron registros...
                            </h5>
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </x-table-registers>
        <div class="border-top py-2  mt-2 px-3 d-flex align-items-center">
            {{ $licenses->links() }}
        </div>
    </x-card-body>
    @include('livewire.licenses.form')
</div>
