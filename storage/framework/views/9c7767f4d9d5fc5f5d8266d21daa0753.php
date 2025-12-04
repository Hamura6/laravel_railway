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
        <img width="50" src="data:image/jpeg;base64,<?php echo e($institutionLogo); ?>" alt="">

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
                            <td><?php echo e($affiliate->created_at); ?> </td>
                        </tr>
                        <tr>
                            <th>Matricula ICAP</th>
                            <td> <strong> <?php echo e($affiliate->id); ?></strong> </td>
                        </tr>
                        <tr>
                            <th>Matricula CONALAB</th>
                            <td><?php echo e($affiliate->enrollment_conalab); ?> </td>
                        </tr>
                        <tr>
                            <th>Matricula RPA</th>
                            <td><?php echo e($affiliate->enrollment_RPA); ?> </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <img class="img" width="150" height="150" src="<?php echo e($imageUser); ?>"
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
                <td colspan="5"><?php echo e($affiliate->user->last_name); ?></td>
            </tr>
            <tr>
                <th>Nombres</th>
                <td colspan="5"><?php echo e($affiliate->user->name); ?></td>
            </tr>
            <tr>
                <th>C.I</th>
                <td><?php echo e($affiliate->user->ci); ?></td>
                <th>Fecha de Nacimiento</th>
                <td><?php echo e($affiliate->user->birthdate); ?></td>
                <th>Lugar</th>
                <td><?php echo e($affiliate->place); ?></td>
            </tr>
            <tr>
                <th>Sexo</th>
                <td><?php echo e($affiliate->user->gender); ?></td>
                <th>Estado civil</th>
                <td><?php echo e($affiliate->user->martial_status); ?></td>
                <th>Deporte que practica</th>
                <td><?php echo e($affiliate->sport); ?></td>
            </tr>
            <tr>
                <th>Domicilio</th>
                <td><?php echo e($affiliate->address_home); ?></td>
                <th>No.</th>
                <td><?php echo e($affiliate->address_number_home); ?></td>
                <th>Zona</th>
                <td><?php echo e($affiliate->zone_home); ?></td>
            </tr>
        </table>
    </div>

    <div>
        <h2>2. Datos de Afiliado</h2>
        <table class="table">
            <tr>
                <th>Fecha de registro</th>
                <td><?php echo e($affiliate->created_at); ?></td>
                <th>Matricula ICAP:</th>
                <td><?php echo e($affiliate->id); ?></td>
                <th>Matricula CONALAP</th>
                <td><?php echo e($affiliate->enrollment_conalab); ?></td>
                <th>Matricula RPA</th>
                <td><?php echo e($affiliate->enrollment_RPA); ?></td>
            </tr>
            <tr>
                <th>Sede</th>
                <td><?php echo e($affiliate->sede); ?></td>
                <th>Ejercicio profesional</th>
                <td colspan="2"><?php echo e($affiliate->profession); ?>-<?php echo e($affiliate->profession_status); ?> </td>
                <th>Institucion</th>
                <td colspan="2"><?php echo e($affiliate->institution); ?></td>
            </tr>
            <tr>
                <th>Domicilio procesal</th>
                <td colspan="2"><?php echo e($affiliate->address_office); ?></td>
                <th>No.</th>
                <td><?php echo e($affiliate->address_number); ?></td>
                <th>Zona</th>
                <td colspan="2"><?php echo e($affiliate->zone); ?></td>
            </tr>
        </table>
    </div>

    <div>
        <h2>3. Datos Profesionales</h2>
        <table class="table">
            <tr>
                <th colspan="2">Universidad que cursó sus estudios en Derecho</th>
                <td colspan="4"><?php echo e($affiliate->university->name); ?></td>
            </tr>
            <tr>
                <th>Entidad</th>
                <td><?php echo e($affiliate->university->entity); ?></td>
                <th>Fecha de extensión del Título en Provisión Nacional</th>
                <td><?php echo e($affiliate->date); ?></td>
                <th>Número de título</th>
                <td><?php echo e($affiliate->number); ?></td>
            </tr>

        </table>
    </div>
    <div>
        <h2>4. Especializaciones</h2>
        <?php $__currentLoopData = $affiliate->professions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profession): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <table class="table">
                <tr>
                    <th>Especialización</th>
                    <td colspan="2"><?php echo e($profession->specialty->name); ?></td>
                    <th>Área</th>
                    <td colspan="2"><?php echo e($profession->area); ?></td>
                </tr>
                <tr>
                    <th>Fecha</th>
                    <td><?php echo e($profession->date); ?></td>
                    <th>Universidad</th>
                    <td colspan="3"><?php echo e($profession->university->name); ?></td>
                </tr>
            </table>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="firma">
        <hr style="width: 150px;">
        <h3>FIRMA </h3>
        <span style="font-size: 9px"><strong> NOTA.- POR FAVOR AL FIRMAR NO</strong> sobre pase la linea</span>
    </div>
</body>

</html>
<?php /**PATH D:\ICAPV4\ICAP\resources\views/pdf/form.blade.php ENDPATH**/ ?>