<div>

    <style>
        .my-card {
            position: relative;
            aspect-ratio: 4/3;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            border-radius: 12px;
            border: 0.5px solid rgba(0, 0, 0, 0.1);
            background: #f1f1f0;
        }

        .my-card img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 1;
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1), filter 0.4s ease;
        }

        .my-card:hover img {
            transform: scale(1.06);
            filter: brightness(0.4);
        }

        .my-card .content-my {
            position: absolute;
            z-index: 3;
            bottom: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            transform: scale(0);
            transition: 0.5s;
        }

        .my-card:hover .content-my {
            transform: scale(1);
            bottom: 25px;
        }
    </style>

    <x-card-header title="Administracion de fotografias" name="Fotografias" />

    <x-card-body>
        <x-slot name="header">
            <h4><strong>{{ $this->title }} | {{ $this->date }}</strong></h4>
        </x-slot>
        <div class="row g-2">
            @forelse ($photos as $photo)
                <div class="col-md-4">
                    <div class="my-card w-100">
                        <img src="{{ $photo->image }}" alt="image" loading="lazy">
                        <div class="content-my">
                            <div class="position-absolute bottom-0 d-flex gap-2 justify-content-center">

                                <a class="btn-info-circle outlined" href="{{ $photo->image }}" target="_blank"
                                    rel="noopener" title="Ver imagen">
                                    <i class="fas fa-expand"></i>
                                </a>
                                @can('Editar eventos')
                                    <button type="button" wire:target="changeStatus, delete, edit"
                                        wire:loading.attr="disabled" onclick="Confirm({{ $photo->id }})"
                                        class="btn-dc-circle" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @endcan
                                <a class="btn-success-circle outlined" href="{{ $photo->image_download }}" download
                                    title="Descargar">
                                    <i class="fas fa-download"></i>
                                </a>

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
            {{ $photos->links() }}
        </div>
    </x-card-body>
</div>
