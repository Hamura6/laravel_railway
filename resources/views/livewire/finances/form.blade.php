<x-modal title="Aporte">
    <div class="col-md-12">
        <x-input-label title="Nombre Afiliado" name='name' />
    </div>
    <div class="col-md-12">
        <div class="form-floating">
            <select class="form-select @error('category') is-invalid @enderror " wire:model.live="category" id="category"
                aria-label="Floating label select example">
                <option value="E" selected>Elegir</option>
                <option value="Q">Cantidad</option>
                <option value="A">Monto</option>
            </select>
            <label for="category">Modo de pago</label>
        </div>
        @error('category')
            <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>

    <div class="col-md-12">
        <div class="form-floating">
            <select class="form-select @error('form.type') is-invalid @enderror " wire:model="form.type" id="form.type"
                aria-label="Floating label select example">
                <option value="cash">Efectivo</option>
                <option value="transfer">Transferencia</option>
            </select>
            <label for="form.type">Tipo de pago</label>
        </div>
        @error('form.type')
            <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>
@if ($category!='E')
    
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
    @if ($category == 'Q')
        <div class="col-md-12">
            <label for="cant"> Cantidad de Aportes </label>
            <div class="input-group ">
                <input type="number" wire:model.live="cant" id="cant"
                    class="form-control @error('cant') is-invalid  @enderror"
                    placeholder="Cantidad de Aportes"  aria-label="'cant'"
                    aria-describedby="name-addon">
            </div>
            @error('cant')
                <span class="text-danger"> {{ $message }}</span>
            @enderror
        </div>
    @else
        <div class="col-md-12">
            <label for="inputCant"> Monto a pagar </label>
            <div class="input-group ">
                <input type="number" wire:model.defer="inputCant" id="inputCant"
                    class="form-control @error('inputCant') is-invalid  @enderror"
                    placeholder="Monto a pagar" aria-label="'inputCant'"
                    aria-describedby="name-addon">
            </div>
            @error('inputCant')
                <span class="text-danger"> {{ $message }}</span>
            @enderror
        </div>
    @endif
@endif

    <div class="col-md-12">
        <label for="amount">Total a pagar </label>
        <div class="input-group ">
            <div class="input-group input-group-sm ms-auto me-2">
                <span class="input-group-text text-body">
                    <i class="fas fa-money-bill-wave"></i>
                </span>
                <input type="text" wire:model="amount" id="amount" disabled class="form-control form-control-sm"
                    placeholder="Buscar">

            </div>

        </div>
    </div>
    <div x-data="{
        amount: @entangle('amount'),
        discount: @entangle('discountAmount')
    }">
        <template x-if="discount && Number(discount) > 0">
            <div class="alert alert-primary mt-2 p-0 px-2" role="alert">
                <span
                    x-text="
                    (() => {
                        let a = Number(amount) || 0;
                        let d = Math.min(Number(discount) || 0, 100); 
                        let total = a - (a * d / 100);
                        if (total < 0) total = 0; // Evita resultados negativos
                        return total.toFixed(2) + ' Bs. Descuento aplicado ' + d + '%';
                    })()
                ">
                </span>
            </div>
        </template>
    </div>


</x-modal>
