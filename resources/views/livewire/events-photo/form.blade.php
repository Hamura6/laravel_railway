<x-modal title="Evento  ">
    <div class="col-md-12">
        <div class="form-floating">
            <input type="text" class="form-control @error('title')
            is-invalid @enderror" wire:model="title"
                id="floatingInput" placeholder="title@example.com">
            <label for="floatingInput">Titulo</label>
        </div>
        @error('title')
            <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="form-floating">
            <input type="date" class="form-control @error('date')
            is-invalid @enderror" wire:model="date"
                id="floatingInput" placeholder="date@example.com">
            <label for="floatingInput">Fecha</label>
        </div>
        @error('date')
            <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="form-floating">
            <textarea class="form-control @error('description') is-invalid @enderror " wire:model="description"
                placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
            <label for="floatingTextarea2">Descripcion</label>
        </div>
        @error('description')
            <span class="text-danger"> {{ $message }}</span>
        @enderror

    </div>
    <div class="col-md-12">
        <div class="mb-3">
            <label for="formFile" class="form-label">Seleccione las imágenes</label>
            <input id="formFile" type="file" class="form-control @error('photos') is-invalid @enderror"
                wire:model="photos" multiple x-on:livewire-upload-start="uploading = true"
                x-on:livewire-upload-finish="uploading = false" x-on:livewire-upload-error="uploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">

            @error('photos')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            @error('photos.*')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            {{-- Barra de progreso con Alpine.js --}}
            <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start.window="uploading = true"
                x-on:livewire-upload-finish.window="uploading = false"
                x-on:livewire-upload-error.window="uploading = false"
                x-on:livewire-upload-progress.window="progress = $event.detail.progress">

                <div x-show="uploading" class="mt-2">
                    <div class="d-flex justify-content-between mb-1">
                        <small class="text-muted">Subiendo imágenes...</small>
                        <small class="text-muted" x-text="progress + '%'"></small>
                    </div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                            :style="'width: ' + progress + '%'">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-modal>
