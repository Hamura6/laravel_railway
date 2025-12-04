<html>

<head>
    <title>Detalle de demandas</title>
</head>
<style>
    .logo {
        position: absolute;
        top: 20px;
        left: 40px;

    }

    .logo img {
        width: 50px;
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

    .profile {
        position: relative;
    }

    .profile .table-profile {
        border-collapse: collapse;
        margin: 10px;
    }

    .profile .table-profile th,
    .profile .table-profile td {
        border: 1px solid #444;
        padding: 6px 8px;
        text-align: left;
        vertical-align: middle;
    }

    .profile .table-profile th {
        background-color: #f2f2f2;
        font-weight: 700;
        width: 35%;
    }

    .profile .img {
        position: absolute;
        top: 20px;
        right: 60px;

    }

    h2 {
        color: rgb(2, 27, 65);
        margin-top: 5px;
        font-size: 14px;
        font-weight: bold;
        text-transform: uppercase;
        border-bottom: 1px solid #000;
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

    .firma {
        width: 100%;
        text-align: center;
        margin-top: 30px;
    }

    .firma hr,
    h3 {
        margin-top: 0px;
        margin-bottom: 0px;
        color: rgb(2, 27, 65);
    }

    .firma span {
        font-size: 8px;
        margin-top: 1px
    }
</style>


<body>
    <div class="logo">
        <img width="50" src="data:image/jpeg;base64,{{ $institutionLogo }}" alt="">

    </div>
    <div align="center" class="header">
        <h1><u> FORMULARIO DE INSCRIPCION</u></h1>

    </div>
    <div class="profile">
        <table style="border: none; border-collapse: collapse;">
            <tr>
                <td>
                    <table border="1" class="table-profile">
                        <tr>
                            <th>Fecha de Registro</th>
                            <td>{{ $affiliate->created_at }} </td>
                        </tr>
                        <tr>
                            <th>Matricula ICAP</th>
                            <td> <strong> {{ $affiliate->id }}</strong> </td>
                        </tr>
                        <tr>
                            <th>Matricula CONALAB</th>
                            <td>{{ $affiliate->enrollment_conalab }} </td>
                        </tr>
                        <tr>
                            <th>Matricula RPA</th>
                            <td>{{ $affiliate->enrollment_RPA }} </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <img class="img" width="150" height="150" src="{{ $imageUser }}"
                        alt="">
                </td>
            </tr>
        </table>


    </div>
    <div>
        <h2>1. Datos Personales</h2>
        <table class="table">
            <tr>
                <th>Apellidos</th>
                <td colspan="5">{{ $affiliate->user->last_name }}</td>
            </tr>
            <tr>
                <th>Nombres</th>
                <td colspan="5">{{ $affiliate->user->name }}</td>
            </tr>
            <tr>
                <th>C.I</th>
                <td>{{ $affiliate->user->ci }}</td>
                <th>Fecha de Nacimiento</th>
                <td>{{ $affiliate->user->birthdate }}</td>
                <th>Lugar</th>
                <td>{{ $affiliate->place }}</td>
            </tr>
            <tr>
                <th>Sexo</th>
                <td>{{ $affiliate->user->gender }}</td>
                <th>Estado civil</th>
                <td>{{ $affiliate->user->martial_status }}</td>
                <th>Deporte que practica</th>
                <td>{{ $affiliate->sport }}</td>
            </tr>
            <tr>
                <th>Domicilio</th>
                <td>{{ $affiliate->address_home }}</td>
                <th>No.</th>
                <td>{{ $affiliate->address_number_home }}</td>
                <th>Zona</th>
                <td>{{ $affiliate->zone_home }}</td>
            </tr>
        </table>
    </div>

    <div>
        <h2>2. Datos de Afiliado</h2>
        <table class="table">
            <tr>
                <th>Fecha de registro</th>
                <td>{{ $affiliate->created_at }}</td>
                <th>Matricula ICAP:</th>
                <td>{{ $affiliate->id }}</td>
                <th>Matricula CONALAP</th>
                <td>{{ $affiliate->enrollment_conalab }}</td>
                <th>Matricula RPA</th>
                <td>{{ $affiliate->enrollment_RPA }}</td>
            </tr>
            <tr>
                <th>Sede</th>
                <td>{{ $affiliate->sede }}</td>
                <th>Ejercicio profesional</th>
                <td colspan="2">{{ $affiliate->profession }}-{{ $affiliate->profession_status }} </td>
                <th>Institucion</th>
                <td colspan="2">{{ $affiliate->institution }}</td>
            </tr>
            <tr>
                <th>Domicilio procesal</th>
                <td colspan="2">{{ $affiliate->address_office }}</td>
                <th>No.</th>
                <td>{{ $affiliate->address_number }}</td>
                <th>Zona</th>
                <td colspan="2">{{ $affiliate->zone }}</td>
            </tr>
        </table>
    </div>

    <div>
        <h2>3. Datos Profesionales</h2>
        <table class="table">
            <tr>
                <th colspan="2">Universidad que cursó sus estudios en Derecho</th>
                <td colspan="4">{{ $affiliate->university->name }}</td>
            </tr>
            <tr>
                <th>Entidad</th>
                <td>{{ $affiliate->university->entity }}</td>
                <th>Fecha de extensión del Título en Provisión Nacional</th>
                <td>{{ $affiliate->date }}</td>
                <th>Número de título</th>
                <td>{{ $affiliate->number }}</td>
            </tr>

        </table>
    </div>
    <div>
        <h2>4. Especializaciones</h2>
        @foreach ($affiliate->professions as $profession)
            <table class="table">
                <tr>
                    <th>Especialización</th>
                    <td colspan="2">{{ $profession->specialty->name }}</td>
                    <th>Área</th>
                    <td colspan="2">{{ $profession->area }}</td>
                </tr>
                <tr>
                    <th>Fecha</th>
                    <td>{{ $profession->date }}</td>
                    <th>Universidad</th>
                    <td colspan="3">{{ $profession->university->name }}</td>
                </tr>
            </table>
        @endforeach
    </div>
    <div class="firma">
        <hr style="width: 150px;">
        <h3>FIRMA </h3>
        <span style="font-size: 9px"><strong> NOTA.- POR FAVOR AL FIRMAR NO</strong> sobre pase la linea</span>
    </div>
</body>

</html>
