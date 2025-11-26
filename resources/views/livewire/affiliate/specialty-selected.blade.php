 <div class="form-group position-relative">
     <label class="form-control-label">Especialdad</label>
     <input type="text" class="form-control @error('value') is-invalid @enderror"
         placeholder="Buscar universidad..." wire:model="value" wire:model.live="searchTerm" wire:focus="showDropdown"
         wire:blur="hideDropdown">
     @if ($showList && !empty($filteredSpecialties))
         <ul class="list-group mt-1 position-absolute w-100 p-0 overflow-scroll"
            style="max-height: 225px;  z-index: 1050;">
             @foreach ($filteredSpecialties as $specialty)
                 <li class="list-group-item list-group-item-action" style="cursor: pointer"
                     wire:click="selectUniversity({{ $specialty->id }})">
                     {{ $specialty->name }}
                 </li>
             @endforeach
         </ul>
     @endif
 </div>
