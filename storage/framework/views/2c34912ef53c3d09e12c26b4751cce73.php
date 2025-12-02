<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title><?php echo e($institution->initials ?? 'ICAP'); ?> </title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/landing-pages.scss', 'resources/js/app.js']); ?>
</head>

<body>

    <header class="site-header" id="start">
        <div class="header-wrapper">
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
                        <a class="login-button" href="<?php echo e(route('settings.profile')); ?>">
                            Acceder
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
    <div class="wrapper">
        <section class=" section section-color-2" style="margin: 0px 0;padding:3rem 0">
            <div class="section-container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
                <div class="card shadow-lg" style="width: 100%; max-width: 530px; border-radius: 12px; padding: 15px;">

                    <div align="center" class="row g-1">
                        <div class="text-center mb-3 col-md-12 mt-3">
                            <h3 class="login-title"><?php echo e($institution->name ?? 'ILUSTRE COLEGIO DE ABOGADOS'); ?>

                            </h3>
                            <img src="<?php echo e($institution->image ?? 'logo'); ?>" alt="Logo Colegio" style="height: 150px;">
                        </div>

                        <div class="section-header text-center col-md-12 mb-2">
                            <h2 class="section-title fs-4 text-secondary">Iniciar sesión</h2>
                        </div>
                    </div>
                    <?php if(session('error')): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo e(session('error')); ?>

                        </div>
                    <?php endif; ?>

                    <div style="display: flex; justify-content: center;">
                        <form style="min-width: 100%;" method="POST" action="<?php echo e(route('login')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            name="email" id="email" value="<?php echo e(old('email')); ?>"
                                            required autofocus autocomplete="email">
                                        <label for="email"><i class="fas fa-envelope"></i> Correo
                                            electronico</label>
                                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="password"
                                            class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password"
                                            id="password" placeholder="..." autocomplete="current-password">
                                        <label for="password"> <i class="fas fa-key"></i>
                                            <?php echo e(__('Password')); ?>

                                        </label>
                                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check mb-3 text-start">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            <?php echo e(old('remember') ? 'checked' : ''); ?>>

                                        <label class="form-check-label" for="remember">
                                            <?php echo e(__('Remember Me')); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="d-grid gap-2 col-8 mx-auto">
                                    <button type="submit" class="btn btn-primary">Ingresar</button>
                                    <?php if(Route::has('password.request')): ?>
                                        <a class="btn btn-link mt-3" href="<?php echo e(route('password.request')); ?>">
                                            <?php echo e(__('Forgot Your Password?')); ?>

                                        </a>
                                    <?php endif; ?>
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
                        <li><i class="fa fa-envelope"></i> <?php echo e($institution->email ?? 'susano'); ?></li>
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
<?php /**PATH D:\ICAPV4\ICAP\resources\views/auth/login.blade.php ENDPATH**/ ?>