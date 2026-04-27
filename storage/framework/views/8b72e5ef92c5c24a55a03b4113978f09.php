<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Reconocimiento</title>
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
        <img width="50" src="data:image/jpeg;base64,<?php echo e($institutionLogo); ?>" alt="">

    </div>
    <h2> <u><?php echo e(__($recognition->type)); ?></u></h2>

    <table class="info-table">
        <tr>
            <th>Fecha</th>
            <td><?php echo e($recognition->date); ?></td>
        </tr>
        <tr>
            <th>Cantidad de participantes</th>
            <td><?php echo e($recognition->affiliates->count()); ?></td>
        </tr>
        <tr>
            <th>Tiempo restante</th>
            <td><?php echo e($recognition->remaining_days); ?></td>
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
            <?php $__empty_1 = true; $__currentLoopData = $recognition->affiliates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $affiliate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($i + 1); ?></td>
                    <td><?php echo e($affiliate->id); ?></td>
                    <td><?php echo e($affiliate->user->title); ?> <?php echo e($affiliate->user->name); ?> <?php echo e($affiliate->user->last_name); ?></td>
                    <td><?php echo e($affiliate->antique); ?></td>
                    <td><?php echo e($affiliate->created_at); ?></td>
                    <td><?php echo e(optional($affiliate->user->phones->first())->number ?? 'N/A'); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="text-center">No hay afiliados registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>

</html>
<?php /**PATH /var/www/icapProject/resources/views/pdf/listAffliate.blade.php ENDPATH**/ ?>