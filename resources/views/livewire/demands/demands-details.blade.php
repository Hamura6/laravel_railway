<div>
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
    <div class="row g-2">
        <x-card-header title="Historial de Denuncias" name="Denuncia" />
        <div class="col-md-12">

            <x-card-body>
                <x-slot name="header">
                    <table class="table table-striped table-bordered table-sm mb-0 stacked-table">
                        <tbody>
                            <tr>
                                <td> <strong>Nombre Completo:</strong> {{ $this->affiliate->user->full_name }}</td>
                                <td><strong>Matrícula:</strong> {{ $this->affiliate->id }}</td>
                                <td> <strong>C.I:</strong> {{ $this->affiliate->user->ci }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <strong>
                                        Teléfonos:
                                    </strong>
                                    @foreach ($this->affiliate->user->phones as $phone)
                                        <span class="badge bg-light text-dark me-1">{{ $phone->number }}</span>
                                    @endforeach
                                </td>
                                <td class="d-block d-sm-table-cell  text-wrap"><strong>Correo electrónico:</strong>
                                    {{ $this->affiliate->user->email }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="d-block d-sm-table-cell text-wrap"><strong>Dirección de
                                        domicilio:</strong>
                                    {{ $this->affiliate->address_home . ' No ' . $this->affiliate->address_number_home . ' / ' . $this->affiliate->zone_home }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="d-block d-sm-table-cell text-wrap">
                                    <strong>
                                        Dirección procesal:
                                    </strong>
                                    {{ $this->affiliate->address_office . ' No ' . $this->affiliate->address_number . ' / ' . $this->affiliate->zone }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </x-slot>
                <div class="col-md-12 d-grid gap-1 d-md-flex justify-content-md-end">
                    <a href="{{ route('demandsDetails', $this->affiliate->id) }}"
                        class="btn btn-outline-danger btn-sm px-2" type="button">
                        <i class="fas fa-file-pdf fs-6"></i> Descargar PDF
                    </a>
                    @can('demands.create')
                        <button class="btn btn-dark btn-sm px-2" data-bs-toggle="modal" data-bs-target="#myModal"
                            type="button">
                            <i class="far fa-file-alt fs-6"></i> Agregar Nueva Denuncia
                        </button>
                    @endcan
                </div>
            </x-card-body>
        </div>



        @forelse ($demands as $demand)
            <div class="col-md-4">
                <x-card-body>
                    <x-slot name="header">
                        <h4 class="text-center p-0 m-0">
                            <i class="fas fa-user-tag"></i>
                            {{ $demand->date }}
                        </h4>
                        <p class="fw-bold p-0 m-0 text-center text-dark ">{{ $demand->name }}</p>
                        <p class="fw-bold p-0 m-0  text-dark ">{{ $demand->complainant }}</p>
                        <p class="fw-bold p-0 m-0  text-dark ">{{ $demand->phone }}</p>
                        <div class="card-footer bg-transparent m-0 p-0 border-0 d-flex justify-content-between ">

                            <small>
                                <i class="far fa-calendar-alt me-1"></i> {{ $demand->created_at }}
                            </small>
                            <div>
                                @php
                                    $statusColor = match ($demand->status) {
                                        'Rechazada' => 'success',
                                        'Abierta' => 'danger',
                                        'En proceso' => 'warning',
                                        'Pendiente' => 'secondary',
                                        'Resulta' => 'dark',
                                        default => 'info',
                                    };
                                @endphp
                                <span
                                    class="badge text-bg-{{ $statusColor }}  px-3 py-2 shadow-sm rounded-pill fw-semibold">
                                    <i class="fas fa-circle me-1"></i>{{ $demand->status }}
                                </span>
                            </div>
                        </div>
                    </x-slot>
                    <div class="mb-0" style="min-height: 30px;">
                        <span class=" text-info">{{ $demand->description }}</span>
                    </div>
                    <div class="card-footer bg-transparent border-0 d-flex justify-content-center d-grid gap-1">
                        @can('demands.edit')
                            <button type="button" wire:target="changeStatus, delete, edit" wire:loading.attr="disabled"
                                wire:click="edit({{ $demand->id }})" class="btn btn-sm mb-0 btn-outline-info w-100 p-2 "
                                data-bs-toggle="tooltip" data-bs-title="Editar" wire:loading.attr="disabled">
                                <i class="fas fa-edit fs-6"></i> Editar
                            </button>
                        @endcan
                        @can('demands.delete')
                            <button type="button" wire:target="changeStatus, delete, edit" wire:loading.attr="disabled"
                                onclick="Confirm({{ $demand->id }})"
                                class="btn btn-sm btn-outline-danger mb-0 p-2  w-100" data-bs-toggle="tooltip"
                                data-bs-title="Eliminar" wire:loading.attr="disabled">
                                <i class="fas fa-trash fs-6"></i> Eliminar
                            </button>
                        @endcan
                    </div>
                </x-card-body>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center rounded-3 py-3 shadow-sm">
                    <i class="far fa-sad-tear"></i> No hay denuncias registradas para este afiliado.
                </div>
            </div>
        @endforelse
    </div>
    <div class="border-top py-3 px-3 d-flex align-items-center">
        {{ $demands->links() }}
    </div>
    @include('livewire.demands.form')
</div>
