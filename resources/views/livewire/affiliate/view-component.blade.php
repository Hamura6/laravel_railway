<div>
    <x-card-header title="Historial de Saldo" name="Afiliados" />
    <div class="row g-1">
        <div class="col-md-12">
            <div class="card border shadow-xs mb-4">
                <div class="card-header border-bottom pb-0">
                    <table class="table  table-bordered border-light table-striped  stacked-table">
                        <tbody>
                            <tr>
                                <th scope="col" class="text-dark text-xs font-weight-bold ">Nombre Completo:</th>
                                <td class="text-sm text-secondary mb-0">{{ $affiliate->user->name }} </td>
                                <th scope="col" class="text-dark text-xs font-weight-bold ">Matricula:</th>
                                <td class="text-sm text-secondary mb-0">{{ $affiliate->id }}</td>
                                <th scope="col" class="text-dark text-xs font-weight-bold ">C.I:</th>
                                <td class="text-sm text-secondary mb-0">{{ $affiliate->user->ci }}</td>
                            </tr>
                            <tr>
                                <th scope="col" class="text-dark text-xs font-weight-bold ">Telefonos:</th>
                                @foreach ($affiliate->user->phones as $phone)
                                    <td class="text-sm text-secondary mb-0">{{ $phone->number }} </td>
                                @endforeach
                                <th scope="col" class="text-dark text-xs font-weight-bold ">Correo electronico:</th>
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
                </div>
                <div class="card-body px-0 py-0">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">#</th>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Tipo</th>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Fecha</th>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Monto</th>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Deuda</th>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Estado</th>
                                </tr>
                            </thead>
                            <tbody>


                                @forelse ($payments as $payment)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $payment->fee->name }}</td>
                                        <td>{{ $payment->date }}</td>
                                        <td>{{ $payment->amount }}</td>
                                        <td>{{ $payment->debt }}</td>
                                        <td>{{ $payment->status }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <h5>
                                                <i class="far fa-sad-tear"></i>

                                                No se encontraron registros...
                                            </h5>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="border-top py-3 px-3 d-flex align-items-center">
                            {{ $payments->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





</div>
