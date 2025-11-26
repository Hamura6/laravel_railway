<div>
    <x-card-header title="Convenios" name="Convenios" />
    <x-card-body>
        <x-slot name="header">
            <div class="col-sm-12 col-md-6 order-2 order-md-1">
                <x-search />
            </div>
            @can('agreements.create')
                <div class="col-md-6 order-1 order-md-2 col-ms-12">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('agreement.form') }}" wire:navigate
                            wire:loading.class="disabled pointer-events-none opacity-50" type="button"
                            class="btn btn-sm  btn-success  mb-0">
                            <i class="far fa-file-alt fs-6"></i> Nuevo
                        </a>
                    </div>
                </div>
            @endcan

        </x-slot>
        {{--         <style>
            /* Estilos de la tarjeta */
            .my-card-agrement {
                width: 230px;
                border-radius: 20px;
                background: #1b233d;
                padding: 5px;
                overflow: hidden;
                box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 20px 0px;
                transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            }

            .my-card-agrement:hover {
                transform: scale(1.05);
            }

            .my-card-agrement .top-section {
                height: 200px;
                border-radius: 15px;
                display: flex;
                flex-direction: column;
                position: relative;
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            }

            .my-card-agrement .top-section .border {
                border-bottom-right-radius: 10px;
                height: 30px;
                width: 130px;
                background: #1b233d;
                position: relative;
                transform: skew(-40deg);
                box-shadow: -10px -10px 0 0 #1b233d;
            }

            .my-card-agrement .top-section .border::before {
                content: "";
                position: absolute;
                width: 15px;
                height: 15px;
                top: 0;
                right: -15px;
                background: transparent;
                border-top-left-radius: 10px;
                box-shadow: -5px -5px 0 2px #1b233d;
            }

            .my-card-agrement .top-section::before {
                content: "";
                position: absolute;
                top: 30px;
                left: 0;
                background: transparent;
                height: 15px;
                width: 15px;
                border-top-left-radius: 15px;
                box-shadow: -5px -5px 0 2px #1b233d;
            }

            .my-card-agrement .top-section .icons {
                position: absolute;
                top: 0;
                width: 100%;
                height: 30px;
                display: flex;
                justify-content: space-between;
                z-index: 2;
                padding: 0 10px;
                align-items: center;
            }

            .my-card-agrement .top-section .icons .logo {
                font-weight: bold;
                font-size: 14px;
                color: white;
                text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
                letter-spacing: 1px;
            }

            .my-card-agrement .top-section .icons .social-media {
                display: flex;
                gap: 8px;
            }

            .my-card-agrement .top-section .icons .social-media i {
                color: #1b233d;
                font-size: 22px;
                transition: color 0.3s ease;
            }
        </style> --}}
        <!-- From Uiverse.io by Smit-Prajapati -->
        <!-- Card modificada -->
        <!-- Tarjeta de perfil -->

        <div class="row g-1">
            @forelse ($agreements as  $agreement)
                <div class="col-md-4 p-3">
                    <div class="my-card-agrement  card w-100 h-100 ">
                        <div class="top-section" style="background-image: url('{{ $agreement->image_view }}');">
                            <div class="border border-0"></div>
                            <div class="icons">
                                <div class="logo text-white">ICAP</div>
                                <div class="social-media ">
                                    @forelse ($agreement->socials as $social)
                                        <a href="{{ $social->url }}" data-bs-toggle="tooltip"
                                            data-bs-title="{{ $social->type }}">
                                            <i class="{{ $social->icon }} text-white "></i>
                                        </a>
                                    @empty
                                    @endforelse
                                    {{-- <i class="fab fa-facebook-f"></i>
                                    <i class="fab fa-twitter"></i>
                                    <i class="fab fa-instagram"></i>
                                    <i class="fab fa-whatsapp"></i> --}}
                                </div>
                            </div>

                        </div>
                        <div class="card-body ">
                            <h5 class="card-title text-white m-0">{{ $agreement->name }}</h5>
                        </div>
                        <div class="card-footer ">
                            <div class=" gap-2 d-md-flex justify-content-md-end">
                                @can('agreements.delete')
                                    <x-btn-delete id="{{ $agreement->id }}" />
                                @endcan
                                @can('agreements.edit')
                                    <a wire:target="changeStatus, delete"
                                        wire:loading.class="disabled pointer-events-none opacity-50"
                                        href="{{ route('agreement.form', $agreement->id) }}" type="button"
                                        class="btn-purple-circle outlined" data-bs-toggle="tooltip" data-bs-title="Editar">
                                        <i class="fas fa-edit fs-6"></i>
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-4">
                    <div class="card" style="height: 100%">

                        <img src="{{ $agreement->image_view }}" class="card-img-top" alt="{{ $agreement->title }}"
                            style="height: 220px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $agreement->name }}</h5>
                            <div class="mt-auto px-3 pb-3">
                                <div class="d-flex justify-content-center gap-2">
                                    @forelse ($agreement->socials as $social)
                                        <a href="{{ $social->url }}" type="button"
                                            class="btn  btn-{{ $social->color }} p-2 m-0 rounded-circle"
                                            data-bs-toggle="tooltip" data-bs-title="{{ $social->type }}">
                                            <i class="{{ $social->icon }} fs-5"></i>
                                        </a>
                                    @empty
                                    @endforelse
                                </div>
                            </div>

                        </div>
                        <div class="card-footer bg-transparent border-top p-1 m-0">
                            <div class=" gap-2 d-md-flex justify-content-md-end">
                                <x-btn-delete id="{{ $agreement->id }}" />
                                <a wire:target="changeStatus, delete"
                                    wire:loading.class="disabled pointer-events-none opacity-50"
                                    href="{{ route('agreement.form', $agreement->id) }}" type="button"
                                    class="btn  btn-info p-2 m-0 rounded-circle" data-bs-toggle="tooltip"
                                    data-bs-title="Editar usuario">
                                    <i class="fas fa-edit fs-6"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div> --}}
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center rounded-3 py-3 shadow-sm">
                        <i class="far fa-sad-tear"></i> No se encontraron registros.
                    </div>
                </div>
            @endforelse
        </div>
        <div class="border-top py-3 px-3 d-flex align-items-center">
            {{ $agreements->links() }}
        </div>
    </x-card-body>
</div>
