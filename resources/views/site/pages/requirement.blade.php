@extends('site.layout')
@section('content')
    <div class="banner">
        <img class="img-banner" src="{{ asset('assets/img/news.jpg') }}" alt="Cursos">
        <div class="banner-content">
            <h2 class="title-banner">Requisitos de inscripción</h2>
            <p class="desc-banner">Forma parte de nuestra comunidad y accede a cursos, seminarios, diplomados y maestrías que potenciarán tu desarrollo profesional.</p>
        </div>
    </div>
    <section class="section section-color-1 py-5 px-0 mx-0">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Requisitos de inscripción</h2>
            </div>

            <div class="row g-2 g-xl-5 justify-content-center">
                <div class="col-12 col-md-6">
                    {!! $institution->requirement !!}
                </div>
            </div>
        </div>
    </section>
@endsection
