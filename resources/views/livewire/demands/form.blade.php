<x-modal title="Denuncia">
    <div class="col-md-12">
        <x-input-label title="Numero de denuncia" name="form.name" />
    </div>
    <div class="col-md-12">
        <x-input-label title="Denunciante" name="form.complainant" />
    </div>
    <div class="col-md-12">
        <x-input-label type="number" title="Telefono" name="form.phone" />
    </div>

    <div class="col-md-12">
        <div class="form-floating">
            <textarea class="form-control @error('form.description') is-invalid @enderror " wire:model="form.description"
                placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
            <label for="floatingTextarea2">Descripcion</label>
        </div>
        @error('form.description')
            <span class="text-danger"> {{ $message }}</span>
        @enderror

    </div>

    <div class="col-md-6">

        <div class="form-floating mb-3">
            <input type="date" class="form-control @error('form.date') is-invalid @enderror " wire:model="form.date"
                id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Fecha de denuncia</label>
            @error('form.date')
                <span class="text-danger"> {{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-floating">
            <select class="form-select @error('form.status') is-invalid @enderror " wire:model="form.status"
                id="floatingSelect" aria-label="Floating label select example">
                <option value="Elegir" disabled>Seleccion</option>
                <option value="Abierta">Abierta</option>
                <option value="Archivada">Archivada</option>
                <option value="Resulta">Resulta</option>
                <option value="Rechazada">Rechazada</option>
                <option value="En proceso">En proceso</option>
            </select>
            <label for="floatingSelect">Seleccione una opcion</label>
        </div>
        @error('form.status')
            <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>
</x-modal>
