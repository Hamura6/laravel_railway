@extends('site.layout')
@section('content')
    <div class="banner">
        <img class="img-banner" src="{{ asset('assets/img/aggrement1.jpg') }}" alt="Cursos">
        <div class="banner-content">
            <h2 class="title-banner">Convenios</h2>
            <p class="desc-banner">Los convenios estratégicos fortalecen la colaboración y optimizan las relaciones
                profesionales, asegurando beneficios mutuos y un funcionamiento eficiente.</p>
        </div>
    </div>
    <section class="section section-color-4 py-5 px-0 mx-0">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Nuestros Convenios</h2>
                <p class="section-subtitle">
                    Los acuerdos institucionales fomentan la cooperación, el intercambio de experiencias y el crecimiento
                    compartido.
                </p>
            </div>

            <div class="row g-2 justify-content-center">
                @foreach ($convenios as $convenio)
                    <div class="col-md-6">
                        <div class="ally-card">
                            <!-- Logo -->
                            <div class="ally-logo">
                                <img src="{{ $convenio->image_view }}" alt="{{ $convenio->name }}" class="img-fluid">
                            </div>

                            <!-- Nombre -->
                            <h3 class="ally-name">{{ $convenio->name }}</h3>

                            <!-- Redes sociales – botones perfectos -->
                            <div class="ally-socials">
                                @foreach ($convenio->socials as $social)
                                    <a href="{{ $social->url }}" target="_blank" class="ally-social-btn"
                                        aria-label="{{ $social->name }}">
                                        <i class="{{ $social->Icon }}"></i>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
