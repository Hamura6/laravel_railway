<div class="form-group">
    <label class="form-control-label">Universidad</label>

    <input type="text" 
    class="form-control @error('value') is-invalid @enderror" 
    placeholder="Buscar universidad..."
    wire:model.live="searchTerm" 
    wire:focus="showDropdown" 
    wire:blur="hideDropdown">

    @if ($showList && !empty($filteredUniversities))
        <ul class="list-group mt-1" style="max-height: 200px; overflow-y: auto;">
            @foreach ($filteredUniversities as $university)
                <li class="list-group-item list-group-item-action cursor-pointer"
                    wire:click="selectUniversity({{ $university->id }})">
                    {{ $university->name }} - {{ $university->entity }}
                </li>
            @endforeach
        </ul>
    @endif
</div>
