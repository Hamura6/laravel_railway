<div>
    <x-card-header title="Historial de Cuotas" />
    <x-card-body>
        <div class="row mx-1 g-2">
            <div class="col-md-12">
                <div class="d-grid gap-1  d-md-flex justify-content-md-end">

                    <a href="{{ route('pdf.report.contribution.affiliate',[$this->affiliate->id,$this->from,$this->to]) }}" target="_blank" class="btn btn-sm btn-outline-danger mb-1" type="button">
                        <i class="far fa-file-pdf fs-6"></i> Descargar PDF
                    </a>
                    <a href="{{ route('reporte.contribution.affiliate-excel' ,[$this->affiliate->id,$this->from,$this->to]) }}" class="btn btn-sm btn-outline-success mb-1 " type="button">
                        <i class="far fa-file-excel fs-6"></i> Exporta a Excel</a>
                </div>
            </div>
        </div>
        <hr>
        <div class="mx-2">
            <x-table-report class="table-report table-striped">
                <tr>
                    <td colspan="2"><strong>INSTITUCION: </strong>{{ $institution->name }} </td>
                    <td><strong>GESTION: <span id="year"></span></strong></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Nombre: </strong>{{ $this->affiliate->user->full_name }} </td>
                    <td><strong>Matricula: </strong>{{ $this->affiliate->id }} </td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Fecha: </strong>{{ $this->date }}</td>
                    <td><strong>Estado:</strong> {{ $this->affiliate->status }}</td>
                </tr>

            </x-table-report>
            <div class="table-responsive">
                <x-table-report class="table table-report table-striped table-bordered">
                    <x-slot name="header">
                        <th class="text-center">Nro</th>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Recaudador</th>
                        <th class="text-center">Aportes</th>
                        <th class="text-center">Descargo</th>
                        <th class="text-center">Total</th>
                    </x-slot>

                    @forelse ($pagos as $pago)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td class="text-center">
                                {{ $pago->updated_at }}
                            </td>
                            <td class="text-center">
                                {{ $pago->user->full_name }}
                            </td>
                            <td>
                                {{ $pago->fecha_display }}
                            </td>
                            <td>

                                {{ $pago->type }}
                            </td>
                            <td class="text-center">

                                {{ $pago->amount }}

                            </td>
                        </tr>
                    @empty
                    @endforelse

                </x-table-report>
            </div>
        </div>
    </x-card-body>


</div>
