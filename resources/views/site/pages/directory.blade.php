@extends('site.layout')
@section('content')
<div class="banner">
    <img class="img-banner" src="{{ asset('image/2.webp') }}" alt="Cursos">
    <div class="banner-content">
        <h2 class="title-banner">Organización</h2>
        <p class="desc-banner">Una buena organización en una empresa es fundamental porque determina cómo funciona.</p>
    </div>
</div>

<section class="section section-color-2 py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Directorio de ICAP</h2>
            <p class="section-subtitle">Estructura jerárquica y autoridades de la institución.</p>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach ($directory as $member)
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <x-organigram-card :member="$member" />
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="section section-color-2 py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Tribunal de Honor</h2>
            <p class="section-subtitle">Miembros que velan por la ética y disciplina institucional.</p>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach ($th_directory as $member)
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <x-organigram-card :member="$member" />
                </div>
            @endforeach
        </div>
    </div>
</section>

<div class="modal fade" id="memberModal" tabindex="-1" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-primary text-white rounded-top-4 border-0">
                <h5 class="modal-title" id="memberModalLabel">Perfil del miembro</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <img id="modalImage" src="" class="rounded-circle mb-3 border border-3 border-primary" style="width: 100px; height: 100px; object-fit: cover;">
                <h4 id="modalName" class="mb-1"></h4>
                <p id="modalRole" class="text-muted small"></p>
                <hr>
                <div class="text-start">
                    <p><i class="fas fa-envelope me-2 text-primary"></i> <strong>Correo:</strong> <span id="modalEmail"></span></p>
                    <p><i class="fas fa-phone-alt me-2 text-primary"></i> <strong>Teléfono:</strong> <span id="modalPhone"></span></p>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center pb-4">
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<style>
    .image-wrapper {
        position: relative;
        width: 130px;
        height: 130px;
        margin: 0 auto;
    }
    .pulse-circle {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(13,110,253,0.2) 0%, rgba(13,110,253,0) 70%);
        transform: translate(-50%, -50%) scale(0.8);
        opacity: 0;
        transition: opacity 0.3s, transform 0.3s;
        pointer-events: none;
    }
    .organigram-card:hover .pulse-circle {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1.2);
    }
    /* Transición suave en la imagen */
    .member-image {
        transition: transform 0.2s ease;
    }
    .organigram-card:hover .member-image {
        transform: scale(1.02);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection