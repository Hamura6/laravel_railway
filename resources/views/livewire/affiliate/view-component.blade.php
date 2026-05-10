<div>
    <x-card-header title="Historial de Saldo" name="Afiliados" />
    <div class="row g-1">
        <div class="col-md-12">
            <div class="card border shadow-xs mb-4">
                <div class="card-header border-bottom pb-0">
<div class="table-responsive">
    <table class="table table-bordered border-light table-striped stacked-table">
        <tbody>
            <tr>
                <th class="text-dark text-xs font-weight-bold">Nombre Completo:</th>
                <td class="text-sm text-secondary">{{ $affiliate->user->name }}</td>
                <th class="text-dark text-xs font-weight-bold">Matrícula:</th>
                <td class="text-sm text-secondary">{{ $affiliate->id }}</td>
                <th class="text-dark text-xs font-weight-bold">C.I:</th>
                <td class="text-sm text-secondary">{{ $affiliate->user->ci }}</td>
            </tr>
            <tr>
                <th class="text-dark text-xs font-weight-bold">Teléfonos:</th>
                @foreach ($affiliate->user->phones as $phone)
                    <td class="text-sm text-secondary">{{ $phone->number }}</td>
                @endforeach
                <th class="text-dark text-xs font-weight-bold">Correo electrónico:</th>
                <td class="text-sm text-secondary" colspan="3">{{ $affiliate->user->email }}</td>
            </tr>
            <tr>
                <th class="text-dark text-xs font-weight-bold">Total:</th>
                <td class="text-sm text-secondary">{{ $affiliate->totalSum }} Bs.</td>
                <th class="text-dark text-xs font-weight-bold">Pagado:</th>
                <td class="text-sm text-secondary">{{ $affiliate->total_pagado + $affiliate->planes }} Bs.</td>
                <th class="text-dark text-xs font-weight-bold">Deuda:</th>
                <td class="text-sm text-secondary">{{ $affiliate->prest - $affiliate->planes }} Bs.</td>
            </tr>
        </tbody>
    </table>
</div>

<style>
    @media (max-width: 768px) {
        .stacked-table,
        .stacked-table tbody,
        .stacked-table tr,
        .stacked-table th,
        .stacked-table td {
            display: block;
            width: 100%;
        }

        .stacked-table tr {
            margin-bottom: 1rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .stacked-table th {
            background: rgba(0, 0, 0, 0.04);
            padding: 6px 12px;
            border-bottom: none;
        }

        .stacked-table td {
            padding: 6px 12px 10px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
        }

        .stacked-table td:last-child {
            border-bottom: none;
        }
    }
</style>
                    <hr class="my-0">
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input type="number " class="form-control" wire:model="year" id="floatingInput"
                                    placeholder="name@example.com">
                                <label for="floatingInput">Desde</label>
                            </div>
                        </div>

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
                                    <th>#</th>
                                    <th>Tipo</th>
                                    <th>Fecha</th>
                                    <th>Fecha de registro</th>
                                    <th>Monto</th>
                                    <th>Deuda</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>


                                @forelse ($payments as $payment)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $payment->fee->name }}</td>
                                        <td>{{ $payment->fecha_display }}</td>
                                        <td>{{ $payment->updated_at }}</td>
                                        <td>{{ $payment->amount }}</td>
                                        <td>{{ $payment->debt }}</td>
                                        <td><span
                                        class="badge rounded-pill  {{ $payment->status == 'Por pagar' ? 'text-danger  border border-danger ' : 'text-success  border border-success ' }} border-1">{{ $payment->status }}</span></td>
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
