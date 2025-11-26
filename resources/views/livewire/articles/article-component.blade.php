<div>
    <x-card-header title="Articulos" name="Articulo" />
    <x-card-body>
        <x-slot name="header">
            <div class="col-sm-12 col-md-6 order-2 order-md-1">
                <x-search />
            </div>
            @can('articles.create')
                <div class="col-md-6 order-1 order-md-2 col-ms-12">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('article.form') }}" wire:navigate
                            wire:loading.class="disabled pointer-events-none opacity-50" type="button"
                            class="btn btn-sm  btn-success  mb-0">
                            <i class="far fa-file-alt fs-6"></i> Nuevo
                        </a>
                    </div>
                </div>
            @endcan

        </x-slot>
        <x-table-registers>
            <x-slot name="header">

                <th>#</th>
                <th>Portada</th>
                <th>Titulo</th>
                <th>Descripcion</th>
                <th>Opciones</th>
            </x-slot>
            <tbody wire:target='search' wire:loading.remove>
                @forelse ($articles as  $article)
                    <tr class="align-middle">
                        <td class="font-weight-normal">
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            <img src="{{ $article->image_view }}" alt="Imagen del artículo" class="rounded-circle"
                                style="width: 50px; height: 50px; object-fit: cover;">
                        </td>
                        <td>
                            {{ $article->title }}
                        </td>
                        <td class="text-secondary ">
                            {{ $article->description }}
                        </td>
                        <td class="text-center" align="center">
                            @can('articles.delete')
                                <x-btn-delete id="{{ $article->id }}" />
                            @endcan
                            @can('articles.edit')
                                <a wire:target="delete" wire:loading.class="disabled pointer-events-none opacity-50"
                                    href="{{ route('article.form', $article->id) }}" type="button" class="btn-uc-circle"
                                    data-bs-toggle="tooltip" data-bs-title="Editar">
                                    <i class="fas fa-edit fs-6"></i>
                                </a>
                            @endcan
                            <a href="{{ Storage::url('articles/files/' . $article->file) }}" download
                                class="btn-success-circle outlined" data-bs-toggle="tooltip"
                                data-bs-title="Descargar archivo">
                                <i class="fas fa-download fs-6"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" align="center">
                            <h5>
                                <i class="far fa-sad-tear"></i>

                                No se encontraron registros...
                            </h5>
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </x-table-registers>
        <div class="border-top py-3 px-3 d-flex align-items-center">
            {{ $articles->links() }}
        </div>
    </x-card-body>
</div>
