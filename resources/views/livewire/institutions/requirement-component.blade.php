<div>
    <x-card-header title="Requisitos de inscripción" name="Saldos" />
    <x-card-body>
        <x-slot name="header">
            <div class="col-md-12">
                <div class="d-flex justify-content-end">
                <a href="{{ route('requirement') }}" class="btn btn-sm btn-info"> <i class="fas fa-edit"></i> Editar</a>
                </div>
            </div>
        </x-slot>
        <div class="row">
            <div class="col-md-12">
                {!! $requirement !!}

            </div>
        </div>
    </x-card-body>
</div>
