<x-modal title="Directorio">
    <div class="col-md-12">
        <div class="form-floating">
            <input type="text" class="form-control @error('name')
            is-invalid @enderror" wire:model="name" name="name" autocomplete="name"
                id="name" placeholder="name" >
            <label for="name">Nombre de Cargo</label>
        </div>
        @error('name')
            <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="form-floating">
            <select class="form-select @error('is_directory') is-invalid @enderror " wire:model="is_directory" id="is_directory"
                aria-label="Floating label select">
                <option value="Elegir" disabled>Seleccione el tipo</option>
                <option value='1'>Directorio</option>
                <option value='0'>Tribunal de Honor</option>
            </select>
            <label for="is_directory">Seleccione una opcion</label>
        </div>
        @error('is_directory')
            <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>



    <div class="col-md-12">
        <div class="form-floating">
            <input type="numeric" class="form-control @error('level')
            is-invalid @enderror" wire:model="level"
                id="level" placeholder="level" >
            <label for="level">Nivel del Cargo</label>
        </div>
        @error('level')
            <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>

</x-modal>
