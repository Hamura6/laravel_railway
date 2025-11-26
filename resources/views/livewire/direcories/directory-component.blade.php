<div>
    <div class="col-12">
        <x-card-header title="Gestion de directorio" name="Directorio" />


        <style>
            /* From Uiverse.io by mohanad_2899 */
            .cards {
                height: auto;
                width: fit-content;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap: 0.5em;
                transition: all 200ms ease-in-out;
            }

            .card-container {
                --font-color: hsl(0, 0%, 15%);
                font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
                position: relative;
                width: 100%;
                height: auto;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                align-items: right;
                padding: 0.5em 1em;
                border-radius: 0.5em;
                cursor: pointer;
                transition: all 200ms ease-in-out;
            }

            .card-container p {
                font-weight: 600;
            }

            .card-container:hover {
                transform: scale(1.05);
                z-index: 1;
            }

            .cards:hover>.card-container:not(:hover) {
                filter: blur(5px);
            }
        </style>
        <!-- From Uiverse.io by mohanad_2899 -->


        <div class="row g-1">
            <div class="col-md-8">
                <x-card-body>
                    <x-slot name="header">

                        <h5 class="py-0">Directorio Actual</h5>
                        <div class="col-12 col-md-12 d-flex justify-content-end">
                            <div class="input-group">
                                <label class="input-group-text" for="inputGroupSelect01">Seleccione un opcion</label>
                                <select class="form-select" id="inputGroupSelect01"
                                    wire:model.live="type">
                                    <option value="" disabled>Seleccione</option>
                                    <option value="1">Directorio</option>
                                    <option value="0">Tribunal de Honor</option>
                                </select>
                            </div>
                        </div>
                    </x-slot>
                    <x-table-registers>
                        <x-slot name="header">

                            <th>#</th>
                            <th>Matricula</th>
                            <th>Afiliado</th>
                            <th>Rol</th>
                            <th>Opciones
                            </th>
                        </x-slot>
                        <tbody wire:loading.remove wire:target="search">

                            @forelse ($directories as $directory)
                                <tr class="align-middle">
                                    <td class="font-weight-normal">
                                        {{ $loop->iteration }}
                                    </td>


                                    <td>
                                        {{ $directory->affiliate_id }}
                                    </td>



                                    <td>
                                         {{$directory->affiliate->user->title .' '. $directory->affiliate->user->full_name }} 
                                    </td>
                                    <td class="text-center">
                                        <span
                                            class="badge bg-transparent text-dark border border-dark border-1">{{ $directory->name }}</span>
                                    </td>

                                    <td class="text-center">
                                        <x-btn-delete id="{{ $directory->id }}" />
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" align="center">
                                        <h5>
                                            <i class="far fa-sad-tear"></i>

                                            No se encontraron registros...
                                        </h5>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </x-table-registers>
                </x-card-body>

            </div>
            <div class="col-md-4">
                <x-card-body>
                    <x-slot name="header">
                        <div class="col-sm-12 ">
                            <div class="input-group input-group-sm ">
                                <span class="input-group-text text-body">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" wire:model.live.debounce.1000ms="toSearch"
                                    class="form-control form-control-sm" placeholder="Buscar">
                            </div>

                        </div>

                    </x-slot>

                    <div class="cards w-100">
                        @forelse ($affiliates as $affiliate)
                            <div class="card-container border border-2 rounded-3 border-dark text-dark"
                                wire:click="selected({{ $affiliate->id }})" style="                background: white !important
">
                                <p class="mb-0"><strong>Matricula:</strong>{{ $affiliate->id }}</p>
                                <p class="mb-0"><strong>Nombre:</strong> {{ $affiliate->user->full_name }}</p>
                            </div>
                        @empty

                            <h5>
                                <i class="far fa-sad-tear"></i>

                                No se encontraron registros...
                            </h5>
                        @endforelse
                    </div>


                    <div class="border-top py-3 px-3 d-flex align-items-center">
                        {{ $affiliates->links() }}
                    </div>
                </x-card-body>
            </div>
        </div>
    </div>
    @include('livewire.direcories.form')
</div>
