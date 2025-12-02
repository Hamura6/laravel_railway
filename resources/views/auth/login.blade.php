<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>{{ $institution->initials ?? 'ICAP' }} </title>
    @vite(['resources/sass/landing-pages.scss', 'resources/js/app.js'])
</head>

<body>

    <header class="site-header" id="start">
        <div class="header-wrapper">
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
                            Acceder
                        </a>
                    </div>
                @else
                    <div class="header-login">
                        @if (!Route::is('login'))
                            <a class="login-button" href="{{ route('login') }}">
                                Iniciar sesión
                            </a>
                        @endif
                    </div>
                @endauth

            </div>
        </div>
    </header>
    <div class="wrapper">
        <section class=" section section-color-2" style="margin: 0px 0;padding:3rem 0">
            <div class="section-container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
                <div class="card shadow-lg" style="width: 100%; max-width: 530px; border-radius: 12px; padding: 15px;">

                    <div align="center" class="row g-1">
                        <div class="text-center mb-3 col-md-12 mt-3">
                            <h3 class="login-title">{{ $institution->name ?? 'ILUSTRE COLEGIO DE ABOGADOS' }}
                            </h3>
                            <img src="{{ $institution->image ?? 'logo' }}" alt="Logo Colegio" style="height: 150px;">
                        </div>

                        <div class="section-header text-center col-md-12 mb-2">
                            <h2 class="section-title fs-4 text-secondary">Iniciar sesión</h2>
                        </div>
                    </div>
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div style="display: flex; justify-content: center;">
                        <form style="min-width: 100%;" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                            name="email" id="email" value="{{ old('email') }}"
                                            required autofocus autocomplete="email">
                                        <label for="email"><i class="fas fa-envelope"></i> Correo
                                            electronico</label>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            id="password" placeholder="..." autocomplete="current-password">
                                        <label for="password"> <i class="fas fa-key"></i>
                                            {{ __('Password') }}
                                        </label>
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check mb-3 text-start">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="d-grid gap-2 col-8 mx-auto">
                                    <button type="submit" class="btn btn-primary">Ingresar</button>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link mt-3" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </section>

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
