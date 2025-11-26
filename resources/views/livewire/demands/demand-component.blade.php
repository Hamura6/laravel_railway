<div>
    <x-card-header title="Denuncias de afiliados" name="Denuncia" />
    <x-card-body>
        <x-slot name="header">
            <div class="col-sm-12 col-md-6 order-2 order-md-1 ">
                <x-search />
            </div>
            <div class="col-md-4 col-ms-12 order-1 order-md-2 offset-md-2">

                <x-selected-live title="Seleccione el estado" name='select'>
                    <option value="">Todos</option>
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                    <option value="Exento">Exento</option>
                    <option value="Licencia">Licencia</option>
                    <option value="Fallecido">Fallecido</option>
                </x-selected-live>
            </div>


        </x-slot>
        <x-table-registers>
            <x-slot name="header">
                <th>Matricula</th>
                <th>Nombre Completo</th>
                <th>C.I</th>
                <th>cantidad <br> de denuncia</th>
                <th>Estado</th>
                <th>Genero</th>
                <th>Edad</th>
                <th>Telefono</th>
                <th>Opciones</th>
            </x-slot>
            <tbody wire:target="search" wire:loading.remove>
                @forelse ($affiliates as $affiliate )
                    <tr class="align-middle">
                        <td class="font-weight-normal">
                            {{ $affiliate->id }}
                        </td>
                        <td class="font-weight-normal">
                            {{ $affiliate->user->full_name }}

                        </td>
                        <td class=" font-weight-normal">
                            {{ $affiliate->user->ci }}
                        </td>
                        <td align="center" class="text-secondary">
                            {{ $affiliate->demands->count() }}
                        </td>
                        <td align="center">
                            <span class="badge rounded-pill text-dark  border border-dark border-1">
                                {{ $affiliate->status }}
                            </span>
                        </td>
                        <td class="text-secondary">
                            {{ $affiliate->user->gender }}
                        </td>
                        <td align="center" class="text-secondary">
                            {{ $affiliate->user->age }}
                        </td>
                        <td align="center" class="text-secondary">
                            @foreach ($affiliate->user->phones as $phone)
                                {{ $phone->number }} <br>
                            @endforeach
                        </td>
                        <td class="text-center">
                            @can('demands.view')
                                <a href="{{ route('demands.management', $affiliate->id) }}" wire:navigate type="button"
                                    class="btn-purple-circle">
                                    <i class="fas fa-eye fs-6"></i>
                                </a>
                            @endcan
                            @can('demands.view')
                                <a href="{{ route('demands.details', $affiliate->id) }}" wire:navigate type="button"
                                    class="btn-uc-circle">
                                    <i class="fas fa-edit fs-6"></i>
                                </a>
                            @endcan
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
            {{ $affiliates->links() }}
        </div>
    </x-card-body>
</div>
