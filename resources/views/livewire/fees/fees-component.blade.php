<div>
    <x-card-header title="Costos de Trámites" name="Tarifas" />

    <x-card-body>
        <x-slot name="header">
            <div class="col-sm-12 col-md-6 order-2 order-md-1">
                <x-search />
            </div>
            @can('fees.create')
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
                <th>Monto <i class="fas fa-coins"></i></th>
                <th>Método de pago</th>
                <th>Opciones</th>
            </x-slot>
            <tbody wire:target='search' wire:loading.remove>
                @forelse ($fees as $fee)
                    <tr class="align-middle">
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $fee->name }}
                        </td>
                        <td class="text-secondary">
                            {{ $fee->amount }} Bs
                        </td>
                        <td>
                            {{ __($fee->type) }}
                        </td>
                        <td align="center">
                            @can('fees.edit')
                                <x-btn-edit id="{{ $fee->id }}" />
                            @endcan
                            @can('fees.delete')
                                <x-btn-delete id="{{ $fee->id }}" />
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
            {{ $fees->links() }}
        </div>
    </x-card-body>
    @include('livewire.fees.form')
</div>
