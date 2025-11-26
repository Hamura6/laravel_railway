<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title><?php echo e($institution->initials); ?> </title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/app.scss', 'resources/js/app.js']); ?>
</head>

<body>

    <header class="site-header">
        <div class="header-wrapper" id="start">
            <!-- LOGO -->
            <a class="header-logo" href="<?php echo e(route('home')); ?>">
                <img alt="Logo ICAP" src="<?php echo e($institution->image); ?>">
                <div class="header-title">
                    <?php echo e($institution->initials); ?>

                    <div class="slogan"><?php echo e($institution->name); ?></div>
                </div>
            </a>

            <!-- CONTACTO + LOGIN -->
            <div class="header-info">
                <div class="header-contacts">
                    <a href="#"><i class="fas fa-phone"></i> (+591) <?php echo e($institution->phone); ?></a>
                    <a href="#"><i class="fas fa-at"></i> <?php echo e($institution->email); ?></a>
                </div>

                <?php if(auth()->guard()->check()): ?>
                    <div class="header-login">
                        <a class="login-button" href="<?php echo e(route('dashboard.index')); ?>">
                            Dashboard
                        </a>
                    </div>
                <?php else: ?>
                    <div class="header-login">
                        <?php if(!Route::is('login')): ?>
                            <a class="login-button" href="<?php echo e(route('login')); ?>">
                                Iniciar sesión
                            </a>
                        <?php endif; ?>
                        
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </header>

    <nav class="site-nav">
        <div class="nav-wrapper">
            <div class="nav-header">
                <a class="nav-logo" href="<?php echo e(route('home')); ?>">MENÚ</a>
                <button aria-label="Abrir menú" class="nav-toggle" type="button">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <div class="nav-menu" id="mainNav">
                <a class="my-nav-link <?php echo e(Route::is('home') ? 'active' : ''); ?>" href="<?php echo e(route('home')); ?>">
                    <i class="fas fa-home"></i> Inicio
                </a>
                <a class="my-nav-link <?php echo e(Route::is('site.news') ? 'active' : ''); ?>" href="<?php echo e(route('site.news')); ?>">
                    <i class="fas fa-newspaper"></i> Noticias
                </a>
                <a class="my-nav-link <?php echo e(Route::is('site.events') ? 'active' : ''); ?>"
                    href="<?php echo e(route('site.events')); ?>">
                    <i class="fas fa-calendar-check"></i> Eventos
                </a>
                <a class="my-nav-link <?php echo e(Route::is('site.courses') ? 'active' : ''); ?>"
                    href="<?php echo e(route('site.courses')); ?>">
                    <i class="fa fa-book"></i> Cursos
                </a>
                <a class="my-nav-link <?php echo e(Route::is('site.agreements') ? 'active' : ''); ?>"
                    href="<?php echo e(route('site.agreements')); ?>">
                    <i class="fa fa-users"></i> Convenios
                </a>

                <!-- Dropdown -->
                <div class="my-nav-dropdown">
                    <div class="my-nav-link my-nav-dropdown-toggle">
                        <i class="fas fa-city"></i> Infraestructura
                    </div>
                    <ul class="my-nav-dropdown-menu">
                        <li>
                            <a class="my-nav-dropdown-menu-item" href="<?php echo e(route('site.directory')); ?>"><i
                                    class="fas fa-users"></i>
                                Organizacion</a>
                        </li>
                        <li>
                            <a class="my-nav-dropdown-menu-item"
                                href="https://kuula.co/share/collection/7cMDT?logo=1&info=1&fs=1&vr=0&zoom=1&autorotate=0.24&autopalt=1&thumbs=1&margin=15&inst=es"><i
                                    class="fas fa-hospital"></i>
                                Establecimiento</a>
                        </li>
                    </ul>
                </div>
                <a class="my-nav-link <?php echo e(Route::is('site.requirement') ? 'active' : ''); ?>"
                    href="<?php echo e(route('site.requirement')); ?>">
                    <i class="fa fa-clipboard"></i> Requisitos
                </a>
                <a class="my-nav-link <?php echo e(Route::is('site.about') ? 'active' : ''); ?>"
                    href="<?php echo e(route('site.about')); ?>">
                    <i class="fa fa-info-circle"></i> Acerca de
                </a>
            </div>
        </div>
    </nav>

    <div class="wrapper">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <footer class="site-footer">
        <div class="footer-wrapper">
            <!-- Acerca de -->
            <section class="footer-info">
                <h2 class="footer-title">Acerca de</h2>
                <p class="footer-text">
                    El Ilustre Colegio de Abogados de Potosí (ICAP) ofrece servicios especializados en derecho y
                    asesoría legal. Organizamos talleres y seminarios sobre temas legales actuales. Puede
                    contactarnos para el desarrollo de cualquier proyecto legal, ya sea académico o comercial.
                </p>
            </section>

            <!-- Enlaces -->
            <section class="footer-sections">
                <div class="footer-block">
                    <h2 class="footer-title">Áreas de servicio</h2>
                    <ul class="footer-list">
                        <li><a href="<?php echo e(route('site.courses')); ?>">Educación</a></li>
                    </ul>
                </div>

                <div class="footer-block">
                    <h2 class="footer-title">Páginas útiles</h2>
                    <ul class="footer-list">
                        <li><a href="<?php echo e(route('site.about')); ?>">Acerca de</a></li>
                        <li><a href="<?php echo e(route('site.news')); ?>">Noticias</a></li>
                        <li><a href="<?php echo e(route('site.courses')); ?>">Cursos</a></li>
                        <li><a href="<?php echo e(route('site.events')); ?>">Eventos</a></li>
                    </ul>
                </div>

                <div class="footer-contact">
                    <h2 class="footer-title">Contáctanos</h2>
                    <ul class="footer-contact-list">
                        <li><i class="fa fa-map-marker-alt"></i> <?php echo e($institution->address); ?></li>
                        <li><i class="fa fa-phone-alt"></i> (+591)<?php echo e($institution->phone); ?></li>
                        <li><i class="fa fa-envelope"></i> <?php echo e($institution->email); ?></li>
                    </ul>

                    <div class="footer-socials">
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </section>
        </div>

        <nav class="footer-nav">
            <a href="#">Términos de uso</a>
            <a href="#">Política de privacidad</a>
            <a href="#">Cookies</a>
            <a href="#">Ayuda</a>
        </nav>

        <div class="footer-credits">
            <p>&copy; <span id="year"></span> ICAP Potosi. Todos los derechos reservados.</p>
            <p>Diseño y desarrollo web por <a href="#" target="_blank">Hamura Código</a></p>
        </div>
    </footer>

    <a class="back-to-top" href="#start">
        <i class="fa fa-chevron-up"></i>
    </a>

</body>

</html>
<?php /**PATH D:\ICAPV4\ICAP\resources\views/site/layout.blade.php ENDPATH**/ ?>