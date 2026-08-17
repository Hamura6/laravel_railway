<x-modal title="Pago">
    <div class="col-md-12">
        <div class="form-floating">
            <select class="form-select @error('types') is-invalid @enderror " wire:model="types" id="types"
                aria-label="Floating label select example">
                <option value="cash">Efectivo</option>
                <option value="transfer">Transferencia</option>
            </select>
            <label for="types">Tipo de pago</label>
        </div>
        @error('types')
            <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>
    
    <div class="col-md-12">
        <label for="discountAmount">Descuento en %</label>
        <div class="input-group ">
            <input type="number" wire:model="discountAmount" id="discountAmount"
                class="form-control @error('discountAmount') is-invalid  @enderror" placeholder="Descuento de Aportes"
                aria-label="'discountAmount'" aria-describedby="name-addon">
        </div>
        @error('discountAmount')
            <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-12">
            <label for="cant">Monto aporte </label>
            <div class="input-group ">
                <input type="number" wire:model="cant" id="cant"
                    class="form-control @error('cant') is-invalid  @enderror"
                    placeholder="Pago Aportes"  aria-label="'cant'"
                    aria-describedby="name-addon">
            </div>
            @error('cant')
                <span class="text-danger"> {{ $message }}</span>
            @enderror
        </div>

    <div class="col-md-6">
        <div class="form-floating mb-3">
            <input type="date" disabled class="form-control @error('dateTo') is-invalid @enderror " wire:model="dateTo"
                id="dateTo">
            <label for="floatingInput">Fecha desde</label>
            @error('dateTo')
                <span class="text-danger"> {{ $message }}</span>
            @enderror
        </div>
    </div>
        <div class="col-md-6">

        <div class="form-floating mb-3">
            <input type="date"To disabled class="form-control @error('dateFor') is-invalid @enderror " wire:model="dateFor"
                id="dateFor" >
            <label for="floatingInput">Fecha hasta</label>
            @error('dateFor')
                <span class="text-danger"> {{ $message }}</span>
            @enderror
        </div>
    </div>


</x-modal>
