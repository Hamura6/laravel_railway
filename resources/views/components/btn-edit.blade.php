@props(['id' => 0])
<button type="button" wire:target="changeStatus, delete, edit" wire:loading.attr="disabled"
    wire:click="edit({{ $id }})" class="btn-uc-circle" data-bs-toggle="tooltip"
    data-bs-title="Editar">
    <i class="fas fa-edit fs-6"></i>
</button>
