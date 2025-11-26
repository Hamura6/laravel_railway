<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Index</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>

    <header class="site-header">
        <div class="header-wrapper">
            <!-- LOGO -->
            <a class="header-logo" href="{{ route('home') }}">
                <img alt="Logo ICAP" src="{{ asset('assets/img/logo.png') }}">
                <div class="header-title">
                    ICAP
                    <div class="slogan">ILUSTRE COLEGIO DE ABOGADOS DE POTOSÍ</div>
                </div>
            </a>

            <!-- CONTACTO + LOGIN -->
            <div class="header-info">
                <div class="header-contacts">
                    <a href="#"><i class="fas fa-phone"></i> (+591) 2 6225790</a>
                    <a href="#"><i class="fas fa-at"></i> icap.potosi@gmail.com</a>
                </div>

                @auth
                    <div class="header-login">
                        <a class="login-button" href="{{ route('dashboard.index') }}">
                            Dashboard
                        </a>
                    </div>
                @else
                    <div class="header-login">
                        @if (!Route::is('login'))
                            <a class="login-button" href="{{ route('login') }}">
                                Iniciar sesión
                            </a>
                        @endif
                        {{-- @if (Route::has('register'))
                <a class="login-button"
                   href="{{ route('register') }}">
                  Register
                </a>
              @endif --}}
                    </div>
                @endauth

            </div>
        </div>
    </header>
    <div class="wrapper">
        <section class=" section section-color-1" style="margin: 0px 0;padding:3rem 0">
            <div class="section-container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
                <div class="card shadow-lg" style="width: 100%; max-width: 530px; border-radius: 12px; padding: 15px;">

                    <!-- Cabecera: Título del colegio -->
                    <div align="center" class="row g-1">
                        <div class="text-center mb-3 col-md-12 mt-3">
                            <h3 class="fw-bold text-dark mb-2">ILUSTER COLEGIO DE ABOGADOS <br>POTOSI</h3>
                            <img src="{{ asset('assets/img/logo.png') }}"
                                alt="Logo Colegio" style="height: 150px;">
                        </div>

                        <!-- Título Iniciar sesión (manteniendo estilo original) -->
                        <div class="section-header text-center col-md-12 mb-2">
                            <h2 class="section-title fs-4 text-secondary">Iniciar sesión</h2>
                        </div>
                    </div>
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Formulario -->
                    <div style="display: flex; justify-content: center;">
                        <form style="min-width: 100%;" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                            name="email" id="floatingInputInvalid" value="{{ old('email') }}"
                                            required autofocus>
                                        <label for="floatingInputInvalid"><i class="fas fa-envelope"></i> Correo
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
                                            id="floatingInputInvalid" placeholder="...">
                                        <label for="floatingInputInvalid"> <i class="fas fa-key"></i>
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

        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
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
                        <li><a href="#">Negocio</a></li>
                        <li><a href="#">Educación</a></li>
                        <li><a href="#">Oportunidad</a></li>
                    </ul>
                </div>

                <div class="footer-block">
                    <h2 class="footer-title">Páginas útiles</h2>
                    <ul class="footer-list">
                        <li><a href="#">Acerca de</a></li>
                        <li><a href="#">Noticias</a></li>
                        <li><a href="#">Cursos</a></li>
                        <li><a href="#">Eventos</a></li>
                        <li><a href="#">FAQs</a></li>
                    </ul>
                </div>

                <div class="footer-contact">
                    <h2 class="footer-title">Contáctanos</h2>
                    <ul class="footer-contact-list">
                        <li><i class="fa fa-map-marker-alt"></i> Dirección: Calle Lanza N° 29</li>
                        <li><i class="fa fa-phone-alt"></i> (+591) 2 6225790</li>
                        <li><i class="fa fa-envelope"></i> icap.potosi@gmail.com</li>
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
            <a href="#">FAQs</a>
        </nav>

        <div class="footer-credits">
            <p>&copy; <span id="year"></span> ICAP Potosi. Todos los derechos reservados.</p>
            <p>Diseño y desarrollo web por <a href="#" target="_blank">Hamura Código</a></p>
        </div>
    </footer>

</body>

</html>
