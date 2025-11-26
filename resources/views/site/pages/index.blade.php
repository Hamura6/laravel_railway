@extends('site.layout')
@section('content')
<div id="carouselExampleRide" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('assets/img/5.jpg') }}" class="d-block w-100" alt="Slide 1">
      <div class="carousel-caption">
        <h5 class="fw-bold">Servicios Legales Integrales</h5>
        <p>Asesoría especializada para todos sus requerimientos jurídicos</p>
{{--         <a href="#" class="btn btn-warning btn-lg mt-3 px-4 shadow">Descubrir más</a>
 --}}      </div>
    </div>
    <div class="carousel-item">
      <img src="{{ asset('assets/img/6.jpg') }}" class="d-block w-100" alt="Slide 2">
      <div class="carousel-caption">
        <h5 class="fw-bold">Colegio de Abogados</h5>
        <p>Institución comprometida con la defensa de la justicia, los derechos y la ética profesional.</p>
        <a href="{{ route('site.about') }}" class="btn btn-outline-warning btn-lg mt-3 px-4">Ver más</a>
      </div>
    </div>
    <div class="carousel-item">
      <img src="{{ asset('assets/img/2.jpg') }}" class="d-block w-100" alt="Slide 3">
      <div class="carousel-caption">
        <h5 class="fw-bold">Experiencia Única</h5>
        <p>Lo que nos hace diferentes</p>
        <a href="{{ route('site.requirement') }}" class="btn btn-warning btn-lg mt-3 px-4 shadow">Participa con nosotros</a>
      </div>
    </div>
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>

  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleRide" data-bs-slide-to="0" class="active" aria-current="true"></button>
    <button type="button" data-bs-target="#carouselExampleRide" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#carouselExampleRide" data-bs-slide-to="2"></button>
  </div>
</div>
    <div class="col-derecha py-5 px-3 px-lg-4">
        <div class="row g-3 g-xl-3">
            <!-- CURSOS -->
            <div class="col-12 col-md-6 col-lg-6">
                <a href="{{ route('site.courses') }}" class="resource-card d-block h-100 text-decoration-none">
                    <div class="resource-card-img" style="background-image: url({{ asset('assets/img/courses1.jpg') }});"></div>
                    <div class="resource-card-body">
                        <div class="resource-icon mb-3"></div>
                        <h3 class="resource-title h4 fw-bold">CURSOS</h3>
                        <span class="resource-link text-warning fw-semibold">
                            Ver más <i class="fas fa-arrow-right ms-2"></i>
                        </span>
                    </div>
                </a>
            </div>

            <!-- SEMINARIOS -->
            <div class="col-12 col-md-6 col-lg-6">
                <a href="{{ route('site.courses') }}" class="resource-card d-block h-100 text-decoration-none">
                    <div class="resource-card-img" style="background-image: url({{ asset('assets/img/courses2.jpg') }});"></div>
                    <div class="resource-card-body">
                        <div class="resource-icon mb-3"></div>
                        <h3 class="resource-title h4 fw-bold">SEMINARIOS</h3>
                        <span class="resource-link text-warning fw-semibold">
                            Ver más <i class="fas fa-arrow-right ms-2"></i>
                        </span>
                    </div>
                </a>
            </div>

            <!-- DIPLOMADOS -->
            <div class="col-12 col-md-6 col-lg-6">
                <a href="{{ route('site.agreements') }}" class="resource-card d-block h-100 text-decoration-none">
                    <div class="resource-card-img" style="background-image: url({{ asset('assets/img/aggrement1.jpg') }});"></div>
                    <div class="resource-card-body">
                        <div class="resource-icon mb-3"></div>
                        <h3 class="resource-title h4 fw-bold">CONVENIOS</h3>
                        <span class="resource-link text-warning fw-semibold">
                            Ver más <i class="fas fa-arrow-right ms-2"></i>
                        </span>
                    </div>
                </a>
            </div>

            <!-- MAESTRÍAS -->
            <div class="col-12 col-md-6 col-lg-6">
                <a href="{{ route('site.requirement') }}" class="resource-card d-block h-100 text-decoration-none">
                    <div class="resource-card-img" style="background-image: url({{ asset('assets/img/requirement1.jpg') }});">
                    </div>
                    <div class="resource-card-body">
                        <div class="resource-icon mb-3"></div>
                        <h3 class="resource-title h4 fw-bold">Requisitos de inscripción</h3>
                        <span class="resource-link text-warning fw-semibold">
                            Ver más <i class="fas fa-arrow-right ms-2"></i>
                        </span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <section class="banner-servicios py-5 position-relative overflow-hidden">
        <div class="container position-relative z-2">
            <div class="row align-items-center text-center text-lg-start">
                <!-- Columna del texto -->
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h2 class="display-5 fw-bold text-warning mb-4">
                        Servicios al Ciudadano
                    </h2>
                    <p class="lead text-light fs-4 mb-4">
                        Accede a profesionales del Derecho debidamente colegiados y realiza tus denuncias de manera segura y confidencial
                    </p>
                    <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start">
                        <div class="d-flex align-items-center text-light">
                            <i class="fas fa-shield-alt fs-3 me-3"></i>
                            <span class="fs-5">Transparencia total</span>
                        </div>
                        <div class="d-flex align-items-center text-light">
                            <i class="fas fa-lock text-warning  fs-3 me-3"></i>
                            <span class="fs-5">Datos protegidos</span>
                        </div>
                        <div class="d-flex align-items-center text-light">
                            <i class="fas fa-headset text-warning fs-3 me-3"></i>
                            <span class="fs-5">Atención inmediata</span>
                        </div>
                    </div>
                </div>

                <!-- Columna de la imagen o ilustración -->
                <div class="col-lg-6">
                    <div class="text-center">
                        <img src="{{ asset('assets/img/5.jpg') }}" alt="Servicios al ciudadano"
                            class="img-fluid rounded-4 shadow-lg" style="max-height: 420px; object-fit: cover;">
                        <!-- Si no tienes imagen, puedes usar este SVG decorativo -->
                        <!-- <div class="placeholder-glow">
                                    <div class="placeholder bg-warning opacity-25 rounded-4" style="height: 400px;"></div>
                                </div> -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Fondo decorativo con tu paleta -->
        <div class="background-shapes">
            <div class="shape-1"></div>
            <div class="shape-2"></div>
        </div>
    </section>


    <section class="hero-icalp position-relative overflow-hidden">
        <div class="container-fluid p-0">
            <div class="row g-0">

                <!-- Imagen + Slider de fondo -->
                <div class="col-lg-7 position-relative">
                    <div class="hero-slider">
                        <div class="slider-track">
                            <div class="hero-slide">
                                <img src="{{ asset('assets/img/5.jpg') }}" alt="ICALP - Excelencia institucional"
                                    class="w-100 h-100 object-fit-cover">
                            </div>
                            <div class="hero-slide">
                                <img src="{{ asset('assets/img/1.jpg') }}" alt="ICALP - Tradición y modernidad"
                                    class="w-100 h-100 object-fit-cover">
                            </div>
                            <div class="hero-slide">
                                <img src="{{ asset('assets/img/2.jpg') }}" alt="ICALP - Comunidad jurídica"
                                    class="w-100 h-100 object-fit-cover">
                            </div>
                            <!-- Repetimos para loop infinito -->
                            <div class="hero-slide">
                                <img src="{{ asset('assets/img/5.jpg') }}" alt="ICALP"
                                    class="w-100 h-100 object-fit-cover">
                            </div>
                        </div>
                    </div>

                    <!-- Overlay oscuro + texto histórico -->
                    <div
                        class="hero-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                        <div class="text-center text-white">
                            <h1 class="display-4 fw-bold text-warning mb-0">
                                1916
                            </h1>
                            <p class="fs-3 fw-light tracking-wider">
                                MÁS DE UN SIGLO DE EXCELENCIA INSTITUCIONAL
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Texto institucional (derecha en desktop) -->
                <div class="col-lg-5 bg-light d-flex align-items-center">
                    <div class="p-5 p-xl-7 text-white">
                        <h2 class="display-3 fw-bold text-warning mb-3">ICAP</h2>
                        <h3 class="h4 fw-light text-warning mb-4 opacity-90">
                            Desarrollo innovador en el ejercicio del Derecho
                        </h3>
                        <p class="lead mb-5 opacity-90 text-black">
                            El ICAP es una entidad de alcance internacional dedicada al perfeccionamiento permanente y la
                            capacitación especializada de profesionales del Derecho, fundamentada en principios como la
                            calidad académica, la ética, la creatividad y el trabajo conjunto. Fomenta una formación
                            integral, inclusiva y alineada con las exigencias contemporáneas, a través de una plataforma
                            digital innovadora, convenios estratégicos a nivel global y programas destinados al desarrollo y
                            posicionamiento profesional. Del mismo modo, se distingue por ser el primer colegio de abogados
                            boliviano en promover de forma continua y decidida la internacionalización de su gestión
                            académica.
                        </p>

                        <a href="{{ route('site.about') }}"
                            class="btn btn-warning btn-lg px-5 py-3 fw-bold text-dark shadow-lg hover-lift">
                            CONÓCENOS
                            <i class="fas fa-arrow-right ms-3"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <section class="contenedor4 py-5 py-lg-7 bg-dark text-light overflow-hidden">
        <div class="container">
            <div class="row g-5 align-items-center">

                <!-- Mapa interactivo (izquierda en desktop, arriba en móvil) -->
                <div class="col-lg-6 order-lg-2">
                    <div class="position-relative rounded-4 overflow-hidden shadow-lg mapa-hover">
                        <a href="https://maps.app.goo.gl/ifrpf4p9Ad43LRH49" target="_blank" class="d-block">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1066.527116947773!2d-65.75457193265498!3d-19.592001688625178!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x93f94e7a169de4b3%3A0x4f4d7dbc527169c2!2sColegio%20De%20Abogados!5e0!3m2!1ses!2sbo!4v1763388200817!5m2!1ses!2sbo"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>

                        </a>
                        <!-- Overlay sutil al hacer hover -->
                        <div
                            class="position-absolute inset-0 bg-dark opacity-0 hover-overlay transition-opacity d-flex align-items-center justify-content-center">
                            <div class="text-center">
                                <i class="fas fa-map-marker-alt text-warning fa-3x mb-3"></i>
                                <p class="text-white fs-4 fw-bold mb-0">Abrir en Google Maps</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Información de contacto (derecha en desktop) -->
                <div class="col-lg-6 order-lg-1">
                    <div class="pe-lg-5">
                        <h2 class="display-5 fw-bold text-warning mb-3">
                            ¿DÓNDE NOS ENCONTRAMOS?
                        </h2>
                        <p class="lead text-light opacity-90 mb-4">
                            Visítanos y sé parte de la comunidad jurídica.
                        </p>

                        <div class="row g-4 mt-4">
                            <!-- Dirección -->
                            <div class="col-12">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-location-dot text-warning fs-3"></i>
                                    </div>
                                    <div>
                                        <h5 class="text-warning mb-1">Dirección</h5>
                                        <p class="mb-0 text-light">
                                            {{$institution->address??'ninguno'}}<br>
                                            <strong>{{ $institution->city_label }} - Bolivia</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Teléfono -->
                            <div class="col-12">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-phone text-warning fs-3"></i>
                                    </div>
                                    <div>
                                        <h5 class="text-warning mb-1">Teléfono</h5>
                                        <a href="tel:+59122407713"
                                            class="text-light text-decoration-none hover-text-warning transition">
                                            <strong>(+591) {{$institution->phone}}</strong>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Horario -->
                            <div class="col-12">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-clock text-warning fs-3"></i>
                                    </div>
                                    <div>
                                        <h5 class="text-warning mb-1">Horario de atención</h5>
                                        <p class="mb-0 text-light">
                                            <strong>Lunes a Viernes:</strong> 08:30 - 18:30<br>
                                            <small class="text-light opacity-75">Sábados y domingos cerrado</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botón opcional -->
                        <div class="mt-5">
                            <a href="https://maps.app.goo.gl/ifrpf4p9Ad43LRH49" target="_blank"
                                class="btn btn-warning btn-lg px-5 py-3 fw-bold shadow-lg hover-shadow">
                                <i class="fas fa-directions me-2"></i>
                                Cómo llegar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
