<div>
    <div class="col-12">
        <x-card-header title="Gestión de usuarios" />
        <x-card-body>
            <x-slot name="header">
                <div class="col-sm-12 col-md-6 order-2 order-md-1">
                    <x-search />
                </div>
                <div class="col-md-6 order-1 order-md-2 col-ms-12">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        @can('users.create')
                            <a href="{{ route('user.create') }}" wire:navigate
                                wire:loading.class="disabled pointer-events-none opacity-50" type="button"
                                class="btn btn-sm  btn-success">
                                <i class="far fa-file-alt fs-6"></i> Nuevo
                            </a>
                        @endcan
                    </div>
                </div>
                {{--                 <div class="col-md-6 order-1 order-md-2 col-ms-12">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button onclick="hola()" type="button" class="btn btn-sm  btn-success  mb-0">
                            <i class="fa-solid fa-circle-plus fs-6"></i> Nueasdfasdvo
                        </button>

                    </div>
                </div> --}}

            </x-slot>
            <x-table-registers>
                <x-slot name="header">

                    <th>#</th>
                    <th>C.I</th>
                    <th>Estado</th>
                    <th>Rol</th>
                    <th>Correo Electrónico</th>
                    <th>Opciones
                    </th>
                </x-slot>
                <tbody wire:loading.remove wire:target="search">

                    @forelse ($users as $user)
                        <tr class="align-middle">
                            <td>
                                {{ $loop->iteration }}
                            </td>


                            <td class="text-sm font-weight-normal">
                                {{ $user->ci }}
                            </td>

                            <td class="text-center d-flex flex-column justify-content-center align-items-center">
                                <!-- Badge de estado -->
                                <span
                                    class="badge rounded-pill 
        {{ $user->status == 'ENABLED' ? 'text-bg-success' : 'text-bg-danger' }}">
                                    {{ $user->status }}
                                </span>
                                @can('users.block')
                                    <!-- Botón centrado debajo del badge -->
                                    <button
                                        class="btn p-0 m-2 border-0 rounded-fill 
                                d-flex align-items-center justify-content-center
                                {{ $user->status == 'ENABLED' ? 'bg-success text-white' : 'bg-light text-muted' }}"
                                        style="width: 20px; height: 20px; font-size: 0.7rem;"
                                        onclick="Question({{ $user->id }}, 'Desea bloquear al usuario del sistema?', 'changeStatus')"
                                        wire:loading.attr="disabled" data-toggle="tooltip" data-placement="top"
                                        title="{{ $user->status == 'ENABLED' ? 'Bloquear' : 'Habilitar' }}">
                                        <i class="fas {{ $user->status == 'ENABLED' ? 'fa-check' : 'fa-circle' }}"></i>
                                    </button>
                                @endcan
                            </td>

                            <td class="text-center">
                                <span
                                    class="badge bg-transparent text-dark border border-dark border-1">{{ $user->name_role }}</span>
                            </td>
                            <td>

                                <span class="text-sm font-weight-normal">{{ $user->email }}</span>
                            </td>

                            <td>
                                <div class="d-flex flex-row justify-content-center align-items-center gap-1">
                                    @can('users.edit')
                                        <a class="btn-rc-circle" wire:target="changeStatus, delete"
                                            wire:loading.class="disabled pointer-events-none opacity-50"
                                            href="{{ route('user.create', $user->id) }}"><i class="fas fa-edit"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                data-bs-title="Editar"></i></a>
                                    @endcan
                                    @can('users.delete')
                                        <x-btn-delete id="{{ $user->id }}" />
                                    @endcan

                                    @can('users.reset.password')
                                        <button type="button" wire:target="changeStatus, delete, edit,resetPassword"
                                            onclick="Question({{ $user->id }},'Desea bloquear al usuario del sistema?','resetPassword')"
                                            wire:loading.attr="disabled" {{-- wire:click="resetPassword({{ $user->id }})" --}} class="btn-warning-circle"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            data-bs-title="Restablecer contrasena">
                                            <i class="fas fa-key "></i>
                                        </button>
                                    @endcan
                                </div>

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

            <div class="border-top py-3 px-3 d-flex align-items-center">
                {{ $users->links() }}
            </div>
        </x-card-body>
    </div>
</div>
