<x-modal title="Tramite">
    <div class="col-md-12">
        <livewire:affiliate-selected wire:model="form.affiliate_id" />
        @error('form.affiliate_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="form-group my-0">
            <label for="exampleFormControlSelect1">Seleccione</label>
            <select class="form-select @error('form.fee_id')
                is-invalid
                @enderror "
                aria-label="Default select example" id="exampleFormControlSelect1"
                wire:change="selected($event.target.value)" wire:model.live="form.fee_id">
                <option value="Elegir" disabled>Seleccione</option>
                @foreach ($fees as $fee)
                    <option value="{{ $fee->id }}">{{ $fee->name }} </option>
                @endforeach
            </select>
            @error('form.fee_id')
                <span class="text-danger"> {{ $message }}</span>
            @enderror
        </div>


    </div>
    <div x-data="{
        type: @entangle('type'),
        discount: @entangle('discountAmount')
    }">
        <template x-if="type === 'installments' && Number(discount) === 0">
            <div class="col-md-12">
                <x-input-label title="monto a pagar" name='pay' />
            </div>
        </template>
    </div>

    <div class="col-md-12">
        <x-input-label title="Aplicar descuento %" name='discountAmount' />
    </div>
    <div class="col-md-12">
        <div class="form-floating">
            <select class="form-select @error('form.type') is-invalid @enderror " wire:model="form.type"
                id="floatingSelect" aria-label="Floating label select example">
                <option value="cash">Efectivo</option>
                <option value="transfer">Transferencia</option>
            </select>
            <label for="floatingSelect">Tipo de pago</label>
        </div>
        @error('form.type')
            <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>

    <div class="col-md-12">
        <label>Total a pagar </label>
        <div class="input-group ">
            <div class="input-group input-group-sm ms-auto me-2">
                <span class="input-group-text text-body">
                    <i class="fa-solid fa-circle-dollar-to-slot"></i>
                </span>
                <input type="text" wire:model="form.amount" disabled class="form-control form-control-sm"
                    placeholder="Buscar">

            </div>

        </div>
        <div x-data="{
            amount: @entangle('form.amount'),
            discount: @entangle('discountAmount')
        }">
            <template x-if="discount && Number(discount) > 0">
                <div class="alert alert-primary mt-2 p-0 px-2" role="alert">
                    <span
                        x-text="(Number(amount) - (Number(amount) * Number(discount) / 100)).toFixed(2) 
                + ' Bs. Descuento aplicado ' + discount + '%'"></span>
                </div>
            </template>
        </div>
    </div>
</x-modal>
