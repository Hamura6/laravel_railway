<div>
    <x-card-header title="Lista de Afiliados" />
    <x-card-body>
        <x-slot name="header">
            <div class="col-sm-12 col-md-6 order-2 order-md-1">
                <x-search />
            </div>
            @can('affiliates.create')
                <div class="col-md-6 order-1 order-md-2 col-ms-12">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('register.affiliate') }}" wire:navigate class="btn btn-sm  btn-success">
                            <i class="far fa-file-alt "></i> Nuevo
                        </a>
                    </div>
                </div>
            @endcan
        </x-slot>
        <x-table-registers>
            <x-slot name="header">
                <th>Matrícula</th>
                <th>Nombres Completo</th>
                <th>C.I</th>
                <th>Estado</th>
                <th>Situación</th>
                <th>Correo Electrónico</th>
                <th>Edad</th>
                <th>Antigüedad</th>
                <th>Teléfono</th>
                <th>Opciones</th>
            </x-slot>
            <tbody wire:target="search" wire:loading.remove>
                @forelse ($affiliates as $affiliate )

                    <tr class="align-middle">
                        <td class="font-weight-normal">
                            {{ $affiliate->id }}
                        </td>
                        <td class="font-weight-normal">

                            {{ $affiliate->user->title }}
                            {{ $affiliate->user->full_name }}


                        </td>
                        <td class="font-weight-normal">
                            {{ $affiliate->user->ci }}
                        </td>
                        <td
                            class="text-center align-middle d-flex flex-column justify-content-center align-items-center">
                            <span
                                class="badge badge-sm border 
        {{ $affiliate->user->status == 'ENABLED' ? 'border-success text-success ' : 'border-danger text-danger' }}">
                                {{ __($affiliate->user->status) }}
                            </span>
                            <button
                                class="btn p-0 m-2 border-0 rounded-fill 
               d-flex align-items-center justify-content-center
               {{ $affiliate->user->status == 'ENABLED' ? 'bg-success text-white' : 'bg-light text-muted' }}"
                                style="width: 20px; height: 20px; font-size: 0.7rem;"
                                onclick="Question({{ $affiliate->user->id }}, 'Desea bloquear al afiliado del sistema?', 'changeStatus')"
                                wire:loading.attr="disabled" data-toggle="tooltip" data-placement="top"
                                title="{{ $affiliate->user->status == 'ENABLED' ? 'Bloquear' : 'Habilitar' }}">
                                <i
                                    class="fas {{ $affiliate->user->status == 'ENABLED' ? 'fa-check' : 'fa-circle' }}"></i>
                            </button>
                        </td>
                        <td class="text-center">
                            {{ $affiliate->status }}
                        </td>
                        <td>
                            {{ $affiliate->user->email }}
                        </td>

                        <td align="center">
                            {{ $affiliate->user->age }}
                        </td>
                        <td>
                            {{ $affiliate->antique }}
                        </td>
                        <td class="align-middle text-center">
                            @foreach ($affiliate->user->phones as $phone)
                                <span class="text-secondary text-sm">{{ $phone->number }} </span><br>
                            @endforeach
                        </td>
                        <td>
                            <div class="d-flex flex-row justify-content-center align-items-center gap-1">
                                @can('affiliates.reset.password')
                                    <button type="button" wire:target="changeStatus, delete, edit,resetPassword"
                                        onclick="Question({{ $affiliate->user->id }},'Desea bloquear al afiliado del sistema?','resetPassword')"
                                        wire:loading.attr="disabled" {{-- wire:click="resetPassword({{ $user->id }})" --}} class="btn btn-warning-circle"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        data-bs-title="Restablecer contrasena">
                                        <i class="fas fa-key fs-6"></i>
                                    </button>
                                @endcan
                                @can('affiliates.edit')
                                    <a href="{{ route('register.affiliate', $affiliate->id) }}" wire:navigate
                                        type="button" class="btn btn-uc-circle" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" data-bs-title="Editar afiliado">
                                        <i class="fas fa-edit fs-6"></i>
                                    </a>
                                @endcan
                                @can('affiliates.delete')
                                    <x-btn-delete id="{{ $affiliate->user->id }}" />
                                @endcan
                                <a type="button" href="{{ route('form.affiliate', $affiliate->id) }}"
                                    class="btn btn-primary-circle" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    data-bs-title="Ver detalle">
                                    <i class="fas fa-eye fs-6"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="14" class="text-center">
                            <i class="far fa-sad-tear"></i> No se encontraron registros
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </x-table-registers>
        <div class="border-top py-3 px-3 d-flex align-items-center">
            {{ $affiliates->links() }}
        </div>
    </x-card-body>
</div>
