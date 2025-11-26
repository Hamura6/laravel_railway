<div>
    <x-card-header title="Noticias y comunicados" name="Noticias" />
    <x-card-body>
        <x-slot name="header">
            <div class="col-sm-12 col-md-6 order-2 order-md-1">
                <x-search />
            </div>
            @can('notice.create')
                <div class="col-md-6 order-1 order-md-2 col-ms-12">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('news.form') }}" wire:navigate
                            wire:loading.class="disabled pointer-events-none opacity-50" type="button"
                            class="btn btn-sm  btn-success">
                            <i class="far fa-file-alt fs-6"></i> Nuevo
                        </a>
                    </div>
                </div>
            @endcan

        </x-slot>
        <style>
        </style>

        <div class="row g-2">
            @forelse ($news as  $new)
                <div class="col-md-4 py-2 px-3">
                    <div class="card h-100 news-card"
                        style="border-radius: 1.5rem; overflow: hidden;   box-shadow: 12px 12px 0px rgba(0, 0, 0, 0.1);">
                        <div class="position-relative">
                            <img src="{{ $new->image_view }}" class="card-img-top" alt="..."
                                style="height: 200px; object-fit: cover;">
                            <div class="position-absolute top-0 end-0 text-white p-3"
                                style="font-size: 15px;font-weight: 700;line-height: 30px; z-index: 10;">
                                <i class="far fa-calendar-alt me-1"></i>
                                {{ $new->created_at->format('d M, Y') }}
                            </div>
                        </div>
                        <div class="card-body p-2">
                            <h5 class="card-title mb-1">{{ $new->title }}</h5>
                            <p class="card-text text-muted ">
                                {{ Str::limit($new->description, 130) }}
                            </p>
                        </div>
                        <div class="card-footer m-0">
                            <div class="gap-2 d-md-flex justify-content-md-end">
                                @can('notice.delete')
                                    <x-btn-delete id="{{ $new->id }}" />
                                @endcan
                                @can('notice.edit')
                                    <a wire:target="changeStatus, delete"
                                        wire:loading.class="disabled pointer-events-none opacity-50"
                                        href="{{ route('news.form', $new->id) }}" type="button" class="btn-uc-circle"
                                        data-bs-toggle="tooltip" data-bs-title="Editar">
                                        <i class="fas fa-edit fs-6"></i>
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
            {{ $news->links() }}
        </div>
    </x-card-body>
</div>
