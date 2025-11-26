@props([
    'name' => 'name',
    'title' => 'Nombre',
])
<div class="form-group my-0">
    <label for="exampleFormControlSelect1">{{ $title }}</label>
    <select class="form-select @error($name) is-invalid  @enderror" aria-label="Default select example" 
        id="exampleFormControlSelect1" wire:model="{{ $name }}">
        <option value="Elegir" disabled>Seleccione una opcion</option>
        {{ $slot }}
    </select>
    @error($name)
        <span class="text-danger"> {{ $message }}</span>
    @enderror

</div>
