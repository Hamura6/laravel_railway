@extends('site.layout')
@section('content')
    <div class="banner">
        <img class="img-banner" src="{{ asset('image/news.jpg') }}" alt="Cursos">
        <div class="banner-content">
            <h2 class="title-banner">Informate</h2>
            <p class="desc-banner">Informate y ponde al dia acerca de nuestra institución.</p>
        </div>
    </div>

    <section class="section section-color-2">
        <div class="section-container">
            <div class="section-header">
                <h2 class="section-title">Noticias</h2>
                <p class="section-subtitle">
                    Mantente informado sobre novedades jurídicas y eventos del colegio.
                </p>
            </div>

            <div class="row g-3">
                @forelse ($informations as $information)
                    <div class="col-12 col-md-12 col-lg-12 mb-4">
                        <article class="news-card-web h-100 bg-primary-lading-bg shadow-lg border-0 overflow-hidden">
                            <a href="{{ $information->image_view }}" target="_blank" class="news-img-wrapper d-block">
                                <img src="{{ $information->image_view }}" alt="{{ $information->title }}"
                                    class="news-img w-100 h-100 object-fit-cover" loading="lazy">
                                <div class="news-img-overlay"></div>
                            </a>

                            <div class="news-content p-4 p-xl-5">

                                <!-- Fecha -->
                                <span class="news-date text-accent-lading fw-semibold text-uppercase tracking-wider fs-sm">
                                    <i class="far fa-calendar-alt me-2"></i>
                                    {{ $information->created_at->format('d \\d\\e M \\d\\e Y') }}
                                </span>

                                <!-- Título -->
                                <h3 class="news-title mt-3 mb-3 fs-5 fw-bold  line-clamp-2">
                                    <a href="{{ $information->image_view }}" target="_blank"
                                        class="text-decoration-none text-light   hover-text-accent">
                                        {{ $information->title }}
                                    </a>
                                </h3>

                                <!-- Descripción -->
                                <p class="news-desc text-light opacity-90 mb-4 line-clamp-3">
                                    {{ $information->description }}
                                </p>

                                <!-- Botones -->
                                <div class="d-flex flex-wrap gap-2 mt-auto">
                                    <a href="{{ $information->image_view }}" target="_blank"
                                        class="btn btn-outline-accent btn-sm fw-medium px-4">
                                        <i class="fas fa-eye me-2"></i>Ver más
                                    </a>

                                    <a href="{{ $information->image_view }}" download="{{ $information->title }}"
                                        class="btn btn-accent btn-sm fw-medium px-4">
                                        <i class="fas fa-download me-2"></i>Descargar
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12 col-sm-12 col-md-12">
                        <div class="my-card">
                            <div class="my-card-content text-center">
                                <p class="my-card-desc">
                                    <i class="far fa-sad-tear"></i>
                                    No se encontraron noticias o comunicados
                                </p>
                            </div>
                        </div>
                    </div>
                @endforelse
                {{ $informations->links() }}
            </div>
        </div>
    </section>
@endsection
