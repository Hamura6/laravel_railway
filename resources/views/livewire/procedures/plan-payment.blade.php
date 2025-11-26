<div>
    <x-card-header title="Pagos realizados" name="Pagos" />
    <div class="row g-1">

        <div class="col-md-8">
            <x-card-body>
                <x-slot name="header">
                    <h6 class="text-secondary">Tipo de tramite {{ $this->payment->fee->name }}</h6>
                </x-slot>

                <table class="table  table-bordered border-light table-striped">
                    <tbody>
                        <tr>
                            <th scope="col"> Costo:</th>
                            <td>
                                {{ $this->payment->amount }} Bs.
                            </td>
                        </tr>
                        <tr>
                            <th scope="col"> Deuda:</th>
                            <td>
                                {{ $this->debt }} Bs.
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">Nombre Completo:</th>
                            <td>{{ $this->payment->affiliate->user->full_name }}
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">Matrícula:</th>
                            <td>{{ $this->payment->affiliate->id }}</td>

                        </tr>
                        <tr>
                            <th scope="col">C.I:</th>
                            <td>{{ $this->payment->affiliate->user->ci }}</td>

                        </tr>
                        <tr>
                            <th scope="col">Teléfonos:</th>
                            @foreach ($this->payment->affiliate->user->phones as $phone)
                                <td> <span class="badge rounded-pill text-bg-dark  border border-dark border-1">
                                        {{ $phone->number }}
                                    </span>
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <th scope="col">Correo electrónico:</th>
                            <td colspan="2">
                                {{ $this->payment->affiliate->user->email }}
                            </td>
                        </tr>
                        {{--  <tr>
                        <th scope="col" class="text-dark text-xs font-weight-bold "> Direccion de domicilio:</th>
                        <td class="text-sm text-secondary mb-0" colspan="5">
                            {{ $this->payment->affiliate->address_home . ' No ' . $this->payment->affiliate->address_number_home . ' /' . $this->payment->affiliate->zone_home }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="text-dark text-xs font-weight-bold "> Direccion de domicilio procesal:
                        </th>
                        <td class="text-sm text-secondary mb-0" colspan="5">
                            {{ $this->payment->affiliate->address_office . ' No ' . $this->payment->affiliate->address_number . ' /' . $this->payment->affiliate->zone }}
                        </td>
                    </tr> --}}

                </table>
            </x-card-body>
        </div>
        <div class="col-md-4" style="max-height: 80vh; overflow-y: auto;">
            <x-card-body>
                <x-slot name="header">
                    <h6 class="text-secondary">Historial de pagos</h6>
                    @can('payments.pay')
                        <button type="button" class="btn btn-sm  btn-success  mb-0 me-2" data-bs-toggle="modal"
                            data-bs-target="#myModal">
                            <i class="far fa-file-alt fs-6"></i> Nuevo
                        </button>
                    @endcan
                </x-slot>
                @forelse ($plans as $plan)
                    <div class="card border-0 mb-3"
                        style="box-shadow: inset 2px 2px  7px rgba(0, 0, 0, 0.39); border-radius: 0.5rem;">
                        <div class="card-body p-3">
                            <h5 class="card-title text-dark fw-bold mb-1">{{ $plan->amount }} Bs.</h5>
                            <p class="card-text text-muted mb-0" style="font-size: 0.75rem;">
                                {{ $plan->created_at->format('d/m/Y H:i') }}
                            </p>
                            <button class="btn btn-sm btn-outline-danger rounded-circle position-absolute"
                                onclick="Confirm({{ $plan->id }})"
                                style="top: 8px; right: 8px; width: 24px; height: 24px; padding: 0;">
                                <i class="fas fa-trash" style="font-size: 0.65rem;"></i>
                            </button>
                        </div>
                    </div>


                @empty
                    <div class="card border-dark border  ">
                        <div class="card-body p-2 pt-1">
                            <p class="card-text">No se encontraron registros </p>
                        </div>
                    </div>
                @endforelse
            </x-card-body>
        </div>
    </div>
    @include('livewire.procedures.form-pay')
</div>
