<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        {{ $institution->initials ? $institution->initials . ' | ' . $institution->name : 'ICAP | Ilustre Colegio de Abogados' }}
    </title>

    <meta name="description" content=" {{ $institution->name ?? 'Ilustre Colegio de Abogados ICAP.' }}">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:title" content="{{ $institution->initials ?? 'ICAP' }}">
    <meta property="og:description" content="{{ $institution->name ?? 'Ilustre Colegio de Abogados ICAP.' }}">
    <meta property="og:image" content="{{ $institution->image }} ">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $institution->initials ?? 'ICAP' }}">
    <meta name="twitter:description" content="{{ $institution->name ?? 'Ilustre Colegio de Abogados ICAP.' }}">
    <meta name="twitter:image" content="{{ $institution->image }}">

    <link rel="icon" type="image/png" href="{{ $institution->image }}">

    @vite(['resources/sass/landing-pages.scss', 'resources/js/app.js'])
</head>

<body>

    <header class="site-header">
        <div class="header-wrapper" id="start">
            <!-- LOGO -->
            <a class="header-logo" href="{{ route('home') }}">
                <img alt="Logo ICAP" src="{{ $institution->image ?? 'logo' }}">
                <div class="header-title">
                    {{ $institution->initials ?? 'ICAP' }}
                    <div class="slogan">{{ $institution->name ?? 'ILUSTRE COLEGIO DE ABOGADOS' }}</div>
                </div>
            </a>

            <!-- CONTACTO + LOGIN -->
            <div class="header-info">
                <div class="header-contacts">
                    <a href="#"><i class="fas fa-phone"></i> (+591) {{ $institution->phone ?? '0000' }}</a>
                    <a href="#"><i class="fas fa-at"></i> {{ $institution->email ?? 'icap@gmail.com' }}</a>
                </div>

                @auth
                    <div class="header-login">
                        <a class="login-button" href="{{ route('home.index') }}">
                            <i class="fas fa-user"></i> Acceder
                        </a>
                    </div>
                @else
                    <div class="header-login">
                        @if (!Route::is('login'))
                            <a class="login-button" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i> Iniciar sesión
                            </a>
                        @endif
                    </div>
                @endauth

            </div>
        </div>
    </header>

    <nav class="site-nav">
        <div class="nav-wrapper">
            <div class="nav-header">
                <a class="nav-logo" href="{{ route('home') }}">MENÚ</a>
                <button aria-label="Abrir menú" class="nav-toggle" type="button">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <div class="nav-menu" id="mainNav">
                <div class="my-nav-dropdown">
                    <div class="my-nav-link my-nav-dropdown-toggle">
                        <i class="fas fa-home"></i> {{ $institution->initials }}
                    </div>
                    <ul class="my-nav-dropdown-menu">

                        <li>
                            <a class="my-nav-dropdown-menu-item" href="{{ route('site.about') }}">
                                <i class="fa fa-info-circle"></i> Acerca de Nosotros</a>
                        </li>
                        <li>
                            <a class="my-nav-dropdown-menu-item" href="{{ route('site.directory') }}">
                                <i class="fas fa-users"></i> Organización</a>
                        </li>
                        <li>
                            <a class="my-nav-dropdown-menu-item" href="{{ route('site.privacy') }}">
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
                            <a class="my-nav-dropdown-menu-item" href="{{ route('site.news') }}">
                                <i class="fas fa-newspaper"></i> Noticias</a>
                        </li>
                        <li>
                            <a class="my-nav-dropdown-menu-item" href="{{ route('site.facebook') }}">
                                <i class="fab fa-facebook-square"></i> Facebook</a>
                        </li>
                        <li>
                            <a class="my-nav-dropdown-menu-item" href="{{ route('site.agreements') }}">
                                <i class="fas fa-handshake"></i> Convenios</a>
                        </li>
                    </ul>
                </div>
                <a class="my-nav-link {{ Route::is('site.courses') ? 'active' : '' }}"
                    href="{{ route('site.courses') }}">
                    <i class="fa fa-book"></i> Cursos
                </a>

                <a class="my-nav-link {{ Route::is('site.events') ? 'active' : '' }}"
                    href="{{ route('site.events') }}">
                    <i class="fas fa-calendar-check"></i> Eventos
                </a>
                <a class="my-nav-link"
                    href="https://kuula.co/share/collection/7cMDT?logo=1&info=1&fs=1&vr=0&zoom=1&autorotate=0.24&autopalt=1&thumbs=1&margin=15&inst=es"><i
                        class="fas fa-hospital"></i>
                    Establecimiento
                </a>
                <a class="my-nav-link {{ Route::is('site.requirement') ? 'active' : '' }}"
                    href="{{ route('site.requirement') }}">
                    <i class="fa fa-clipboard"></i> Requisitos de Admisión
                </a>



                @auth
                    <a class="my-nav-link movil_link {{ Route::is('settings.profile') ? 'active' : '' }}"
                        href="{{ route('settings.profile') }}"> <i class="fas fa-user"></i> Acceder
                    </a>
                @else
                    @if (!Route::is('login'))
                        <a class="my-nav-link movil_link {{ Route::is('login') ? 'active' : '' }}"
                            href="{{ route('login') }}"> <i class="fas fa-sign-in-alt"></i> Iniciar sesión
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>

    <div class="wrapper">
        @yield('content')
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
                        <li><a href="{{ route('site.courses') }}">Educación</a></li>
                    </ul>
                </div>

                <div class="footer-block">
                    <h2 class="footer-title">Páginas útiles</h2>
                    <ul class="footer-list">
                        <li><a href="{{ route('site.about') }}">Acerca de</a></li>
                        <li><a href="{{ route('site.news') }}">Noticias</a></li>
                        <li><a href="{{ route('site.courses') }}">Cursos</a></li>
                        <li><a href="{{ route('site.events') }}">Eventos</a></li>
                    </ul>
                </div>

                <div class="footer-contact">
                    <h2 class="footer-title">Contáctanos</h2>
                    <ul class="footer-contact-list">
                        <li><i class="fa fa-map-marker-alt"></i> {{ $institution->address ?? 'city' }}</li>
                        <li><i class="fa fa-phone-alt"></i> (+591){{ $institution->phone ?? 'mercurio' }}</li>
                        <li><i class="fa fa-envelope"></i> {{ $institution->email }}</li>
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
            <a href="{{ route('site.privacy') }}">Política de privacidad</a>
            <a href="#">Cookies</a>
            <a href="#">Ayuda</a>
        </nav>

        <div class="footer-credits">
            <p>&copy; <span id="year"></span> ICAP Potosi. Todos los derechos reservados.</p>
            {{--             <p>Diseño y desarrollo web por <a href="#" target="_blank">Hamura Código</a></p>
 --}}
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
