<?php $__env->startSection('content'); ?>
    <!-- Banner -->
    <div class="banner">
        <img class="img-banner" src="<?php echo e(asset('image/s5.jpg')); ?>" alt="Cursos">
        <div class="banner-content">
            <h2 class="title-banner"> POLÍTICA DE PRIVACIDAD</h2>
        </div>
    </div>


    <!-- Responsable del tratamiento -->
    <section class="section section-color-1">
        <div class="section-container">
            <div class="section-header">
                <div class="section-title"><i class="fas fa-user-shield"></i> Responsable del Tratamiento</div>
                <p class="section-subtitle">
                    El Ilustre Colegio de Abogados de Potosí (ICAP), con Dirección Calle Lanza N° 29, Potosí, Bolivia, es
                    responsable del tratamiento de los datos personales recopilados a través de sus actividades
                    institucionales.
                </p>
            </div>
        </div>
    </section>

    <!-- Finalidad del tratamiento -->
    <section class="section section-color-2">
        <div class="section-container">
            <div class="section-header">
                <div class="section-title"><i class="fas fa-bullseye"></i> Finalidad del Tratamiento</div>
                <p class="section-subtitle">
                    Los datos personales serán utilizados únicamente para fines institucionales, administrativos y de
                    comunicación,
                    incluyendo el envío de información sobre eventos, servicios y novedades relacionadas con el ICAP, así
                    como la gestión de cuentas de usuario en caso de inicio de sesión.
                </p>
            </div>
        </div>
    </section>

    <!-- Uso y transferencia de datos -->
    <section class="section section-color-1">
        <div class="section-container">
            <div class="section-header">
                <div class="section-title"><i class="fas fa-exchange-alt"></i> Uso y Transferencia de Datos</div>
                <p class="section-subtitle">
                    Los datos podrán ser compartidos dentro y fuera de Bolivia exclusivamente con miembros o áreas
                    autorizadas del ICAP, respetando siempre su finalidad.
                </p>
            </div>
        </div>
    </section>

    <!-- Protección de la información -->
    <section class="section section-color-2">
        <div class="section-container">
            <div class="section-header">
                <div class="section-title"><i class="fas fa-shield-alt"></i> Protección de la Información</div>
                <p class="section-subtitle">
                    El ICAP aplica medidas de seguridad para proteger los datos personales y restringe su acceso únicamente
                    a personal autorizado. No obstante, no se responsabiliza por ataques externos o situaciones fuera de su
                    control.
                </p>
            </div>
        </div>
    </section>

    <!-- Tipos de datos -->
    <section class="section section-color-1">
        <div class="section-container">
            <div class="section-header">
                <div class="section-title"><i class="fas fa-database"></i> Tipos de Datos</div>
                <ul class="section-subtitle" style="text-align: left;">
                    <li>Datos personales (identificación general).</li>
                    <li>Datos sensibles (salud, ideología, religión, etc.), los cuales reciben mayor protección.</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Cookies de sesión -->
    <section class="section section-color-2">
        <div class="section-container">
            <div class="section-header">
                <div class="section-title"><i class="fas fa-cookie-bite"></i> Cookies de Sesión</div>
                <p class="section-subtitle">
                    Para usuarios con cuenta, el sitio utiliza cookies necesarias para mantener la sesión iniciada de manera
                    segura. Estas cookies no se usan para seguimiento, publicidad ni análisis externo, y su único propósito
                    es garantizar que el acceso a la cuenta sea continuo y seguro.
                </p>
            </div>
        </div>
    </section>

    <!-- Derechos del usuario -->
    <section class="section section-color-1">
        <div class="section-container">
            <div class="section-header">
                <div class="section-title"><i class="fas fa-user-cog"></i> Derechos del Usuario</div>
                <ul class="section-subtitle" style="text-align: left;">
                    <li>Acceder a sus datos</li>
                    <li>Solicitar corrección o eliminación</li>
                    <li>Revocar su consentimiento</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Contacto -->
    <section class="section section-color-2">
        <div class="section-container">
            <div class="section-header">
                <div class="section-title"><i class="fas fa-envelope"></i> Contacto</div>
                <p class="section-subtitle">
                    Para ejercer estos derechos, puede escribir a:
                    <a href="<?php echo e($institution->email); ?>"><?php echo e($institution->email); ?></a>
                    o visitar <a href="https://srv1518912.hstgr.cloud" target="_blank">https://srv1518912.hstgr.cloud</a>
                </p>
            </div>
        </div>
    </section>

    <!-- Vigencia -->
    <section class="section section-color-1">
        <div class="section-container">
            <div class="section-header">
                <div class="section-title"><i class="fas fa-calendar-alt"></i> Vigencia</div>
                <p class="section-subtitle">
                    Esta política está vigente desde el 30 de marzo de 2026 y puede ser modificada en cualquier momento
                    según necesidades institucionales o cambios legales.
                </p>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/icapProject/resources/views/site/pages/privacy.blade.php ENDPATH**/ ?>