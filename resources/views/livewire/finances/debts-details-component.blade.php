<div wire:ignore.self>
    <x-card-header title="Consulta de saldos" name="Saldos" />
    <div class="row g-1">
        <div class="col-md-12">
            <x-card-body>
                <x-slot name="header">
                    <h6 class="font-weight-bolder text-secondary">Historial de saldo</h6>
                </x-slot>
                <style>
                    @media (max-width: 576px) {

                        .stacked-table td,
                        .stacked-table th {
                            display: block;
                            width: 100%;
                            white-space: normal;
                            word-wrap: break-word;
                            overflow-wrap: break-word;
                        }

                        .stacked-table tr {
                            display: block;
                            margin-bottom: 1rem;
                            border-bottom: 1px solid #dee2e6;
                        }

                        .stacked-table td strong {
                            display: inline-block;
                            min-width: 120px;
                            vertical-align: top;
                        }
                    }
                </style>
                <table class="table  table-bordered border-light table-striped  stacked-table">
                    <tbody>
                        <tr>
                            <th scope="col" class="text-dark text-xs font-weight-bold ">Nombre Completo:</th>
                            <td class="text-sm text-secondary mb-0">{{ $affiliate->user->name }} </td>
                            <th scope="col" class="text-dark text-xs font-weight-bold ">Matrícula:</th>
                            <td class="text-sm text-secondary mb-0">{{ $affiliate->id }}</td>
                            <th scope="col" class="text-dark text-xs font-weight-bold ">C.I:</th>
                            <td class="text-sm text-secondary mb-0">{{ $affiliate->user->ci }}</td>
                        </tr>
                        <tr>
                            <th scope="col" class="text-dark text-xs font-weight-bold ">Teléfonos:</th>
                            @foreach ($affiliate->user->phones as $phone)
                                <td class="text-sm text-secondary mb-0">{{ $phone->number }} </td>
                            @endforeach
                            <th scope="col" class="text-dark text-xs font-weight-bold ">Correo electrónico:</th>
                            <td class="text-sm text-secondary mb-0" colspan="3">{{ $affiliate->user->email }}
                            </td>

                        </tr>
                        <tr>
                            <th scope="col" class="text-dark text-xs font-weight-bold "> total:</th>
                            <td class="text-sm text-secondary mb-0">
                                {{ $affiliate->totalSum }} Bs.
                            </td>
                            <th scope="col" class="text-dark text-xs font-weight-bold "> Pagado:</th>
                            <td class="text-sm text-secondary mb-0">
                                {{ $affiliate->total_pagado + $affiliate->planes }} Bs.
                            </td>
                            <th scope="col" class="text-dark text-xs font-weight-bold "> Deuda:</th>
                            <td class="text-sm text-secondary mb-0">
                                {{ $affiliate->prest - $affiliate->planes }} Bs.
                            </td>
                        </tr>
                </table>
                <hr class="my-0">
                <div class="row mb-2">
                    <div class="col-md-4">
                        <div class="form-floating mb-3">
                            <input type="number " class="form-control" wire:model="year" id="floatingInput"
                                placeholder="name@example.com">
                            <label for="floatingInput">Desde</label>
                        </div>
                    </div>
                    {{--         <div class="col-md-4">
            <div class="form-floating mb-3">
                <input type="date" class="form-control" wire:model="to" id="floatingInput"
                    placeholder="name@example.com">
                    <label for="floatingInput">Hasta</label>
                </div>
        </div> --}}
                    <div class="col-md-4">
                        <div class="form-floating">
                            <select class="form-select" wire:model="type" id="floatingSelect"
                                aria-label="Floating label select example">
                                <option value="">Todos</option>
                                <option value="Por pagar">Por pagar</option>
                                <option value="Pagado">Pagado</option>
                            </select>
                            <label for="floatingSelect">Seleccione</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <select class="form-select" wire:model="concept" id="floatingSelect"
                                aria-label="Floating label select example">
                                <option value="">Todos</option>
                                @foreach ($fees as $fee)
                                    <option value="{{ $fee->id }}">{{ $fee->name }}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelect">Seleccione el concepto</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="d-grid gap-1  d-md-flex justify-content-md-end">
                            <a href="{{ route('pdf.report.affiliateDebt', [$affiliate->id, $this->year, $this->type, $this->concept]) }}"
                                class="btn btn-sm btn-outline-danger mb-1" type="button">
                                <i class="far fa-file-pdf fs-6"></i>
                                Descargar PDF
                            </a>
                            <button class="btn btn-sm btn-info mb-1 " wire:click.prevent='update()' type="button">
                                <i class="far fa-question-circle fs-6"></i>
                                Realizar consulta</button>

                        </div>
                    </div>
                </div>
                <x-table-registers>
                    <x-slot name='header'>
                        <th>
                            #
                        </th>
                        <th>
                            Tipo
                        </th>
                        <th>
                            Fecha
                        </th>
                        <th>
                            Fecha de registro
                        </th>
                        <th>
                            Monto
                        </th>
                        <th>
                            Deuda
                        </th>
                        <th>
                            Estado
                        </th>
                        <th align="center">
                            Operación
                        </th>
                    </x-slot>
                    <tbody>
                        @forelse ($payments as $payment)
                            <tr class="align-middle">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $payment->fee->name }}</td>
                                <td class="text-center">{{ $payment->fecha_display }}</td>
                                <td>{{ $payment->updated_at }}</td>
                                <td>{{ $payment->amount }}</td>
                                <td>{{ $payment->debt }}</td>
                                <td class="text-center"><span
                                        class="badge rounded-pill  {{ $payment->status == 'Por pagar' ? 'text-danger  border border-danger ' : 'text-success  border border-success ' }} border-1">{{ $payment->status }}</span>
                                </td>
                                <td align="center">
                                    @if ($payment->status == 'Por pagar' && $payment->fee->id != 1)
                                        @can('payments.pays')
                                            <button wire:target="check, delete, edit" wire:loading.attr="disabled"
                                                class="btn-cc-circle outlined"
                                                onclick="Question({{ $payment->id }},'Desea realizar el pago completo del tramite?','toPay')"
                                                data-bs-toggle="tooltip" data-bs-title="Pagar saldo">
                                                <i class="fas fa-hand-holding-usd fs-6"></i></button>
                                        @endcan
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr class="align-middle" align="center">
                                <td colspan="7">
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
                    {{ $payments->links() }}
                </div>
            </x-card-body>
        </div>
    </div>
</div>
