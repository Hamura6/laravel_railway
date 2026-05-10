@extends('site.layout')
@section('content')
    <div class="banner">
        <img class="img-banner" src="{{ asset('image/single.jpg') }}" alt="Galería">
        <div class="banner-content">
            <span class="banner-eyebrow">Galería oficial</span>
            <h2 class="title-banner">Imágenes</h2>
            <p class="desc-banner">Bienvenidos a nuestra galería de imágenes</p>
        </div>
    </div>

    <div class="gallery-toolbar">
        <span class="gallery-count">{{ $photos->total() }} imágenes · página {{ $photos->currentPage() }} de
            {{ $photos->lastPage() }}</span>
    </div>

    <div class="gallery-grid">
        @forelse ($photos as $index => $photo)
            <div class="gallery-item {{ $loop->iteration === 7 ? 'gallery-item--wide' : '' }}">
                <span class="gallery-item-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                <img src="{{ $photo->image }}" alt="Fotografía {{ $loop->iteration }}" loading="lazy">
                <div class="gallery-item-overlay">
                    <a href="{{ $photo->image }}" target="_blank" rel="noopener" class="gallery-item-btn"
                        title="Ver imagen">
                        <i class="fas fa-eye"></i>
                    </a>
                </div>
            </div>
        @empty
            <div class="gallery-empty">
                <i class="far fa-images"></i>
                <p>No hay fotografías disponibles.</p>
            </div>
        @endforelse
    </div>

    <div class="gallery-footer">
        <span class="gallery-footer-info">
            Mostrando {{ $photos->firstItem() }}–{{ $photos->lastItem() }} de {{ $photos->total() }} imágenes
        </span>
        {{ $photos->links() }}
    </div>
@endsection
