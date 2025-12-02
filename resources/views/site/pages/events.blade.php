@extends('site.layout')
@section('content')
    <div class="banner">
        <img class="img-banner" src="{{ asset('image/single.jpg') }}" alt="Cursos">
        <div class="banner-content">
            <h2 class="title-banner">Eventos</h2>
            <p class="desc-banner"> Mantente al día con nuestras actividades, conferencias y eventos destacados pensados para toda la comunidad.</p>
        </div>
    </div>


    <section class="timeline-section py-5 bg-dark">
        <div class="container">

            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold text-warning mb-3">
                    Eventos Institucionales
                </h2>
                <p class="lead text-light opacity-90">
                    Más de 130 años forjando la excelencia jurídica en Bolivia
                </p>
            </div>

            <div id="timeline" class="timeline">

                @forelse ($events as $event)
                    <a href="{{ route('site.events.galery', $event->id) }}">
                        <div class="timeline-item" data-id="112">
                            <div class="timeline-date">
                                <span class="year text-warning fw-bold">
                                    {{ \Carbon\Carbon::parse($event->date)->format('Y') }}
                                </span>
                                <span class="month text-light small d-block">
                                    {{ \Carbon\Carbon::parse($event->date)->translatedFormat('F') }}
                                </span>
                            </div>

                            <div class="timeline-marker">
                                <div class="marker-dot"></div>
                                <div class="marker-line"></div>
                            </div>

                            <div class="timeline-content shadow-lg">
                                {{--  @if ($post->image_path) --}}
                                <img src="{{ asset('storage/event_photos/' . $event->firstPhoto->name) }}" alt="1212sd"
                                    class="timeline-img" loading="lazy">
                                {{--  @endif --}}

                                <div class="p-4">
                                    <h3 class="timeline-title text-warning fw-bold">
                                        {{ $event->title }}
                                    </h3>
                                    <p class="timeline-text text-light mb-0">
                                        {{ $event->description }}
                                    </p>
                                    <small class="text-light opacity-70">
                                        Publicado el
                                        {{ \Carbon\Carbon::parse($event->created_at)->translatedFormat('d \\d\\e F \\d\\e Y') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div id="loading" class="text-center mt-5" style="display:none;">
                        <div class="spinner-border text-warning" role="status">
                            <span class="visually-hidden">Cargando...</span>
                        </div>
                        <p class="text-light mt-3">Cargando más eventos...</p>
                    </div>


                    <div class="text-center mt-5">
                        <form action="{{ route('site.events', $total + 5) }}" method="GET">
                            @csrf
                            <button id="loadMore" type="submit" class="btn btn-outline-warning btn-lg px-5">
                                Cargar más
                            </button>
                        </form>
                    </div>

                @empty
                    <div id="loading" class="text-center mt-5">

                        <p class="text-light mt-3">No se encontraron eventos</p>
                    </div>
                @endforelse


            </div>


        </div>
    </section>
@endsection
