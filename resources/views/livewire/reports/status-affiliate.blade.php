<div>
    <div class="row mx-1 g-2">
        <div class="col-md-3">
            <a href="#" class="text-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                aria-controls="offcanvasRight"> <u> <i class="far fa-question-circle"></i> Filtros de busqueda </u></a>
        </div>
        <div class="col-md-9">
            <div class="d-grid gap-1  d-md-flex justify-content-md-end">
                <a target="_blank" href="{{ route('pdf.report.statusAffiliate',['statusTotal' => $statusTotal]) }}" class="btn btn-sm btn-outline-danger mb-1" type="button">
                    <i class="far fa-file-pdf fs-6"></i> Descargar PDF
                </a>
                <a href="{{route('reporte.afiliados-excel',['statusTotal' => $statusTotal])  }}" class="btn btn-sm btn-outline-success mb-1 " type="button">
                    <i class="far fa-file-excel fs-6"></i> Exporta a Excel</a>
            </div>
        </div>
    </div>
    <hr>
    <x-table-report class="table-report table-striped">
        <tr>
            <td><strong>INSTITUCION:</strong> {{ $institution->name }} </td>
            <td><strong>GESTION:</strong> {{ now()->year }} </td>
        </tr>
        <tr>
            <td>
                <strong>Estados</strong>
                <div class="d-flex flex-wrap gap-1">
                    @foreach ($statusTotal as $key => $stat)
                        <span class="badge rounded-pill text-dark  border border-dark border-1 text-bg-light d-inline-flex align-items-center">
                            <button type="button" class="border-0 bg-transparent text-dark"
                                wire:click="deleteItem('{{ $key }}')" aria-label="Close"><i class="fas fa-times"></i></button> 
                             {{ $key . ' = ' . $stat }}
                        </span>
                    @endforeach
                </div>

            </td>
            <td class="text-center text-center fs-6" rowspan="2">
                <strong>
                    {{ $affiliates->total() }}
                    <br>
                    TOTAL
                </strong>
            </td>
        </tr>
    </x-table-report>

    <div class="table-responsive">

        <x-table-report class="table table-report table-striped table-bordered">
            <x-slot name="header">
                <th class="text-center">Matricula</th>
                <th class="text-center">Affiliado</th>
                <th class="text-center">Antiguedad</th>
                <th class="text-center">Ultimo pago aporte</th>
                <th class="text-center">Estado</th>
            </x-slot>
            @forelse ($affiliates as $affiliate)
                <tr>
                    <td>{{ $affiliate->id }}</td>
                    <td>{{ $affiliate->user->full_name }}</td>
                    <td class="text-center">{{ $affiliate->antique }}</td>
                    </td>
                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($affiliate->ultimoPago)->locale('es')->isoFormat('MMMM YYYY') }}
                    </td>
                    <td class="text-center">{{ $affiliate->status }}</td>
                </tr>
                @empty
            @endforelse
        </x-table-report>
        {{ $affiliates->links() }}
    </div>
    <x-question-offcanvas>
        <div class="col-md-12">
            <div class="form-floating">
                <select class="form-select" wire:model="status" id="floatingSelect"
                    aria-label="Floating label select example">
                    <option value="Activo">Activos</option>
                    <option value="Inactivo">Inactivos</option>
                    <option value="Exento">Exentos</option>
                    <option value="Fallecido">Fallecidos</option>
                    <option value="Retirada">Retirada</option>
                    <option value="Licencia">Licencia</option>
                </select>
                <label for="floatingSelect">Seleccione un estado</label>
                <span
                    style="font-size: 0.80rem; display: inline-block;
                            line-height: 1;">Filtra
                    los resultados de acuerdo al estado seleccionado</span>
            </div>
        </div>
    </x-question-offcanvas>
</div>
