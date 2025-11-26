<div>
    <x-card-header title="Cursos" name="Cursos" />
    <x-card-body>
        <x-slot name="header">
            <div class="col-sm-12 col-md-6 order-2 order-md-1">
                <x-search />
            </div>
            @can('courses.create')
                <div class="col-md-6 order-1 order-md-2 col-ms-12">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('courses.form') }}" wire:navigate
                            wire:loading.class="disabled pointer-events-none opacity-50" type="button"
                            class="btn btn-sm  btn-success  mb-0">
                            <i class="far fa-file-alt fs-6"></i> Nuevo
                        </a>
                    </div>
                </div>
            @endcan

        </x-slot>
        <style>
            .course-card {
                transition: all 0.3s ease;
                cursor: pointer;
            }

            .course-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12) !important;
            }

            .course-card:hover .course-img {
                transform: scale(1.05);
            }

            .course-img {
                height: 180px;
                transition: transform 0.4s ease;
            }

            .price-badge {
                font-size: 0.875rem;
                animation: pulse 2s infinite;
                z-index: 2;
            }

            @keyframes pulse {
                0% {
                    transform: scale(1);
                }

                50% {
                    transform: scale(1.05);
                }

                100% {
                    transform: scale(1);
                }
            }

            .transition-all {
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
        </style>
        <div class="row g-2">

            @forelse ($courses as  $course)
                <div class="col-md-4 mb-2">
                    <div
                        class="card h-100 border-0 shadow-sm course-card position-relative overflow-hidden rounded-3 transition-all">
                        <!-- Imagen con overlay y efecto zoom -->
                        <div class="position-relative overflow-hidden">
                            <img src="{{ $course->image_view }}" alt="{{ $course->title }}"
                                class="w-100 course-img object-fit-cover">

                            <!-- Badge de precio con animación -->
                            <div
                                class="badge bg-primary text-white fw-bold position-absolute top-0 end-0 mt-3 me-3 px-3 py-2 rounded-pill shadow-sm price-badge">
                                Bs. {{ number_format($course->price, 2) }}
                            </div>
                        </div>

                        <!-- Cuerpo de la tarjeta -->
                        <div class="card-body p-2">
                            <h3 class="h5 fw-bold mb-1 text-dark ">
                                {{ $course->title }}
                            </h3>

                            <p class="small text-muted mb-2 ">
                                {{ Str::limit($course->description, 130) }}
                            </p>

                            <!-- Fechas con iconos -->
                            <div class="small text-secondary px-4">
                                <div class="d-flex align-items-center mb-1">
                                    <i class="far fa-calendar-alt me-2 text-info"></i>
                                    <span>Registro: {{ $course->created_at->format('d M, Y') }}</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-play-circle me-2 text-success"></i>
                                    <span>Inicio: {{ $course->date_start }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Footer con botones -->
                        <div class="card-footer bg-dark border-0 py-2 px-2">
                            <div class="d-flex gap-2 justify-content-end">
                                @can('courses.delete')
                                    <x-btn-delete id="{{ $course->id }}" class="btn btn-sm btn-outline-danger" />
                                @endcan
                                @can('courses.edit')
                                    <a href="{{ route('courses.form', $course->id) }}" wire:target="changeStatus, delete"
                                        wire:loading.class="disabled pointer-events-none opacity-50"
                                        class="btn btn-sm btn-outline-primary btn-uc-circle d-flex align-items-center justify-content-center"
                                        data-bs-toggle="tooltip" data-bs-title="Editar">
                                        <i class="fas fa-edit"></i>
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
            {{ $courses->links() }}
        </div>
    </x-card-body>
</div>
