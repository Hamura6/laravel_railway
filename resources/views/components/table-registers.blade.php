<div class="card border-2 shadow-sm rounded-3 overflow-hidden border-dark">
    <div class="table-responsive p-0">
        <table
            class="table table-light justify-content-center mb-0 table-bordered ">
            @isset($header)
                <thead align="center" class="table-dark font-weight-semibold">
                    <tr>
                        {{ $header }}
                    </tr>
                </thead>
            @endisset

            <tbody class="table-group-divider" wire:loading.remove wire:target="search">
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>
<div class="text-center py-4 color-dark justify-content-center w-100" wire:loading wire:target="search">
    <div class="spinner-border " style="width: 4rem; height: 4rem;" role="status">
        <span class="visually-hidden ">Loading...</span>
    </div>
</div>
