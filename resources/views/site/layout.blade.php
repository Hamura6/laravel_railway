<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>{{ $institution->initials ?? 'ICAP' }} </title>
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
                        <a class="login-button" href="{{ route('settings.profile') }}">
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
                <a class="my-nav-link {{ Route::is('home') ? 'active' : '' }}" href="{{ route('home') }}">
                    <i class="fas fa-home"></i> Inicio
                </a>
                <a class="my-nav-link {{ Route::is('site.news') ? 'active' : '' }}" href="{{ route('site.news') }}">
                    <i class="fas fa-newspaper"></i> Noticias
                </a>
                <a class="my-nav-link {{ Route::is('site.events') ? 'active' : '' }}"
                    href="{{ route('site.events') }}">
                    <i class="fas fa-calendar-check"></i> Eventos
                </a>
                <a class="my-nav-link {{ Route::is('site.courses') ? 'active' : '' }}"
                    href="{{ route('site.courses') }}">
                    <i class="fa fa-book"></i> Cursos
                </a>
                <a class="my-nav-link {{ Route::is('site.agreements') ? 'active' : '' }}"
                    href="{{ route('site.agreements') }}">
                    <i class="fa fa-users"></i> Convenios
                </a>

                <!-- Dropdown -->
                <div class="my-nav-dropdown">
                    <div class="my-nav-link my-nav-dropdown-toggle">
                        <i class="fas fa-city"></i> Infraestructura
                    </div>
                    <ul class="my-nav-dropdown-menu">
                        <li>
                            <a class="my-nav-dropdown-menu-item" href="{{ route('site.directory') }}"><i
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
                <a class="my-nav-link {{ Route::is('site.requirement') ? 'active' : '' }}"
                    href="{{ route('site.requirement') }}">
                    <i class="fa fa-clipboard"></i> Requisitos
                </a>



                <a class="my-nav-link {{ Route::is('site.about') ? 'active' : '' }}" href="{{ route('site.about') }}">
                    <i class="fa fa-info-circle"></i> Acerca de
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
                        <li><i class="fa fa-envelope"></i> {{ $institution->email ?? 'susano' }}</li>
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
