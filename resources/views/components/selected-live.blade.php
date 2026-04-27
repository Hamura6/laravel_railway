@props([
    'name' => 'name',
    'title' => 'Nombre',
])
<div class="input-group">
    <label class="input-group-text" for="inputGroupSelect01">{{ $title }}</label>
    <select class="form-select" id="inputGroupSelect01" wire:model.live="{{ $name }}">
        <option value="" disabled>Seleccione</option>
        {{ $slot }}
    </select>
</div>
