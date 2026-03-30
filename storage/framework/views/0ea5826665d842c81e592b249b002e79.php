<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        <?php echo e($institution->initials ? $institution->initials . ' | ' . $institution->name : 'ICAP | Ilustre Colegio de Abogados'); ?>

    </title>

    <meta name="description" content=" <?php echo e($institution->name ?? 'Ilustre Colegio de Abogados ICAP.'); ?>">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo e(url()->current()); ?>">

    <meta property="og:title" content="<?php echo e($institution->initials ?? 'ICAP'); ?>">
    <meta property="og:description" content="<?php echo e($institution->name ?? 'Ilustre Colegio de Abogados ICAP.'); ?>">
    <meta property="og:image" content="<?php echo e($institution->image); ?> ">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:type" content="website">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo e($institution->initials ?? 'ICAP'); ?>">
    <meta name="twitter:description" content="<?php echo e($institution->name ?? 'Ilustre Colegio de Abogados ICAP.'); ?>">
    <meta name="twitter:image" content="<?php echo e($institution->image); ?>">

    <link rel="icon" type="image/png" href="<?php echo e($institution->image); ?>">

    <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/landing-pages.scss', 'resources/js/app.js']); ?>
</head>

<body>

    <header class="site-header">
        <div class="header-wrapper" id="start">
            <!-- LOGO -->
            <a class="header-logo" href="<?php echo e(route('home')); ?>">
                <img alt="Logo ICAP" src="<?php echo e($institution->image ?? 'logo'); ?>">
                <div class="header-title">
                    <?php echo e($institution->initials ?? 'ICAP'); ?>

                    <div class="slogan"><?php echo e($institution->name ?? 'ILUSTRE COLEGIO DE ABOGADOS'); ?></div>
                </div>
            </a>

            <!-- CONTACTO + LOGIN -->
            <div class="header-info">
                <div class="header-contacts">
                    <a href="#"><i class="fas fa-phone"></i> (+591) <?php echo e($institution->phone ?? '0000'); ?></a>
                    <a href="#"><i class="fas fa-at"></i> <?php echo e($institution->email ?? 'icap@gmail.com'); ?></a>
                </div>

                <?php if(auth()->guard()->check()): ?>
                    <div class="header-login">
                        <a class="login-button" href="<?php echo e(route('home.index')); ?>">
                            <i class="fas fa-user"></i> Acceder
                        </a>
                    </div>
                <?php else: ?>
                    <div class="header-login">
                        <?php if(!Route::is('login')): ?>
                            <a class="login-button" href="<?php echo e(route('login')); ?>">
                                <i class="fas fa-sign-in-alt"></i> Iniciar sesión
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
                <div class="my-nav-dropdown">
                    <div class="my-nav-link my-nav-dropdown-toggle">
                        <i class="fas fa-home"></i> <?php echo e($institution->initials); ?>

                    </div>
                    <ul class="my-nav-dropdown-menu">

                        <li>
                            <a class="my-nav-dropdown-menu-item" href="<?php echo e(route('site.about')); ?>">
                                <i class="fa fa-info-circle"></i> Acerca de Nosotros</a>
                        </li>
                        <li>
                            <a class="my-nav-dropdown-menu-item" href="<?php echo e(route('site.directory')); ?>">
                                <i class="fas fa-users"></i> Organización</a>
                        </li>
                        <li>
                            <a class="my-nav-dropdown-menu-item" href="<?php echo e(route('site.privacy')); ?>">
                                <i class="fas fa-lock"></i> Politicas de Privacidad</a>
                        </li>
                    </ul>
                </div>
                <div class="my-nav-dropdown">
                    <div class="my-nav-link my-nav-dropdown-toggle">
                        <i class="fas fa-external-link-alt"></i> Información
                    </div>
                    <ul class="my-nav-dropdown-menu">
                        <li>
                            <a class="my-nav-dropdown-menu-item" href="<?php echo e(route('site.news')); ?>">
                                <i class="fas fa-newspaper"></i> Noticias</a>
                        </li>
                        <li>
                            <a class="my-nav-dropdown-menu-item" href="<?php echo e(route('site.facebook')); ?>">
                                <i class="fab fa-facebook-square"></i> Facebook</a>
                        </li>
                        <li>
                            <a class="my-nav-dropdown-menu-item" href="<?php echo e(route('site.agreements')); ?>">
                                <i class="fas fa-handshake"></i> Convenios</a>
                        </li>
                    </ul>
                </div>
                <a class="my-nav-link <?php echo e(Route::is('site.courses') ? 'active' : ''); ?>"
                    href="<?php echo e(route('site.courses')); ?>">
                    <i class="fa fa-book"></i> Cursos
                </a>

                <a class="my-nav-link <?php echo e(Route::is('site.events') ? 'active' : ''); ?>"
                    href="<?php echo e(route('site.events')); ?>">
                    <i class="fas fa-calendar-check"></i> Eventos
                </a>
                <a class="my-nav-link"
                    href="https://kuula.co/share/collection/7cMDT?logo=1&info=1&fs=1&vr=0&zoom=1&autorotate=0.24&autopalt=1&thumbs=1&margin=15&inst=es"><i
                        class="fas fa-hospital"></i>
                    Establecimiento
                </a>
                <a class="my-nav-link <?php echo e(Route::is('site.requirement') ? 'active' : ''); ?>"
                    href="<?php echo e(route('site.requirement')); ?>">
                    <i class="fa fa-clipboard"></i> Requisitos de Admisión
                </a>



                <?php if(auth()->guard()->check()): ?>
                    <a class="my-nav-link movil_link <?php echo e(Route::is('settings.profile') ? 'active' : ''); ?>"
                        href="<?php echo e(route('settings.profile')); ?>"> <i class="fas fa-user"></i> Acceder
                    </a>
                <?php else: ?>
                    <?php if(!Route::is('login')): ?>
                        <a class="my-nav-link movil_link <?php echo e(Route::is('login') ? 'active' : ''); ?>"
                            href="<?php echo e(route('login')); ?>"> <i class="fas fa-sign-in-alt"></i> Iniciar sesión
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
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
                        <li><i class="fa fa-map-marker-alt"></i> <?php echo e($institution->address ?? 'city'); ?></li>
                        <li><i class="fa fa-phone-alt"></i> (+591)<?php echo e($institution->phone ?? 'mercurio'); ?></li>
                        <li><i class="fa fa-envelope"></i> <?php echo e($institution->email); ?></li>
                    </ul>

                    <div class="footer-socials">
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a
                            href="https://www.facebook.com/p/Ilustre-Colegio-de-Abogados-de-Potos%C3%AD-100075585267932/"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </section>
        </div>

        <nav class="footer-nav">
            <a href="<?php echo e(route('site.privacy')); ?>">Política de privacidad</a>
            <a href="#">Cookies</a>
            <a href="#">Ayuda</a>
        </nav>

        <div class="footer-credits">
            <p>&copy; <span id="year"></span> ICAP Potosi. Todos los derechos reservados.</p>
            
        </div>
    </footer>

    <a class="back-to-top" href="#start">
        <i class="fa fa-chevron-up"></i>
    </a>
    <div id="cookie-banner"
        style="position:fixed;bottom:0;background:#222;color:#fff;padding:10px;width:100%;text-align:center;">
        Usamos cookies para mejorar tu experiencia.
        <button onclick="aceptarCookies()">Aceptar</button>
    </div>

    <script>
        function aceptarCookies() {
            document.getElementById("cookie-banner").style.display = "none";
            document.cookie = "cookies_aceptadas=true; path=/";
        }
    </script>
    <script>
        if (document.cookie.includes("cookies_aceptadas=true")) {
            document.getElementById("cookie-banner").style.display = "none";
        }
    </script>
</body>

</html>
<?php /**PATH D:\ICAPV4\ICAP\resources\views/site/layout.blade.php ENDPATH**/ ?>