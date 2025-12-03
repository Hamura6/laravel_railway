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
        <section class="section section-color-2" style="margin: 0;padding:3rem 0">
            <div class="section-container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
                <div class="card shadow-lg" style="width: 100%; max-width: 530px; border-radius: 12px; padding: 15px;">
                    <div class="text-center mb-3">
                        <h3 class="login-title"><?php echo e($institution->name ?? 'ILUSTRE COLEGIO DE ABOGADOS'); ?></h3>
                        <img src="<?php echo e($institution->image ?? 'logo'); ?>" alt="Logo Colegio" style="height: 150px;">
                    </div>

                    <div class="section-header text-center mb-3">
                        <h2 class="section-title fs-4 text-secondary"><?php echo e(__('Forgot password')); ?></h2>
                        <p><?php echo e(__('Enter your email to receive a password reset link')); ?></p>
                    </div>

                    <!-- Session Status -->
                    <?php if(session('status')): ?>
                        <div class="alert alert-success text-center">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(route('password.request')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="form-floating mb-3">
                            <input type="email" name="email"
                                class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="email"
                                placeholder="email@example.com" value="<?php echo e(old('email')); ?>" required autofocus>
                            <label for="email"><?php echo e(__('Email Address')); ?></label>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit"
                                class="btn btn-primary"><?php echo e(__('Email password reset link')); ?></button>
                        </div>
                    </form>

                    <div class="text-center mt-3 text-sm text-zinc-400">
                        <span><?php echo e(__('Or, return to')); ?></span>
                        <a href="<?php echo e(route('login')); ?>"><?php echo e(__('log in')); ?></a>
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
<?php /**PATH D:\ICAPV4\ICAP\resources\views/auth/forgotPassword.blade.php ENDPATH**/ ?>