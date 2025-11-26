<div>
    <div class="row mx-1 g-2">
        <div class="col-md-3">
            <a href="#" class="text-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                aria-controls="offcanvasRight"> <u> <i class="far fa-question-circle"></i> Filtros de busqueda </u></a>
        </div>
        <div class="col-md-9">
            <div class="d-grid gap-1  d-md-flex justify-content-md-end">
                <a target="_blank"
                    href="{{ route('pdf.report.specialityAffiliate', ['specialities' => $specialities]) }}"
                    class="btn btn-sm btn-outline-danger mb-1" type="button">
                    <i class="far fa-file-pdf fs-6"></i> Descargar PDF
                </a>
                <a class="btn btn-sm btn-outline-success mb-1 "
                    href="{{ route('reporte.speciality.afiliados-excel', ['specialities' => $specialities]) }}"
                    type="button">
                    <i class="far fa-file-excel fs-6"></i> Descargar Excel</a>
            </div>
        </div>
    </div>
    <hr>
    <x-table-report class="table-report table-striped">
        <tr>
            <td><strong>INSTITUCION:</strong>{{ $institution->name }} </td>
            <td><strong>GESTION:</strong> {{ now()->year }} </td>
        </tr>
        <tr>
            <td class="m-0 p-0"> <strong>ESPECIALIDAD:</strong>
                <div class="d-flex flex-wrap gap-1">
                    @foreach ($specialities as $key => $specialty)
                        <span class="badge text-bg-light d-inline-flex align-items-center">
                            <button type="button" class="border-0 bg-transparent text-dark"
                                wire:click="deleteItem({{ $key }})" aria-label="Close">X</button>
                            {{ $specialty }}
                        </span>
                    @endforeach
                </div>


            </td>
            <td class="text-center fs-6">
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
                <th class="text-center">Email</th>
                <th class="text-center">Celular</th>
                <th class="text-center">Cant. <br> Demandas</th>
                <th class="text-center">Cant. <br> Especialidades</th>
            </x-slot>
            @forelse ($affiliates as $affiliate)
                <tr>
                    <td>{{ $affiliate->id }}</td>
                    <td>{{ $affiliate->user->full_name }}</td>
                    <td>{{ $affiliate->user->email }}</td>
                    <td>{{ $affiliate->user->phones[0]->number }}</td>
                    <td>{{ $affiliate->demands->count() }}</td>
                    <td>{{ $affiliate->professions->count() }}</td>
                </tr>
            @empty
            @endforelse
        </x-table-report>
        {{ $affiliates->links() }}
    </div>



    <x-question-offcanvas>
        <div class="col-md-12">
            <strong class="text-dark">Seleccion las especialidades</strong>
            <div class="form-floating ">
                <input type="input" class="form-control" wire:model.live="searchTerm" wire:focus="showDropdown"
                    wire:blur="hideDropdown" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Especialidad</label>
                @if ($showList && !empty($filteredSpecialties))
                    <ul class="list-group mt-1" style="max-height: 200px; overflow-y: auto;">
                        @foreach ($filteredSpecialties as $specialty)
                            <li class="list-group-item list-group-item-action cursor-pointer"
                                wire:click="selectUniversity({{ $specialty->id }})">
                                {{ $specialty->name }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <span style="font-size: 0.90rem; display: inline-block;
                            line-height: 1;">Filtra
                los resultados de acuerdo a las especialidades seleccionadas</span>
        </div>
    </x-question-offcanvas>
</div>
