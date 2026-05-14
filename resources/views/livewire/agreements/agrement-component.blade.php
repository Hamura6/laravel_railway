<div>
    <x-card-header title="Convenios" name="Convenios" />
    <x-card-body>
        <x-slot name="header">
            <div class="col-sm-12 col-md-6 order-2 order-md-1">
                <x-search />
            </div>
            @can('Crear convenios')
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
        <div class="row g-1">
            @forelse ($agreements as  $agreement)
                <div class="col-md-4 p-3">
                    <div class="my-card-agrement  card w-100 h-100 ">
                        <div class="top-section" style="background-image: url('{{ $agreement->image_view }}');">
                            <div class="border border-0"></div>
                            <div class="icons">
                                <div class="logo text-white">ICAP</div>
                                <div class="social-media ">
                                    @foreach ($agreement->socials as $social)
                                        <a href="{{ $social->url }}" data-bs-toggle="tooltip"
                                            data-bs-title="{{ $social->type }}">
                                            <i class="{{ $social->icon }} text-white "></i>
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                        <div class="card-body ">
                            <h5 class="card-title text-white m-0">{{ $agreement->name }}</h5>
                        </div>
                        <div class="card-footer ">
                            <div class=" gap-2 d-md-flex justify-content-md-end">
                                @can('Eliminar convenios')
                                    <x-btn-delete id="{{ $agreement->id }}" />
                                @endcan
                                @can('Editar convenios')
                                    <a wire:target="changeStatus, delete"
                                        wire:loading.class="disabled pointer-events-none opacity-50"
                                        href="{{ route('agreement.form', $agreement->id) }}" type="button"
                                        class="btn-purple-circle outlined" data-bs-toggle="tooltip" data-bs-title="Editar">
                                        <i class="fas fa-edit fs-6"></i>
                                    </a>
                                @endcan
                              @if ($agreement->file)
                                  
                              <a href="{{ Storage::url('agreements/files/' . $agreement->file) }}" target="_blank"
                                class="btn-purple-circle" data-bs-toggle="tooltip"
                                data-bs-title="Descargar archivo">
                                <i class="fas fa-file fs-6"></i>
                            </a>
                            @endif
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
            {{ $agreements->links() }}
        </div>
    </x-card-body>
</div>
