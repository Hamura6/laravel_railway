@extends('site.layout')
@section('content')
    
    <div class="banner">
      <img class="img-banner" src="{{ asset('image/blog-2.jpg') }}" alt="Cursos">
      <div class="banner-content">
        <h2 class="title-banner">Acerca de nosotros</h2>
        <p class="desc-banner">Somos una institución dedicada a la formación continua de profesionales del Derecho, comprometida con la excelencia, la ética y la innovación.</p>
      </div>
    </div>


    <section class="section section-color-1">
      <div class="section-container">
        <div class="section-header">
          <h2 class="section-title">¿Quiénes somos?</h2>
          <p class="section-subtitle">
            El ICAP fortalece la formación y el desarrollo profesional de abogados, fomentando la ética, la excelencia y la innovación en la práctica del Derecho.
          </p>
        </div>

        <div class="row">
          <div class="col-12 col-md-4 col-lg-5">
            <img class="img-fluid h-100" src="{{asset('image/fachada.webp')}}">
          </div>
          <div class="col-12 col-md-8 col-lg-7">
            <div class="my-title">Historia del Ilustre Colegio de Abogados de Potosí</div>
            <p class="my-text">
              En 1915, en Potosí, se estableció el Colegio de Abogados siguiendo una circular que recomendaba su
              formación. La reunión inaugural se llevó a cabo el 16 de enero de 1916, con la participación de 38
              abogados. Se eligió una mesa directiva con destacados profesionales, y se enfatizó la importancia de
              exigir la correcta aplicación de la ley. El colegio operó provisionalmente hasta que se aprobara su
              estatuto, lo cual ocurrió el 13 de febrero del mismo año. El siguiente año, se realizó la elección de una
              nueva junta directiva. Esta iniciativa no solo benefició al foro y las autoridades, sino también a la
              sociedad, al fomentar la unión de profesionales y promover el beneficio colectivo para la ciudad.
            </p>
          </div>
        </div>
      </div>
    </section>

    <section class="section section-color-2">
      <div class="section-container">
        <div class="quote-shout">
          <h1>"El Abogado es el intérprete de las leyes y el que hace posible la libertad."</h1>
        </div>
      </div>
    </section>

    <section class="section section-color-1">
      <div class="section-container">
        <div class="section-header">
          <div class="section-title">Misión</div>
          <p class="section-subtitle">{{ $institution->mission }} </p>
        </div>
      </div>
    </section>

    <section class="section section-color-2">
      <div class="section-container">
        <div class="section-header">
          <div class="section-title">Visión</div>
          <p class="section-subtitle">{{$institution->vision}}</p>
        </div>
      </div>
    </section>
@endsection