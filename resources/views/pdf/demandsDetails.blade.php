<html>

<head>

</head>
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

    .header {
        text-align: center;
        margin-bottom: 30px;
    }

    .header h1 {
        font-weight: 600;
        font-size: 20px;
        text-decoration: underline;
        color: #021b41;
        margin: 0;
        padding: 0;
    }

      .table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        margin-top: 5px;
        margin-bottom: 10px;
    }

    .table th,
    .table td {
        font-size: 12px;
        border: 1px solid #444;
        padding: 6px 8px;
        vertical-align: top;
        text-align: left;
        word-wrap: break-word;
    }

    .table th {
        background-color: #f2f2f2;
        font-weight: 700;
    }

    /* Alternar color filas */
    .table tr:nth-child(even) td {
        background-color: #fafafa;
    }
</style>

<body>
    <div class="logo">
        <img width="120" src="{{ public_path('assets/img/escudo.png') }}" alt="">

    </div>
    <div align="center" class="header">
        <h1><u> Detalle de Demandas</u></h1>

    </div>
    <table class="table ">
        <tbody>
            <tr>
                <td> <strong>Nombre Completo:</strong> {{ $affiliate->user->full_name }}</td>
                <td><strong>Matrícula:</strong> {{ $affiliate->id }}</td>
                <td> <strong>C.I:</strong> {{ $affiliate->user->ci }}</td>
            </tr>
            <tr>
                <td colspan="1">
                    <strong>
                        Teléfonos:
                    </strong>
                    @foreach ($affiliate->user->phones as $phone)
                        <span>{{ $phone->number }}</span>
                    @endforeach
                </td>
                <td colspan="2"><strong>Correo electrónico:</strong>
                    {{ $affiliate->user->email }}</td>
            </tr>
            <tr>
                <td colspan="3"><strong>Dirección de
                        domicilio:</strong>
                    {{ $affiliate->address_home . ' No ' . $affiliate->address_number_home . ' / ' . $affiliate->zone_home }}
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <strong>
                        Dirección procesal:
                    </strong>
                    {{ $affiliate->address_office . ' No ' . $affiliate->address_number . ' / ' . $affiliate->zone }}
                </td>
            </tr>
        </tbody>
    </table>


    <table border="1" style="width: 100%"  >
        @forelse ($affiliate->demands->chunk(2) as $demandChunk)
            <tr  style="border: none">
                @foreach ($demandChunk as $demand)
                    <td  style="width: 50%; vertical-align: top; padding: 0px;border: none">
                        <table class="table" style=" margin: 0px;">
                            <tr >
                                <th colspan="2" align="center" >{{ $demand->name }}</th>
                            </tr>
                            <tr>
                                <td align="center">Fecha de denuncia <br>{{ $demand->date }}</td>
                                <td align="center">Fecha de registro <br>{{ $demand->created_at }}</td>
                            </tr>
                            <tr>
                                <th colspan="2">Denunciante: {{ $demand->complainant }}</th>
                            </tr>
                            <tr>
                                <th colspan="2">Contancto: {{ $demand->phone }}</th>

                            </tr>
                            <tr>
                                <th>Estado</th>
                                <td>{{ $demand->status }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">Descripción:<br>{{ $demand->description }}</td>
                            </tr>
                        </table>
                    </td>
                @endforeach
            </tr>

        @empty
            <div class="alert alert-info text-center rounded-3 py-3 shadow-sm">
                <i class="fa-regular fa-face-sad-tear"></i> No hay demandas registradas para este afiliado.
            </div>
        @endforelse
    </table>

</body>

</html>
