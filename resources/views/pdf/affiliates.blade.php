<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: sans-serif; font-size: 11px;">
    <h2>Reporte de Afiliados</h2>
    <p><strong>Total Masculino:</strong> {{ $masculino }}</p>
    <p><strong>Total Femenino:</strong> {{ $femenino }}</p>
    <p><strong>Total registros:</strong> {{ count($affiliates) }}</p>

    <table style="width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 11px;">
        <thead>
            <tr>
                <th style="border: 1px solid #000; padding: 5px; text-align: left; background-color: #f9f9f9;">#</th>
                <th style="border: 1px solid #000; padding: 5px; text-align: left; background-color: #f9f9f9;">Nombre completo</th>
                <th style="border: 1px solid #000; padding: 5px; text-align: left; background-color: #f9f9f9;">Edad</th>
                <th style="border: 1px solid #000; padding: 5px; text-align: left; background-color: #f9f9f9;">Correo</th>
                <th style="border: 1px solid #000; padding: 5px; text-align: left; background-color: #f9f9f9;">Género</th>
                <th style="border: 1px solid #000; padding: 5px; text-align: left; background-color: #f9f9f9;">Teléfonos</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($affiliates as $index => $affiliate)
                <tr>
                    <td style="border: 1px solid #000; padding: 5px;">{{ $index + 1 }}</td>
                    <td style="border: 1px solid #000; padding: 5px;">{{ $affiliate['full_name'] }}</td>
                    <td style="border: 1px solid #000; padding: 5px;">{{ $affiliate['age'] }}</td>
                    <td style="border: 1px solid #000; padding: 5px;">{{ $affiliate['email'] }}</td>
                    <td style="border: 1px solid #000; padding: 5px;">{{ $affiliate['gender'] }}</td>
                    <td style="border: 1px solid #000; padding: 5px;"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
