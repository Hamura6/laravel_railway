<div>
    <x-card-header title="Reporte de Afiliados" name="Reporte" />
    <x-card-body>
        <x-slot name="header">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link text-secondary @if ($this->tab =="age")
                        text-dark
                        active
                    @endif " wire:click="setTab('age')" aria-current="page" href="#"> <i class="fas fa-american-sign-language-interpreting"></i> Por Edad</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-secondary @if ($this->tab =="specialty")
                        text-dark
                        active
                    @endif" wire:click="setTab('specialty')" href="#"> <i class="fas fa-user-tag"></i> Por Especialidad</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-secondary @if ($this->tab=="status")
                        text-dark
                        active
                    @endif " wire:click="setTab('status')" href="#"> <i class="fas fa-user-alt-slash"></i> Por Estado</a>
                </li>
            </ul>
        </x-slot>
        <div class="col-12">

            @if ($this->tab === 'age')
                @livewire('reports.age-affiliate')
            @elseif ($this->tab === 'specialty')
                @livewire('reports.specialty-affiliate')
            @elseif ($this->tab === 'status')
                @livewire('reports.status-affiliate')
            @endif
        </div>
    </x-card-body>


</div>
