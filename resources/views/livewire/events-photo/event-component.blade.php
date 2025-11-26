<div>
    <div class="col-12">
        <x-card-header title="Modulo de eventos" name="Directorio" />
        <style>
            /* From Uiverse.io by alexruix - Custom version */
            .custom-card {
                overflow: visible;
                position: relative;
                width: 100%;
                height: 354px;
                background: #fff;
                box-shadow: 0 2px 10px rgba(0, 0, 0, .2);
                border-radius: 15px
            }

            .custom-card:before,
            .custom-card:after {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                border-radius: 15px;
                background: #fff;
                transition: 0.5s;
                z-index: -1;
            }

            .custom-details {
                position: absolute;
                bottom: 118px;
                height: 60px;
                text-align: center;
                text-transform: uppercase;
                width: 100%
            }

            /*Image*/
            .custom-imgbox {
                position: absolute;
                top: 10px;
                left: 10px;
                bottom: 10px;
                right: 10px;
                transition: 0.5s;
                z-index: 1;
            }

            .custom-img {
                background: #4158D0;
                background-image: linear-gradient(45deg, #4158D0, #C850C0);
                border-radius: 15px;
                width: 100%;
                height: 100%;
            }

            /*Text*/
            .custom-title {
                font-weight: 600;
                font-size: 16px;
                color: #777;
            }

            .custom-caption {
                font-weight: 500;
                font-size: 12px;
                margin-top: 2px;
                text-align: left;
                margin-left: 2px;
            }

            /*Hover*/
            .custom-card:hover .custom-imgbox {
                bottom: 180px;
            }

            .custom-card:hover:before {
                transform: rotate(20deg);
            }

            .custom-card:hover:after {
                transform: rotate(10deg);
                box-shadow: 0 2px 20px rgba(0, 0, 0, .2);
            }

            .custom-footer {
                position: absolute;
                display: flex;
                top: 180%;
                left: 0;
                right: 0;
                padding: 8px 12px;
                justify-content: end
            }
        </style>
        <x-card-body>
            <x-slot name="header">
                <h5 class="py-0">Eventos</h5>
            </x-slot>
            @can('events.create')
                <div class="col-md-12 order-1 order-md-2 col-ms-12">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" wire:target="search" wire:loading.attr="disabled"
                            class="btn btn-sm btn-success  mb-0 me-2" data-bs-toggle="modal" data-bs-target="#myModal">
                            <i class="far fa-file-alt fs-6"></i> Nuevo
                        </button>
                    </div>
                </div>
            @endcan
        </x-card-body>
        <div class="row pt-5 g-5">
            @forelse ($events as $event)
                <div class="col-md-4 ">
                    <div class="custom-card">
                        <div class="custom-imgbox">
                            <img class="custom-img"
                                src="{{ asset('storage/event_photos/' . ($event->firstPhoto->name ?? '69194dd33f84e.png')) }}"
                                alt="">
                            <div
                                class="badge bg-info text-white fw-bold position-absolute top-0 end-0 mt-3 me-3 px-3 py-2 rounded-pill shadow-sm price-badge">
                                {{ $event->date }}
                            </div>
                        </div>
                        <div class="custom-details px-2 pt-2">
                            <h2 class="custom-title">{{ $event->title }}</h2>
                            <p class="custom-caption">{{ $event->description }}</p>
                            <div class="custom-footer d-flex gap-1">
                                @can('events.delete')
                                    <x-btn-delete id="{{ $event->id }}" />
                                @endcan
                                @can('events.edit')
                                    <a href="{{ route('event.photos', $event->id) }}" class="btn-purple-circle"
                                        data-bs-toggle="tooltip" data-bs-title="Photos">
                                        <i class="fas fa-eye"></i>

                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center rounded-3 py-3 shadow-sm">
                        <i class="far fa-sad-tear"></i> No se encontraron registros.
                    </div>
                </div>
            @endforelse

        </div>
        <div class="border-top py-3 px-3 d-flex align-items-center">
            {{ $events->links() }}
        </div>
    </div>
    @include('livewire.events-photo.form')
</div>
