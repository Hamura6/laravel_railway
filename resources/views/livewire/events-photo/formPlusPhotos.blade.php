<x-modal title="Evento">
        <div class="col-md-12">
            <div class="mb-3">
                <label for="formFile" class="form-label">Seleccione las imágenes</label>
                <input id="formFile" type="file" class="form-control @error('images') is-invalid @enderror"
                    wire:model="images" multiple x-on:livewire-upload-start="uploading = true"
                    accept=".png,.jpg,.jpeg"
                    x-on:livewire-upload-finish="uploading = false" x-on:livewire-upload-error="uploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">

                @error('images')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @error('images.*')
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
