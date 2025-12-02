@extends('site.layout')
@section('content')
    <div class="banner">
        <img class="img-banner" src="{{ asset('images/single.jpg') }}" alt="Cursos">
        <div class="banner-content">
            <h2 class="title-banner">Imagenes </h2>
            <p class="desc-banner">Bienvenidos a nuestra galeria de imagenes</p>
        </div>
    </div>
    <div
        class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4 g-xl-5 justify-content-center p-5">
        @foreach ($photos as $photo)
            <div class="col">
                <div class="polaroid-card" data-bs-toggle="tooltip" title="{{ $photo->title ?? '' }}">
                    <div class="polaroid">
                        <div class="photo">
                            <img src="{{ $photo->image }}" class="w-100 h-100 object-fit-cover" alt="Imagen" loading="lazy">

                            <!-- Efectos vintage (super ligeros) -->
                            <div class="dust"></div>
                            <div class="scratches"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="border-top py-3 px-3 d-flex align-items-center">
        {{ $photos->links() }}
    </div>
@endsection
