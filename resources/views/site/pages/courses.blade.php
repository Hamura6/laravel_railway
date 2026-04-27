@extends('site.layout')
@section('content')
    <div class="banner">
        <img class="img-banner" src="{{ asset('image/courses1.jpg') }}" alt="Cursos">
        <div class="banner-content">
            <h2 class="title-banner">Cursos</h2>
            <p class="desc-banner">Aprende nuevas habilidades con nuestros cursos en línea.</p>
        </div>
    </div>

    {{-- <section class="section section-color-1">
        <div class="section-container">
            <div class="section-header">
                <h2 class="section-title">Nuestros Cursos</h2>
                <p class="section-subtitle">
                    Formación continua para profesionales del derecho. Capacítate con nuestros programas especializados.
                </p>
            </div>
            <div class="row g-4">

                <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                    @forelse ($courses as $course)
                        <div class="my-card h-100">
                            <div class="px-3 pt-3 pb-1">
                                <a href="{{ $course->image_view }}" target="_blank" class="card-img-container">
                                    <img src="{{ $course->image_view }}" alt="Derecho Civil" class="my-card-img"
                                        style="border-radius: 15px">
                                </a>
                            </div>
                            <div class="my-card-content pt-2">
                                <h3 class="my-card-title">{{ $course->title }}</h3>
                                <span class="badge text-bg-primary p-2 m-0">Precio: {{ $course->price }} Bs.</span>
                                <p class="my-card-desc">
                                    {{ $course->description }}
                                </p>
                            </div>
                        </div>
                    @empty
                    @endforelse

                </div>

            </div>
        </div>
    </section> --}}
    <section class="section section-color-1 py-5 px-0 mx-0">
    <div class="container">
        <div class="section-header">
                <h2 class="section-title">Nuestros Cursos</h2>
                <p class="section-subtitle">
                    Formación continua para profesionales del derecho. Capacítate con nuestros programas especializados.
                </p>
            </div>

        <div class="row g-2 g-xl-5 justify-content-center">
            @forelse ($courses as $course)
                <div class="col-12 col-md-6">
                    <div class="course-card-web">
                        <!-- Imagen principal -->
                        <div class="course-image">
                            <img src="{{ $course->image_view }}" alt="{{ $course->title }}">
                        </div>

                        <!-- Contenido que se expande al hacer hover -->
                        <div class="course-bottom">
                            <div class="course-content">
                                <h3 class="course-title">{{ $course->title }}</h3>

                                <!-- Precio destacado -->
                                <div class="course-price mb-3">
                                    <span class="badge bg-warning text-dark fw-bold px-4 py-2 fs-6">
                                        {{ $course->price }} Bs.
                                    </span>
                                </div>

                                <p class="course-desc text-light opacity-90">
                                    {{ Str::limit($course->description, 120) }}
                                </p>

                                <div class="course-actions mt-4">
                                   {{--  <a 
                                       class="btn btn-warning btn-sm px-4 fw-bold">
                                        Ver detalle
                                    </a> --}}
                                    <a href="{{ $course->image_view }}" target="_blank"
                                       class="btn btn-outline-warning btn-sm px-4">
                                        <i class="fas fa-image"></i> Vista previa
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-light">No hay cursos disponibles en este momento.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
