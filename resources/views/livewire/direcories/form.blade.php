<x-modal title="Directorio">
    <div class="col-md-12">
        <div class="form-floating">
            <input type="text" class="form-control @error('name')
            is-invalid @enderror" wire:model="name"
                id="floatingInput" placeholder="name@example.com" disabled>
            <label for="floatingInput">Affiliado</label>
        </div>
        @error('name')
            <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="form-floating">
            <select class="form-select @error('rol') is-invalid @enderror " wire:model="rol" id="floatingSelect"
                aria-label="Floating label select example">
                <option value="Elegir" disabled>Seleccion</option>
                @foreach ($roles as $role )
                <option value="{{ $role->id }}" >{{ $role->name }}</option>
                @endforeach
            </select>
            <label for="floatingSelect">Seleccione una opcion</label>
        </div>
        @error('rol')
            <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>
</x-modal>
