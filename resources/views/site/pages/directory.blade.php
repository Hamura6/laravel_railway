@extends('site.layout')
@section('content')
    <div class="banner">
        <img class="img-banner" src="{{ asset('image/2.webp') }}" alt="Cursos">
        <div class="banner-content">
            <h2 class="title-banner">Organización</h2>
            <p class="desc-banner">Una buena organización en una empresa es fundamental porque determina cómo funciona.</p>
        </div>
    </div>
    <section class="section section-color-2 py-5 px-0 mx-0">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Directorio de ICAP</h2>
                <p class="section-subtitle">
                    El Directorio de ICAP presenta la estructura organizativa de la institución y sus principales
                    autoridades.
                </p>
            </div>
            <div class="row   g-2 justify-content-center">
                @foreach ($directory as $member)
                    <div class="col-md-4">
                        <article class="team-card h-100">
                            <!-- Rol + flechita -->
                            <div class="sub-card category d-flex align-items-center justify-content-center">
                                <span class="text-span text-center">{{ $member->name }}</span>
                            </div>

                            <!-- Imagen completa + overlay círculo -->
                            <div class="card-container">
                                <img src="{{ $member->affiliate->user->image }}"
                                    alt="{{ $member->affiliate->user->full_name }}" class="image">

                                <div class="overlay-circle"></div>
                            </div>

                            <!-- Nombre -->
                            <div class="sub-card named">
                                <span class="text-span"
                                    style="font-size: 10px">{{ $member->affiliate->user->title . ' ' . $member->affiliate->user->full_name }}</span>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <section class="section section-color-2 py-2 px-0 mx-0">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Tribunal de Honor</h2>
                <p class="section-subtitle">
                    El Tribunal de Honor vela por el cumplimiento ético y disciplinario de los miembros, asegurando la
                    integridad profesional.
                </p>
            </div>
            <div class="row  g-2 justify-content-center ">
                @foreach ($th_directory as $member)
                    <div class="col-md-4">
                        <article class="team-card h-100">
                            <!-- Rol + flechita -->
                            <div class="sub-card category d-flex align-items-center justify-content-center">
                                <span class="text-span text-center">{{ $member->name }}</span>
                            </div>

                            <!-- Imagen completa + overlay círculo -->
                            <div class="card-container">
                                <img src="{{ $member->affiliate->user->image }}"
                                    alt="{{ $member->affiliate->user->full_name }}" class="image">

                                <div class="overlay-circle"></div>
                            </div>

                            <!-- Nombre -->
                            <div class="sub-card named">
                                <span class="text-span"
                                    style="font-size: 10px">{{ $member->affiliate->user->title . ' ' . $member->affiliate->user->full_name }}</span>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
