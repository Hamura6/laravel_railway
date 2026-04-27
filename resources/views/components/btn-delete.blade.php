@props(['id' => 0])
<button type="button" wire:target="changeStatus, delete, edit" wire:loading.attr="disabled"
    onclick="Confirm({{ $id }})" class="btn-dc-circle" data-bs-toggle="tooltip" data-bs-placement="bottom"
    data-bs-title="Eliminar">
    <i class="fas fa-trash "></i>
</button>
