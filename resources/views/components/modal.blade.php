@props([
    'title' => 'rol',
])
<div wire:ignore.self class="modal fade" id="myModal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center py-2">
                <h5 class="modal-title font-weight-bolder mb-0 text-dark" id="exampleModalLabel">
                    {{ $this->form->id ?? $this->id ? 'Actualizar' : 'Registrar' }} | {{ $title }}
                </h5>
                <div class="spinner-border ms-auto" wire:loading role="status" style="width: 1.5rem; height: 1.5rem;">
                    <span class="visually-hidden">Cargando...</span>
                </div>
            </div>
            <div class="modal-body">
                <form action="">

                    <div class="row g-1">
                        {{ $slot }}

                    </div>
                </form>
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-secondary" wire:loading.attr="disabled" wire:click="clear()"
                    data-bs-dismiss="modal"> <span wire:loading.remove>
                        <i class='fas fa-ban fs-6'></i>
                    </span>
                    <span wire:loading>
                        <i class="fas fa-spinner fa-spin"></i>
                    </span> Cancelar</button>
                @if ($this->form->id ?? $this->id)
                    <button type="button" wire:loading.attr="disabled" class="btn btn-primary" wire:click="update()">
                        <span wire:loading.remove>
                            <i class="fas fa-paste fs-6"></i>
                        </span>
                        <span wire:loading>
                            <i class="fas fa-spinner fa-spin"></i>
                        </span> Actualizar</button>
                @else
                    <button type="button" wire:loading.attr="disabled" class="btn btn-dark" wire:click="store()">
                        <span wire:loading.remove>
                            <i class="fas fa-save fs-6"></i>
                        </span>
                        <span wire:loading>
                            <i class="fas fa-spinner fa-spin"></i>
                        </span> Guardar</button>
                @endif
            </div>
        </div>
    </div>
</div>
