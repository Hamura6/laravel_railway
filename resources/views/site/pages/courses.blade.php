@extends('site.layout')
@section('content')

    <div class="banner">
        <img class="img-banner" src="{{ asset('image/courses1.jpg') }}" alt="Cursos">
        <div class="banner-content">
            <span class="banner-eyebrow">Formación continua</span>
            <h2 class="title-banner">Cursos</h2>
            <p class="desc-banner">Aprende nuevas habilidades con nuestros cursos en línea.</p>
        </div>
    </div>

    <section class="cw-section">
        <div class="cw-container">

            <div class="cw-header">
                <span class="cw-header-label">Oferta académica</span>
                <h2 class="cw-header-title">Nuestros cursos</h2>
                <p class="cw-header-sub">Formación continua para profesionales del derecho. Capacítate con nuestros programas especializados.</p>
            </div>

            <div class="row g-3 g-xl-4 justify-content-center">
                @forelse ($courses as $index => $course)
                    <div class="col-12 col-md-6">
                        <div class="cw2-card h-100">

                            <div class="cw2-img">
                                <img src="{{ $course->image_view }}" alt="{{ $course->title }}" loading="lazy">
                                <div class="cw2-img-gradient"></div>
                                <div class="cw2-img-bottom">
                                    <span class="cw2-price">Bs. {{ number_format($course->price, 2) }}</span>
                                    <span class="cw2-index">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                </div>
                            </div>

                            <div class="cw2-body">
                                <h3 class="cw2-title">{{ $course->title }}</h3>
                                <p class="cw2-desc">{{ $course->description}}</p>
                                <div class="cw2-meta">
                                    <div class="cw2-meta-item">
                                        <i class="far fa-calendar-alt"></i>
                                        <span>{{ $course->created_at->format('d M, Y') }}</span>
                                    </div>
                                    <div class="cw2-meta-item">
                                        <i class="fas fa-play-circle"></i>
                                        <span>Inicio: {{ $course->date_start }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="cw2-footer">
                                <a href="{{ $course->image_view }}" target="_blank" rel="noopener" class="cw2-btn">
                                    <i class="fas fa-eye"></i>
                                    Vista previa
                                </a>
                                <a href="{{ $course->image_view }}" target="_blank" rel="noopener" class="cw2-arrow" title="Ver imagen">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="cw-empty">
                            <i class="far fa-folder-open"></i>
                            <p>No hay cursos disponibles en este momento.</p>
                        </div>
                    </div>
                @endforelse
                
            </div>

        </div>
    </section>

@endsection