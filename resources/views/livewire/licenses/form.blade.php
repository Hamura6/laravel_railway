<x-modal title="Licencia">
    <div class="col-md-12">
        <div class="form-floating">
            <input type="text" class="form-control @error('affiliate_id')
            is-invalid @enderror" wire:model="affiliate_id"
                id="affiliate_id" placeholder="Matricula de Afiliado">
            <label for="affiliate_id">Mátricula</label>
            @error('affiliate_id')
                <span class="text-danger"> {{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-floating">
            <input type="date" class="form-control @error('date')
            is-invalid @enderror" wire:model="date"
                id="date" placeholder="Fecha">
            <label for="date">Licencia hasta </label>
            @error('date')
                <span class="text-danger"> {{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-floating">
            <textarea  style="height: 100px" class="form-control @error('description')
            is-invalid @enderror" wire:model="description"
                id="description" placeholder="Descripcion" cols="30" rows="20"></textarea>
            <label for="description">Descripción</label>
            @error('description')
                <span class="text-danger"> {{ $message }}</span>
            @enderror
        </div>
    </div>
</x-modal>
