<div>
    <x-card-header title="Gestión de Fallecidos" name="Fallecidos" />
    <x-card-body>
        <x-slot name="header">
            <div class="col-sm-12 col-md-6 order-2 order-md-1">
                <x-search />
            </div>
            <div class="col-md-6 order-1 order-md-2 col-ms-12">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('deceased.affiliate-excel') }}" class="btn btn-sm btn-outline-success"><i
                        class="far fa-file-excel fs-6"></i> Exporta a Excel </a>
                        @can('deceaseds.create')
                        <button type="button" wire:target="search" wire:loading.attr="disabled"
                            class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#myModal">
                            <i class="far fa-file-alt fs-6"></i> Nuevo
                        </button>
                        @endcan
                    </div>
                </div>
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
                <th class=" py-1 font-weight-semibold">Matrícula</th>
                <th class=" py-1 font-weight-semibold">Nombre Completo</th>
                <th class=" py-1 font-weight-semibold">Fecha de <br>Registro</th>
                <th class=" py-1 font-weight-semibold">C.I</th>
                <th class=" py-1 font-weight-semibold text-center">Fecha de <br> Fallecimiento</th>
                <th class=" py-1 font-weight-semibold">Descripción</th>
                <th class=" py-1 font-weight-semibold">En el Mausoleo</th>
                <th class="text-center  py-1 font-weight-semibold">Opciones</th>
            </x-slot>
            <tbody wire:target="search" wire:loading.remove>
                @forelse ($deceaseds as $deceased)
                    <tr class="align-middle">
                        <td>
                            {{ $deceased->affiliate->id }}
                        </td>
                        <td>
                            {{ $deceased->affiliate->user->full_name }}
                        </td>
                        <td align="center">
                            {{ $deceased->affiliate->created_at }}
                        </td>
                        <td align="center">
                            {{ $deceased->affiliate->user->ci }}
                        </td>
                        <td align="center">
                            {{ $deceased->date }}
                        </td>
                        <td>
                            {{ $deceased->description }}
                        </td>
                        <td align="center">
                            {{ $deceased->mausoleum }}
                        </td>
                        <td class="text-center">
                            @can('deceaseds.delete')
                                <x-btn-delete id="{{ $deceased->id }}" />
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
        <div class="border-top py-3 px-3 d-flex align-items-center">
            {{ $deceaseds->links() }}
        </div>
    </x-card-body>
    @include('livewire.deceaseds.form')
</div>
