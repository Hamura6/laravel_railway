<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Reconocimiento</title>
    <style>
        .logo {
            position: absolute;
            top: 10px;
            left: 10px;
            width: 120px;
        }

        .logo img {
            width: 120px;
            height: auto;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10pt;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
            color: #222;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        .info-table th {
            width: 35%;
            background-color: #fafafa;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="logo">
        <img width="120" src="{{ public_path('assets/img/escudo.png') }}" alt="">

    </div>
    <h2> <u>{{ $recognition->type  }}</u></h2>

    <table class="info-table">
        <tr>
            <th>Fecha</th>
            <td>{{ $recognition->date }}</td>
        </tr>
        <tr>
            <th>Aportes a considerar</th>
            <td>{{ $recognition->quantity }}</td>
        </tr>
        <tr>
            <th>Cantidad de participantes</th>
            <td>{{ $recognition->participants }}</td>
        </tr>
        <tr>
            <th>Tiempo restante</th>
            <td>{{ $recognition->remaining_days }}</td>
        </tr>
    </table>

    <h4>Listado de Afiliados</h4>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Matrícula</th>
                <th>Nombre Completo</th>
                <th>Antigüedad</th>
                <th>Fecha Inscripción</th>
                <th>Teléfono</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($recognition->affiliates as $i => $affiliate)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $affiliate->id }}</td>
                    <td>{{$affiliate->user->title  }} {{ $affiliate->user->name }} {{ $affiliate->user->last_name }}</td>
                    <td>{{ $affiliate->antique }}</td>
                    <td>{{ $affiliate->created_at->format('Y-m-d') }}</td>
                    <td>{{ optional($affiliate->user->phones->first())->number ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No hay afiliados registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
