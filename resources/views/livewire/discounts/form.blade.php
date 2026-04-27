<x-modal title="Descuento">
    <div class="col-md-6">
        <div class="form-floating mb-3">
            <input type="date" class="form-control @error('start_date') is-invalid @enderror " wire:model="start_date"
                id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Desde</label>
        </div>
        @error('start_date')
            <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-6">
        <div class="form-floating mb-3">
            <input type="date" class="form-control @error('end_date') is-invalid @enderror " wire:model="end_date"
                id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Hasta</label>
        </div>
        @error('end_date')
            <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="form-floating">
            <input type="text" class="form-control @error('amount')
            is-invalid @enderror"
                wire:model="amount" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Monto de descuento en %</label>
        </div>
        @error('amount')
            <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>
    @forelse ($fees as $fee)
        <div class="col-md-6">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" wire:model="selectedFees" value="{{ $fee->id }}"
                    id="fee_{{ $fee->id }}">
                <label class="form-check-label" for="checkDefault">
                    {{ $fee->name }}
                </label>
            </div>
        </div>

    @empty
        <div class="col-md-12">
            <div class="alert alert-danger" role="alert">
                <i class="far fa-sad-tear"></i> No se encontraron registros...
            </div>
        </div>
    @endforelse
    @error('selectedFees')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
    @enderror

</x-modal>
