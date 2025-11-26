<div>
    <style>
        .shadow-red {
            text-shadow: 0 0 9px rgb(212, 6, 6);
            color: rgb(150, 150, 150)
        }

        .shadow-success {

            text-shadow: 0 0 9px rgb(6, 212, 33);
            color: gray;
        }
    </style>
    <x-card-header title="Gestión de Trámites" name="Trámites" />

    <x-card-body>
        <x-slot name="header">
            @can('procedures.create')
                <div class="col-12 col-md-6 order-1 order-md-2">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" class="btn btn-sm  btn-success " data-bs-toggle="modal"
                            data-bs-target="#myModal">
                            <i class="far fa-file-alt fs-6"></i> Nuevo
                        </button>
                    </div>
                </div>
            @endcan
            <div class="col-12 col-md-6 order-2  order-md-1">
                <x-selected-live name='selected' title='Seleccione el tipo de tramite'>
                    <option value="">Todas</option>
                    @foreach ($fees as $fee)
                        <option value="{{ $fee->id }}">{{ $fee->name }}</option>
                    @endforeach
                </x-selected-live>
            </div>
            <div class="col-12 col-md-6  order-3">
                <x-search />
            </div>
            @foreach ($this->discounts as $discount)
                <div class="alert alert-success alert-dismissible fade show mb-1 p-1" role="alert">
                    <strong>Descuento del {{ $discount->discount_value }}% válido:</strong>
                    {{ $discount->start_date . ' | ' . $discount->end_date }} <br>
                    <small>Aplicado a: <em>{{ $discount->fees->pluck('name')->join(', ') }}</em></small>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endforeach

        </x-slot>
        <div class="row g-2" wire:target="search" wire:loading.remove>
            @forelse ($procedures as $procedure)
                <div class="col-md-4">
                    <div class="card border  mb-0 h-100 d-flex flex-column">
                        <div class="card-header  py-1 d-flex justify-content-between text-center ">
                            <strong class="fs-6">
                                {{ $procedure->fee->name }}
                            </strong>
                            <i
                                class="fas fa-clipboard-list @if ($procedure->status == 'Por pagar') shadow-red @else shadow-success @endif fs-4"></i>
                        </div>
                        <div class="card-body px-0 ">
                            <ul class="list-group list-group-flush ">
                                <li class="list-group-item py-0 pb-1 border-0"> <strong> <i
                                            class="fas fa-calendar-alt"></i> Fecha:
                                    </strong>{{ $procedure->date }} </li>
                                <li class="list-group-item py-0 pb-1 border-0"> <strong><i class="fas fa-id-badge"></i>
                                        Matrícula:
                                    </strong> {{ $procedure->affiliate->id }} </li>
                                <li class="list-group-item py-0 pb-1 border-0"><strong><i class="far fa-id-card"></i>
                                        ci:
                                    </strong>{{ $procedure->affiliate->user->ci }}
                                </li>
                                <li class="list-group-item py-0 pb-1 border-0"><strong><i
                                            class="fas fa-user-circle"></i> Nombre:
                                    </strong>{{ $procedure->affiliate->user->full_name }} </li>
                                <li class="list-group-item py-0 pb-1 border-0"><strong><i class="fas fa-phone"></i>
                                        Celular:
                                    </strong>{{ $procedure->affiliate->user->phones->first()->number ?? 'No registrado' }}
                                </li>
                                <hr class="p-0  m-0 mx-3 text-middle pb-1">
                                <li class="list-group-item border-0 py-0"><strong><i
                                            class="fas fa-money-bill-wave text-info"></i> Costo:
                                    </strong>{{ $procedure->amount }} Bs. </li>
                                @if ($procedure->debt)
                                    <li class="list-group-item py-0  border-0"> <strong><i
                                                class="fas fa-file-invoice-dollar text-danger"></i> Deuda:
                                            {{-- @if ($procedure->discount_value)
                                                <span
                                                    class="badge badge-sm border rounded-pill border-success text-success bg-success">
                                                    {{ $procedure->discount_value }} %
                                                </span>
                                            @endif --}}
                                        </strong><span
                                            class="badge badge-sm border rounded-pill border-danger text-danger">{{ $procedure->debt }}
                                            Bs.</span> </li>
                                @endif
                            </ul>

                        </div>
                        <div class="card-footer py-1 d-flex gap-1 justify-content-end">
                            @can('procedures.delete')
                                <x-btn-delete id="{{ $procedure->id }}" />
                            @endcan
                            @can('procedures.edit')
                                <x-btn-edit id="{{ $procedure->id }}" />
                            @endcan
                            @if ($procedure->fee->type == 'installments')
                                @can('procedures.view')
                                    <a type="button" wire:target="changeStatus, delete"
                                        wire:loading.class="disabled pointer-events-none opacity-50"
                                        href="{{ route('procedures.details', $procedure->id) }}" class="btn-purple-circle"
                                        data-bs-toggle="tooltip" data-bs-title="Ver detalle">
                                        <i class="fas fa-eye fs-6"></i>
                                    </a>
                                @endcan
                            @endif
                            @if ($procedure->debt > 0)
                                @can('payments.pay')
                                    <button wire:target="check, delete, edit" wire:loading.attr="disabled"
                                        class="btn-cc-circle outlined"
                                        onclick="Question({{ $procedure->id }},'Desea realizar el pago completo del tramite?','check')"
                                        data-bs-toggle="tooltip" data-bs-title="Pagar saldo">
                                        <i class="fas fa-hand-holding-usd fs-6"></i></button>
                                @endcan
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="far fa-sad-tear me-2"></i> No se encontró ningún registro...
                    </div>
                </div>
            @endforelse
        </div>

        <div class="col-md-12" wire:target="search" wire:loading>
            <div class="card border m-2">
                <div class="card-body m-0">
                    <div class="d-flex flex-row justify-content-center">
                        <div class="spinner-border " style="width: 4rem; height: 4rem;" role="status">
                            <span class="visually-hidden ">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-top py-3 px-3 d-flex align-items-center">
            {{ $procedures->links() }}

        </div>
    </x-card-body>
    @include('livewire.procedures.form')
</div>
