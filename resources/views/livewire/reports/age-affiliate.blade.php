<div>
    <div class="row mx-1 g-2">

        <div class="col-md-3">
            <a href="#" class="text-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                aria-controls="offcanvasRight"> <u> <i class="far fa-question-circle"></i> Filtros de busqueda </u></a>
        </div>
        <div class="col-md-9">
            <div class="d-grid gap-1  d-md-flex justify-content-md-end">

                <a target="_blank" href="{{ route('pdf.report.ageAffiliate', [$this->minor, $this->max,$this->status]) }}"
                    class="btn btn-sm btn-outline-danger mb-1" type="button">
                    <i class="far fa-file-pdf fs-6"></i> Descargar PDF
                </a>
                <a href="{{ route('reporte.age.afiliados-excel',[$this->minor, $this->max,$this->status]) }}" class="btn btn-sm btn-outline-success mb-1 " type="button">
                    <i class="far fa-file-excel fs-6"></i> Exporta a Excel</a>
            </div>
        </div>
    </div>
    <hr>
    <div class="mx-2">
        <x-table-report class="table-report table-striped">
            <tr>
                <td colspan="2"><strong>INSTITUCION:</strong> {{ $institution->name }} </td>
                <td><strong>GESTION:
                        {{ now()->year }}
                    </strong></td>

            </tr>
            <tr>
                <td><strong>Masculino:</strong> {{ $masculino }} </td>
                <td><strong>Femenino:</strong> {{ $femenino }} </td>
                <td rowspan="3" class="text-center"> <strong class="fs-6"> {{ $affiliates->total() }}</strong>
                    <br><strong>Total</strong>
                </td>
            </tr>
            <tr>
                <td colspan="2"><strong>Rango de edad:</strong> De {{ $this->minor }} a {{ $this->max }} anos de
                    edad
                </td>
            </tr>
            <tr>
                <td colspan="2"><strong>Estado: </strong> {{ $this->status ? $this->status : 'Todos' }}
                </td>
            </tr>

        </x-table-report>
        <div class="table-responsive">
            <x-table-report class="table table-report table-striped table-bordered">
                <x-slot name="header">
                    <th class="text-center">#</th>
                    <th class="text-center">Nombres Completo</th>
                    <th class="text-center">Edad</th>
                    <th class="text-center">Correo Electronico</th>
                    <th class="text-center">Genero</th>
                    <th class="text-center">Telefono</th>
                </x-slot>

                @forelse ($affiliates as $affiliate)
                    <tr>
                        <td class="text-center">
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $affiliate->user->full_name }}
                        </td>
                        <td class="text-center">
                            {{ $affiliate->user->age }}
                        </td>
                        <td>

                            {{ $affiliate->user->email }}

                        </td>
                        <td class="text-center">

                            {{ $affiliate->user->gender }}

                        </td>
                        <td class="text-center">
                            @foreach ($affiliate->user->phones as $phone)
                                {{ $phone->number }}
                                <br>
                            @endforeach
                        </td>
                    </tr>
                @empty
                @endforelse

            </x-table-report>
        </div>
    </div>
    {{ $affiliates->links() }}

    <x-question-offcanvas>
        <div class="col-md-12">
            <strong class="text-dark">Edad minima</strong>
            <div class="form-floating ">
                <input type="input" class="form-control" wire:model="minor" id="floatingInput"
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
                <input type="input" class="form-control" wire:model="max" id="floatingInput"
                    placeholder="name@example.com">
                <label for="floatingInput">Hasta</label>
            </div>
            <span style="font-size: 0.90rem; display: inline-block;
                            line-height: 1;">Filtra
                los resultados que tenga menor o igual a la edad ingresada</span>
        </div>
        <div class="col-md-12">
            <strong class="text-dark"> Seleccione estado</strong>
            <div class="form-floating">
                <select class="form-select" wire:model="status" id="floatingSelect"
                    aria-label="Floating label select example">
                    <option value="">Todos</option>
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
