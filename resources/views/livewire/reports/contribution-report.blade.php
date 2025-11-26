<div>
    <x-card-header title="Reporte de Pagos" />
    <x-card-body>
        <div class="row mx-1 g-2">

            <div class="col-md-3">
                <a href="#" class="text-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                    aria-controls="offcanvasRight"> <u> <i class="far fa-question-circle"></i> Filtros de busqueda
                    </u></a>
            </div>
            <div class="col-md-9">
                <div class="d-grid gap-1  d-md-flex justify-content-md-end">

                    <a target="_blank" href="{{ route('pdf.report.contribution', [$this->from, $this->to]) }}"
                        class="btn btn-sm btn-outline-danger mb-1" type="button">
                        <i class="far fa-file-pdf fs-6"></i> Descargar PDF
                    </a>
                    <a href="{{ route('reporte.contribution-excel', [$this->from, $this->to]) }}"
                        class="btn btn-sm btn-outline-success mb-1 " type="button">
                        <i class="far fa-file-excel fs-6"></i> Exporta a Excel</a>
                </div>
            </div>
        </div>
        <hr>
        <div class="mx-2">
            <x-table-report class="table-report table-striped">
                <tr>
                    <td><strong>INSTITUCION:</strong> {{ $institution->name }} </td>
                    <td><strong>GESTION:
                            {{ now()->year }}
                        </strong></td>

                </tr>
                <tr>
                    <td colspan="2"><strong>Fecha:</strong>
                        {{ \Carbon\Carbon::parse($this->from)->isoFormat('ddd, D \d\e MMM \d\e\l Y') .
                            ' al ' .
                            \Carbon\Carbon::parse($this->to)->isoFormat('ddd, D \d\e MMM \d\e\l Y') }}
                    </td>

                </tr>
                <tr>
                    <td><strong>CANTIDAD DE AFILIADOS:</strong> {{ $affiliates->total() }} </td>
                    <td><strong>TOTAL DE APORTES:
                        </strong>{{ $affiliates->sum('payments_sum_amount') }} Bs.</td>

                </tr>
            </x-table-report>
            <div class="row mx-1 g-2">
                <div class="col-md-6">
                    <x-search />
                </div>
            </div>
            <div class="table-responsive">
                <x-table-report class="table table-report table-striped table-bordered">
                    <x-slot name="header">
                        <th class="text-center">Matricula</th>
                        <th class="text-center">Nombres Completo</th>
                        <th class="text-center">monto de aportes</th>
                        <th class="text-center">fecha de registro</th>
                        <th class="text-center">Telefono</th>
                        <th class="text-center">Detalle</th>
                    </x-slot>

                    @forelse ($affiliates as $affiliate)
                        <tr class="align-middle">
                            <td>
                                {{ $affiliate->id }}
                            </td>
                            <td>
                                {{ $affiliate->user->full_name }}
                            </td>
                            <td class="text-center">
                                {{ $affiliate->payments_sum_amount ?? 0 }} Bs.
                            </td>
                            <td class="text-center">

                                {{ $affiliate->created_at }}

                            </td>

                            <td class="text-center">
                                @foreach ($affiliate->user->phones as $phone)
                                    {{ $phone->number }}
                                    <br>
                                @endforeach
                            </td>
                            <td class="text-center">
                                @can('reports')
                                    <a href="{{ route('report.contribution.affiliate', [$affiliate->id, $this->from, $this->to]) }}"
                                        class="btn-purple-circle"> <i class="fas fa-eye"></i> </a>
                                @endcan
                            </td>
                        </tr>
                    @empty
                    @endforelse

                </x-table-report>
            </div>
        </div>
        {{ $affiliates->links() }}
    </x-card-body>
    <x-question-offcanvas>
        <div class="col-md-12">
            <strong class="text-dark">Edad minima</strong>
            <div class="form-floating ">
                <input type="date" class="form-control" wire:model="from" id="floatingInput"
                    placeholder="name@example.com">
                <label for="floatingInput">Desde</label>
            </div>
            <span style="font-size: 0.90rem; display: inline-block;
                            line-height: 1;">Filtra
                los resultados que tienes mayor o igual a la edad ingresada</span>
        </div>
        <div class="col-md-12">
            <strong class="text-dark"> Edad maxima</strong>
            <div class="form-floating">
                <input type="date" class="form-control" wire:model="to" id="floatingInput"
                    placeholder="name@example.com">
                <label for="floatingInput">Hasta</label>
            </div>
            <span style="font-size: 0.90rem; display: inline-block;
                            line-height: 1;">Filtra
                los resultados que tenga menor o igual a la edad ingresada</span>
        </div>

    </x-question-offcanvas>

</div>
