<x-modal title="Tarifa">
    <div class="col-md-12">
        <x-input-label name='form.name' title="Nombre de Pago" />
    </div>
    <div class="col-md-6">
        <x-input-label name='form.amount' title="Costo de Pago" />
    </div>
    <div class="col-md-6">
        <x-select name='form.type' title="Tipo de pago">
            <option value="single_payment">Pago único</option>
            <option value="installments">Pago en cuotas</option>
        </x-select>
    </div>
</x-modal>
