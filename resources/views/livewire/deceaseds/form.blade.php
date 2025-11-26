<x-modal title="Licencia">
    <div class="col-md-12">
        <div class="form-floating">
            <input type="text" class="form-control @error('affiliate_id')
            is-invalid @enderror" wire:model="affiliate_id"
                id="floatingInput" placeholder="Matricula">
            <label for="floatingInput">Matricula</label>
        </div>
        @error('affiliate_id')
            <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="form-floating">
            <input type="date" class="form-control @error('date')
            is-invalid @enderror" wire:model="date"
                id="floatingInput" placeholder="Fecha">
            <label for="floatingInput">Fecha de deceso</label>
        </div>
        @error('date')
            <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="form-floating">
            <textarea type="date" class="form-control @error('description')
            is-invalid @enderror" wire:model="description"
                id="floatingInput" placeholder="Description" style="height: 100px" cols="30" rows="20"></textarea>
            <label for="floatingInput">Descripcion</label>
        </div>
        @error('description')
            <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="form-floating">
            <select class="form-select @error('mausoleum') is-invalid @enderror " wire:model="mausoleum" id="floatingSelect"
                aria-label="Floating label select example">
                <option value="Elegir" disabled>Seleccion</option>
                <option value="Si">Si</option>
                <option value="No">No</option>
            </select>
            <label for="floatingSelect">Mausoleo</label>
        </div>
        @error('mausoleum')
            <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>
</x-modal>
