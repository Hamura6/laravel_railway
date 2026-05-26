<div>
    <style>
        .hover-elevate {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .hover-elevate:hover {
            transform: translateY(-4px);
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.1) !important;
        }

        .badge.bg-white.text-primary {
            backdrop-filter: blur(4px);
            background-color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
        }
    </style>
    <x-card-header title="Artículos" name="Articulo" />
    <x-card-body>
        <x-slot name="header">
            <div class="col-sm-12 col-md-6 order-2 order-md-1">
                <x-search />
            </div>
            @can('Crear artículos')
                <div class="col-md-6 order-1 order-md-2 col-ms-12">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('article.form') }}" wire:navigate
                            wire:loading.class="disabled pointer-events-none opacity-50" type="button"
                            class="btn btn-sm btn-success mb-0">
                            <i class="far fa-file-alt fs-6"></i> Nuevo artículo
                        </a>
                    </div>
                </div>
            @endcan
        </x-slot>

        <div class="row g-4 mt-2" wire:target="search" wire:loading.remove>
            @forelse ($articles as $article)
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm hover-elevate overflow-hidden rounded-4">
                        <div style="position: relative; z-index: 1;">
                            <img src="{{ $article->image_view }}" class="card-img-top rounded-top-4"
                                alt="Portada del artículo"
                                style="height: 200px; object-fit: cover; width: 100%; display: block;">
                            <div class="position-absolute top-0 start-0 m-2" style="z-index: 3;">
                                <span class="badge bg-white text-dark rounded-pill px-3 py-1 shadow-sm">
                                    <i class="fas fa-file-alt me-1"></i>
                                    {{ $article->date ? \Carbon\Carbon::parse($article->date)->format('d/m/Y') : 'Sin fecha' }}
                                </span>
                            </div>
                        </div>

                        <div class="card-body bg-dark"
                            style="border-radius: 30px 30px 0 0; margin-top: -50px; position: relative; z-index: 2;">
                            <div class="small px-2 py-1" style="color: #927700">
                                <i class="fas fa-star me-1"></i>
                                Autor: {{ $article->author ?? 'no especificado' }}
                            </div>
                            <h5 class="card-title fs-6 text-white mb-2">{{ $article->title }}</h5>

                            <p class="card-text small mb-1"
                                style=" color: color-mix(in srgb, #fafafa, black 50%) !important;">
                                {{ $article->description }}
                            </p>
                        </div>

                        <div class="card-footer p-1" style="background: #f3f8fd">
                            <!-- Tus botones igual -->
                            <div class="d-flex justify-content-end gap-2">
                                @can('Eliminar artículos')
                                    <x-btn-delete id="{{ $article->id }}" />
                                @endcan
                                @can('Editar artículos')
                                    <a wire:target="delete" wire:loading.class="disabled pointer-events-none opacity-50"
                                        href="{{ route('article.form', $article->id) }}" class="btn-uc-circle"
                                        style="width: 34px; height: 34px;" data-bs-toggle="tooltip" data-bs-title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endcan
                                <a href="{{ Storage::url('articles/files/' . $article->file) }}" target="_black"
                                    class="btn btn-sm btn-outline-purple rounded-pill" data-bs-toggle="tooltip"
                                    data-bs-title="Descargar archivo">
                                    <i class="fas fa-eye"></i> Ver archivo
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-light text-center py-5 rounded-4 border">
                        <i class="far fa-sad-tear fa-3x text-muted mb-3 d-block"></i>
                        <p class="mb-0 text-secondary">No se encontraron artículos en el repositorio...</p>
                    </div>
                </div>
            @endforelse
        </div>

        <div wire:loading wire:target="search" class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>

        <!-- Paginación -->
        <div class="border-top py-3 px-3 d-flex align-items-center justify-content-center mt-4">
            {{ $articles->links() }}
        </div>
    </x-card-body>
</div>
