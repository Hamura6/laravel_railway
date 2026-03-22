<div>
    <style>
        .card-body.img {
            background-image: url({{ asset('image/fachada.webp') }});
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .institution {
            background: rgba(232, 232, 232, 0.724);
            width: 50%;
            height: 340px;
            border-radius: 20px;
            margin: 0 auto
        }
    </style>
    <div class="row g-1">
        <div class="col-12">
            <div class="card">
                <div class="card-body img">
                    <div align="center" class="row g-1 institution">
                        <div class="text-center col-md-12 m-0 p-0 mt-3">
                            <h2 class=" text-dark">{{ $institution->initials }}
                            </h2>
                            <img src="{{ $institution->image }}" alt="Logo Colegio" style="height: 150px;">
                        </div>
                        <div class="section-header text-center col-md-12">
                            <h2 class="section-title text-dark">{{ $institution->name }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card ">
                <div class="card-body">
                    <h5 class="card-title text-dark fw-bold">Visión</h5>
                    <p class="card-text">{{ $institution->vision }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card ">
                <div class="card-body">
                    <h5 class="card-title text-dark fw-bold">Misión</h5>
                    <p class="card-text">{{ $institution->mission }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
