<div class="form-group position-relative">

    <label class="form-control-label">Seleccione a un afiliado</label>

    <input type="text" class="form-control @error('value') is-invalid @enderror" placeholder="Buscar afiliado..."
        wire:model.live="searchTerm" wire:focus="showDropdown" wire:blur="hideDropdown">

    @error('value')
        <span class="text-danger">{{ $message }}</span>
    @enderror

    @if ($showList && !empty($filteredAffiliates))
        <ul class="list-group mt-1 position-absolute w-100 p-0 overflow-scroll"
            style="max-height: 225px;  z-index: 1050;">

            <!-- 🔁 Resultados -->
            @foreach ($filteredAffiliates as $affiliate)
                <li class="list-group-item list-group-item-action" style="cursor: pointer"
                    wire:click="selectUniversity({{ $affiliate->id }})">
                    {{ $affiliate->user->full_name }}
                </li>
            @endforeach
        </ul>
    @endif
</div>
