<html>

<head>

</head>
<style>
    .logo img {
        position: absolute;
        top: -40px;
        left: -20px;
    }

    .header h1 {
        top: 20px;
        font-weight: 300
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

    th,
    td {
        font-size: 12px;
        border: 1px solid #444;
        padding: 6px 8px;
        vertical-align: top;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    tr:nth-child(even) td {
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
    <table class="table">
        <tr>
            <td colspan="2"><strong>INSTITUCION:</strong> Ilustre colegio de abogados </td>
            <td><strong>GESTION:
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                </strong></td>

        </tr>
        <tr>
            <td><strong>Masculino:</strong> {{ $masculino }} </td>
            <td><strong>Femenino:</strong> {{ $femenino }} </td>
            <td rowspan="2" class="text-center"> <strong class="fs-6"> {{-- {{ $affiliates->total() }} --}}</strong>
                <br><strong>Total</strong>
            </td>
        </tr>
        <tr>
            <td colspan="2"><strong>Rango de edad:</strong> De {{-- {{ $this->minor }} a {{ $this->max }} anos de
                edad --}}
            </td>
        </tr>

    </table>
    <table class="table">
        <thead>
            <th>#</th>
            <th>Nombres Completo</th>
            <th>Edad</th>
            <th>Correo Electronico</th>
            <th>Genero</th>
            <th>Telefono</th>
        </thead>
        <tbody>
            @forelse ($affiliates as $affiliate)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $affiliate['full_name'] }}
                    </td>
                    <td>
                        {{ $affiliate['age'] }}
                    </td>
                    <td>

                        {{ $affiliate['email'] }}

                    </td>
                    <td>

                        {{ $affiliate['gender'] }}

                    </td>
                    <td>
                        $affiliate->phones
                    </td>
                </tr>
            @empty
            @endforelse
        </tbody>

    </table>

</body>

</html>
