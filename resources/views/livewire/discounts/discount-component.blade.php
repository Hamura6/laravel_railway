<div>
    <x-card-header title="Descuentos Aplicables" name="Descuentos" />
    <x-card-body>
        <x-slot name="header">
            <div class="col-sm-12 col-md-6 order-2 order-md-1 ">
                <x-search />
            </div>
            @can('discount.create')
                <div class="col-md-4 col-ms-12 order-1 order-md-2 offset-md-2">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" wire:target="search" wire:loading.attr="disabled" class="btn btn-sm btn-success"
                            data-bs-toggle="modal" data-bs-target="#myModal">
                            <i class="far fa-file-alt fs-6"></i> Nuevo
                        </button>
                    </div>
                </div>
            @endcan


        </x-slot>
        <div class="row g-3" wire:target="search" wire:loading.remove>
            @forelse ($discounts as $discount)
                <div class="col-md-4">
                    <div class="card shadow  h-100 border-{{ $discount->is_active ? 'success' : 'secondary' }} ">

                        <div
                            class="card-header py-2  text-center {{ $discount->is_active ? 'bg-success' : 'bg-secondary' }}">
                            <h6 class="mb-0 text-white">
                                {{ $discount->start_date }} | {{ $discount->end_date }}
                                <span
                                    class="badge border border-light text-light ms-3 fs-6">{{ $discount->discount_value }}%</span>
                            </h6>
                        </div>
                        <div class="card-body d-flex flex-column  m-0 py-1 px-3 ">
                            @if ($discount->fees->isNotEmpty())
                                <ul class="list-group list-group-flush fs-6">
                                    @foreach ($discount->fees->chunk(2) as $chunk)
                                        <div class="row">
                                            @foreach ($chunk as $fee)
                                                <div class="col">
                                                    {{ $fee->name }}
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach

                                </ul>
                            @else
                                <p class="text-muted small mb-3 text-center"> <i class="far fa-sad-tear me-2"></i>No hay
                                    tipos de tramites</p>
                            @endif


                        </div>
                        <div class=" card-footer py-1 d-flex gap-1 justify-content-end">
                            @can('discount.edit')
                                <x-btn-edit id="{{ $discount->id }}" />
                            @endcan
                            @can('discount.delete')
                                <x-btn-delete id="{{ $discount->id }}" />
                            @endcan
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="far fa-sad-tear me-2"></i> No se encontró ningún registro...
                    </div>
                </div>
            @endforelse

        </div>

        <div class="border-top p-2  mt-3 d-flex align-items-center">
            {{ $discounts->links() }}
        </div>

    </x-card-body>
    @include('livewire.discounts.form')
</div>
