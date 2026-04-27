<div>
    <style>
        @media (max-width: 950px) {

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

        @keyframes blink-shadow {

            0%,
            100% {
                box-shadow: 0 0 0.3rem rgba(0, 252, 0, 0.4);
            }

            50% {
                box-shadow: 0 0 0.5rem rgba(0, 252, 0, 0.8);
            }
        }

        .selected {
            animation: blink-shadow 2s infinite ease-in-out;
            cursor: pointer;
        }

        .card-hover:hover {
            background-color: var(--bs-light);
            /* bg-light */
            border-color: var(--bs-primary);
            /* border-primary */
            cursor: pointer;
        }
    </style>
    <x-card-header title="Historial de Denuncias" name="Demandas" />
    <div class="row g-1">
        <div class="order-md-1 order-2   col-md-9 col-ms-12   ">
            <x-card-body>
                <x-slot name="header">
                    <table class="table  table-striped table-bordered table-sm mb-0 stacked-table">
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
                                <td class="d-block d-sm-table-cell text-wrap"><strong>Correo electrónico:</strong>
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
                <div class="row">


                    @forelse ($demands as $demand)
                        <div class="col-md-6">
                            <x-card-body>
                                <x-slot name="header">
                                    <h4 class="text-center p-0 m-0">
                                        <i class="fas fa-user-tag"></i>
                                        {{ $demand->date }}
                                    </h4>
                                    <p class="fw-bold p-0 m-0 text-center text-dark ">{{ $demand->name }}</p>
                                    <p class="fw-bold p-0 m-0 text-center text-dark ">{{ $demand->type }}</p>
                                    <div
                                        class="card-footer bg-transparent m-0 p-0 border-0 d-flex justify-content-between ">

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
                                <div class="mb-0" style="min-height: 50px;">
                                    <span class=" text-info">{{ $demand->description }}</span>
                                </div>
                            </x-card-body>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info text-center rounded-3 py-3 shadow-sm">
                                <i class="far fa-sad-tear"></i> No hay denuncias registradas para este
                                afiliado.
                            </div>
                        </div>
                    @endforelse
                </div>
                {{ $demands->links() }}
            </x-card-body>
        </div>
        <div class=" order-md-2 order-1  col-md-3 col-ms-12  ">

            <x-card-body>
                <x-slot name="header">
                    <h6 class="text-secondary">Detalle por gestión</h6>
                </x-slot>
                @forelse ($managements as $management)
                    <div class="card mb-1  border-1 border text-dark card-hover @if ($management->year == $this->year) selected @endif"
                        wire:click="selected({{ $management->year }})">
                        <div class="card-body   py-1 px-2">
                            <h5 class="p-0 m-0 text-dark "> Gestión - {{ $management->year }}
                            </h5>
                            <span class="text-secondary d-block text-end" style="font-size: 1rem;"> Cantidad:
                                {{ $management->total }}</span>
                        </div>
                    </div>
                @empty
                    <div class="card   mb-1  border-1 border text-dark">
                        <div class="card-body   py-1 px-2">
                            <div class="alert alert-info text-center rounded-3 py-3 shadow-sm">
                                <i class="far fa-sad-tear"></i> No se encontraron registros
                            </div>
                        </div>
                    </div>
                @endforelse
                {{ $managements->links() }}

            </x-card-body>
        </div>
    </div>

</div>
