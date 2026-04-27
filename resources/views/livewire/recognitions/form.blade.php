<x-modal title="Reconocimiento">
    <div class="col-md-12">
        <div class="form-floating">
            <input type="text" class="form-control @error('name')
            is-invalid @enderror" wire:model="name"
                id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Nombre</label>
        </div>
        @error('name')
            <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="form-floating">
            <select class="form-select @error('type') is-invalid @enderror " wire:model="type" id="floatingSelect"
                aria-label="Floating label select example">
                <option value="Elegir" disabled>Seleccion</option>
                <option value="Inscripcion">Condecoración de Ingreso</option>
                <option value="Canaston">Canastón navideño</option>
                <option value="15 years">Reconocimiento por 15 años</option>
                <option value="20 years">Premio a la trayectoria de 20 años</option>
                <option value="25 years">Distintivo por 25 años de trayectoria</option>
                <option value="30 years">Condecoración por 30 años</option>
                <option value="35 years">Reconocimiento especial por 35 años</option>
                <option value="40 years">Medalla al mérito por 40 años</option>
            </select>
            <label for="floatingSelect">Seleccione una opcion</label>
        </div>
        @error('type')
            <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-12">

        <div class="form-floating mb-3">
            <input type="date" class="form-control @error('date') is-invalid @enderror " wire:model="date"
                id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Fecha del evento</label>
            @error('date')
                <span class="text-danger"> {{ $message }}</span>
            @enderror
        </div>
    </div>

</x-modal>
