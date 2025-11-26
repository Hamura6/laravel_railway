<div>
    <x-card-header title="Saldos y Aportes" name="Saldos" />
    <x-card-body>
        <x-slot name="header">
            <div class="col-md-6  col-ms-12 order-md-2 order-sm-1">
                <div class="form-floating">
                    <select class="form-select" wire:model.live="selected" id="floatingSelect"
                        aria-label="Floating label select example">
                        <option value="">Todos</option>
                        <option value='ENABLED'>Activos</option>
                        <option value='DISABLED'>Inactivos</option>
                    </select>
                    <label for="floatingSelect">Seleccione el concepto</label>
                </div>
            </div>
            <div class="col-sm-12 col-md-6  order-md-1 order-sm-2">
                <x-search />
            </div>
        </x-slot>
        <x-table-registers>
            <x-slot name="header">
                <th class="py-1 font-weight-semibold">Matricula</th>
                <th class="py-1 font-weight-semibold">Afiliado</th>
                <th class="py-1 font-weight-semibold">C.I.</th>
                <th class="py-1 font-weight-semibold">Antiguedad</th>
                <th class="py-1 font-weight-semibold">Monto</th>
                <th class="py-1 font-weight-semibold">Monto pagado</th>
                <th class="py-1 font-weight-semibold">Deuda</th>
                <th class="py-1 font-weight-semibold">Estado</th>
                <th class="py-1 text-center font-weight-semibold">Acciones
                </th>
            </x-slot>
            @forelse ($affiliates as $affiliate)
                <tr>
                    <td class="align-middle">
                        <span class="text-sm font-weight-normal"> {{ $affiliate->id }}</span>
                    </td>
                    <td class="align-middle">
                        <span class="text-sm font-weight-normal">{{ $affiliate->user->full_name }} </span>
                    </td>
                    <td class="align-middle">
                        <span class="text-sm font-weight-normal">{{ $affiliate->user->ci }} </span>
                    </td>
                    <td class="align-middle">
                        <span class="text-secondary text-sm">
                            {{ $affiliate->antique }}
                        </span>
                    </td>
                    <td class="align-middle">
                        <span class="text-secondary text-sm">

                            {{ $affiliate->payments->sum('amount') }} Bs.
                            Bs.
                        </span>
                    </td>
                    <td class="align-middle">
                        <span class="text-secondary text-sm">

                            {{ $affiliate->total }}
                            Bs.
                        </span>
                    </td>
                    <td class="align-middle">
                        <span class="text-secondary text-sm">
                            {{ $affiliate->debt }} BS
                        </span>
                    </td>
                    <td class="align-middle">
                        <span
                            class="badge badge-sm border {{ $affiliate->user->status == 'ENABLED' ? 'border-success text-success bg-success' : 'border-danger text-danger bg-danger' }} ">
                            {{ $affiliate->user->status }}
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('finances.details', $affiliate->id) }}"
                            class="btn btn-sm btn-primary mb-0 me-0 py-2 px-3">
                            <i class=" fs-6 fas fa-eye"></i> Ver detalles
                        </a>
                        @if ($affiliate->debt)
                            <button type="button" wire:click="toPay({{ $affiliate->id }})"
                                class="btn btn-sm btn-success mb-0 me-0 py-2 px-3">
                                <i class=" fs-6 fas fa-check"></i> Pagar Deuda
                            </button>
                        @endif
                    </td>
                </tr>
            @empty
            @endforelse
        </x-table-registers>
        <div class="border-top py-3 px-3 d-flex align-items-center">
            {{ $affiliates->links() }}
        </div>
    </x-card-body>
    @include('livewire.type_pay.form')
</div>
