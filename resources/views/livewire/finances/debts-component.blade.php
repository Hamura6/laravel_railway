<div>
    <x-card-header title="Gestión de Pagos" name="Saldos" />
    <x-card-body>
        <x-slot name="header">
            <div class="col-md-6  col-ms-12 order-md-2 order-sm-1">
                <div class="form-floating">
                    <select class="form-select" wire:model.live="selected" id="floatingSelect"
                        aria-label="Floating label select example">
                        <option value="">Todos</option>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                        <option value="Fallecido">Fallecidos</option>
                        {{--                         <option value="Exento">Exento</option>
                        <option value="Licencia">Licencia</option> --}}
                    </select>
                    <label for="floatingSelect">Seleccione el estado</label>
                </div>
            </div>
            <div class="col-sm-12 col-md-6  order-md-1 order-sm-2">
                <x-search />
            </div>
        </x-slot>
        <x-table-registers>
            <x-slot name="header">
                <th>Matrícula</th>
                <th>Afiliado</th>
                <th>C.I.</th>
                <th>Antigüedad</th>
                <th>Último pago de aporte</th>
                <th>Deuda de aporte</th>
                <th>Deuda total</th>
                <th>Estado</th>
                <th>Acciones
                </th>
            </x-slot>
            @forelse ($affiliates as $affiliate)
                <tr class="align-middle">
                    <td>{{ $affiliate->id }}</td>
                    <td>{{ $affiliate->user->full_name }}</td>
                    <td>{{ $affiliate->user->ci }}</td>
                    <td class="text-secondary">{{ $affiliate->antique }}
                    </td>
                    <td class="text-secondary">
                        {{ \Carbon\Carbon::parse($affiliate->ultimoPago)->locale('es')->isoFormat('MMMM YYYY') }}
                    </td>
                    <td class="text-secondary">{{ number_format($affiliate->aportes, 2) }} Bs. =>
                        {{ $affiliate->aportes_cant }}</td>
                    <td class="text-secondary">{{ $affiliate->prest - $affiliate->planes }}
                        Bs.</td>


                    <td align="center">
                        <span class="badge rounded-pill text-dark  border border-dark border-1">
                            {{ $affiliate->status }}
                        </span>
                    </td>

                    <td class="text-center">
                        <div class="d-flex flex-row justify-content-center align-items-center gap-1">
                            @can('payments.pay')
                                <button class="btn-uc-circle" wire:loading.attr="disabled" data-bs-toggle="tooltip"
                                    data-bs-title="Pagar Aporte"
                                    wire:click="edit({{ $affiliate->id }},{{ $affiliate->aportes_cant ? $affiliate->aportes_cant : 0 }},{{ $affiliate->aportes ? $affiliate->aportes : 0 }})">
                                    <i class="fas fa-edit fs-6"></i>

                                </button>
                            @endcan
                            <a href="{{ route('finances.details', $affiliate->id) }}" class="btn-purple-circle"
                                data-bs-toggle="tooltip" data-bs-title="Detalle">
                                <i class="fs-6 fas fa-eye"></i>
                            </a>
                            @if ($affiliate->prest - $affiliate->planes > 0)
                                @can('payments.pays')
                                    <button wire:target="check, delete, edit" wire:loading.attr="disabled"
                                        class="btn-cc-circle outlined"
                                        onclick="Question({{ $affiliate->id }},'Desea realizar el pagos de todas las deudas?','toPay')"
                                        data-bs-toggle="tooltip" data-bs-title="Realizar pago">
                                        <i class="fas fa-hand-holding-usd fs-6"></i></button>
                                @endcan
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">
                        <h5>
                            <i class="far fa-sad-tear"></i>

                            No se encontraron registros...
                        </h5>
                    </td>
                </tr>
            @endforelse

        </x-table-registers>
        <div class="border-top py-3 px-3 d-flex align-items-center">
            {{ $affiliates->links() }}
        </div>
    </x-card-body>
    @include('livewire.finances.form')
</div>
