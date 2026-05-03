<div>

    <style>
        .my-card {
            position: relative;
            height: 254px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            border-radius: 12px;
        }

        .my-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(315deg, #03a8f456, #ff0058);
            opacity: 0;
            transition: opacity 0.2s ease;
            z-index: 1;
            pointer-events: none;
        }

        .my-card:hover::before {
            opacity: 1;
        }

        .my-card img {
            position: absolute;
            z-index: 3;
            scale: 0.9;
            opacity: 0.9;
            transition: 0.5s;
        }

        .my-card:hover img {
            scale: 0.5;
            opacity: 0.5;
            transform: translateY(-70px);
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
                    <div class="my-card w-100 position-relative">
                            <img src="{{ $photo->image }}"  alt="image" loading="lazy">
                        <div class="content-my">

                            <div class="position-absolute bottom-0  d-flex gap-2  justify-content-center  ">
                                <button type="button" wire:target="changeStatus, delete, edit"
                                    wire:loading.attr="disabled" onclick="Confirm({{ $photo->id }})"
                                    class="btn-dc-circle">
                                    <i class="fas fa-trash "></i>
                                </button>

                                <a class="btn-success-circle outlined" href="{{ $photo->image_download }}" download>
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
