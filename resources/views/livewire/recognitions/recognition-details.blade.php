<div>
    <x-card-header title="Condecoracion" name="Pagos" />
    <div class="row g-1">

        <div class="col-md-8">
            <x-card-body>
                <x-slot name="header">
                    <h6 class="text-secondary">Datos del evento </h6>
                </x-slot>

                <table class="table  table-bordered border-light table-striped">
                    <tbody>
                        <tr>
                            <th> Fecha:</th>
                            <td>
                                {{ $this->recognition->date }}
                            </td>
                        </tr>
                        <tr>
                            <th> Tipo:</th>
                            <td>
                                {{ __($this->recognition->type) }}
                            </td>
                        </tr>
                        <tr>
                            <th>Acontecimiento:</th>
                            <td>{{ $this->recognition->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>Aportes a conciderar:</th>
                            <td>{{ $this->recognition->quantity }}
                            </td>
                        </tr>
                        <tr>
                            <th>Cantidad de participantes:
                            </th>
                            <td>{{ $this->recognition->participants }}</td>

                        </tr>
                        <tr>
                            <th>Tiempo restante para el
                                evento:</th>
                            <td>{{ $this->recognition->remaining_days }}</td>

                        </tr>
                        <tr>

                            <td colspan="2">
                                <div class="d-grid gap-1  d-md-flex justify-content-md-end">

                                    <a target="_blank" href="{{ route('pdf.listAffiliate', $this->recognition->id) }}"
                                        class="btn btn-sm btn-outline-danger mb-1" type="button">
                                        <i class="far fa-file-pdf fs-6"></i> Descargar PDF
                                    </a>
                                    <a href="{{ route('reporte.listAffiliates-excel', $this->recognition->id) }}"
                                        class="btn btn-sm btn-outline-success mb-1 " type="button">
                                        <i class="far fa-file-excel fs-6"></i> Exporta a Excel</a>
                                </div>
                            </td>

                        </tr>


                </table>

                <x-table-registers>
                    <x-slot name="header">
                        <th>Matricula</th>
                        <th>Nombre</th>
                        <th>Antiguedad</th>
                        <th>Fecha <br>Inscripcion</th>
                        <th>Telefono</th>
                        <th>Quitar</th>
                    </x-slot>
                    <tbody>
                        @forelse ($affiliatesConfirm as $cofirm)
                            <tr class="align-middle">
                                <td>{{ $cofirm->id }}</td>
                                <td>
                                    {{ $cofirm->user->title . ' ' . $cofirm->user->full_name }}</td>
                                <td>{{ $cofirm->antique }}</td>
                                <td>{{ $cofirm->created_at }}</td>
                                <td>{{ $cofirm->user->phones->first()->number ?? 'Ninguno' }}</td>
                                <td>
                                    @can('recognitions.edit')
                                        <button class="btn-dc-circle"
                                            onclick="Question({{ $cofirm->id }}, '¿Desear descartar como participante?', 'removeAffiliate')">
                                            <i class="fas fa-times fs-6"></i>
                                        </button>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" align="center">
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
                    {{ $affiliatesConfirm->links() }}
                </div>
            </x-card-body>
        </div>
        <div class="col-md-4" style="max-height: 140vh; overflow-y: auto;">
            <x-card-body>
                <x-slot name="header">
                    <h6 class="text-secondary">Lista de afiliados habilidatos</h6>
                    <div class="input-group input-group-sm ms-auto me-2">
                        <span class="input-group-text text-body">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" wire:model.live.debounce.1000ms="toSearch"
                            class="form-control form-control-sm" placeholder="Buscar">
                    </div>

                </x-slot>
                @forelse ($affiliates as $affiliate)
                    <div class="card shadow-md mb-2">
                        <div class="card-body p-2">

                            <div class="d-flex align-items-center mb-1">
                                <h5 class="card-title fw-bold mb-0 text-dark">
                                    {{ $affiliate->user->gender == 'Masculino' ? 'Dr. ' : 'Dra. ' }}
                                    {{ $affiliate->user->name }} {{ $affiliate->user->last_name }}
                                </h5>
                            </div>

                            <ul class="list-unstyled small text-muted mb-0">
                                <li><strong>Matrícula:</strong> {{ $affiliate->id }}</li>
                                <li><strong>Estado:</strong> <span
                                        class="badge bg-light text-dark">{{ $affiliate->status }}</span></li>
                                <li><strong>Antigüedad:</strong> {{ $affiliate->antique }}</li>
                                <li><strong>Cuotas pendientes:</strong> {{ $affiliate->pending_payments_count }}</li>

                                <li><strong>Inscripción:</strong> {{ $affiliate->created_at }}</li>
                                <li class="d-flex justify-content-between m-0">
                                    <div>
                                        <strong>Celular:</strong>
                                        {{ optional($affiliate->user->phones->first())->number ?? 'N/A' }}
                                    </div>
                                    @can('recognitions.edit')
                                        <button class="btn-cc-circle outlined"
                                            onclick="Question({{ $affiliate->id }}, '¿Desea confirmar su participación?', 'AddAffiliate')">
                                            <i class="fas fa-check fs-6"></i>
                                        </button>
                                    @endcan
                                </li>
                            </ul>


                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center shadow-sm">
                            <i class="far fa-sad-tear"></i> No se encontraron registros
                        </div>
                    </div>
                @endforelse
                <div class="text-center py-4 color-dark justify-content-center w-100" wire:loading
                    wire:target="toSearch">
                    <div class="spinner-border " style="width: 4rem; height: 4rem;" role="status">
                        <span class="visually-hidden ">Loading...</span>
                    </div>
                </div>
                <div class="border-top py-3 px-3 d-flex align-items-center">
                    {{ $affiliates->links() }}
                </div>
            </x-card-body>
        </div>
    </div>
</div>
