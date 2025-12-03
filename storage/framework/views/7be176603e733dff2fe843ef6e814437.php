
<?php $__env->startSection('content'); ?>
    <div class="banner">
        <img class="img-banner" src="<?php echo e(asset('image/aggrement1.jpg')); ?>" alt="Cursos">
        <div class="banner-content">
            <h2 class="title-banner">Convenios</h2>
            <p class="desc-banner">Los convenios estratégicos fortalecen la colaboración y optimizan las relaciones
                profesionales, asegurando beneficios mutuos y un funcionamiento eficiente.</p>
        </div>
    </div>
    <section class="section section-color-4 py-5 px-0 mx-0">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Nuestros Convenios</h2>
                <p class="section-subtitle">
                    Los acuerdos institucionales fomentan la cooperación, el intercambio de experiencias y el crecimiento
                    compartido.
                </p>
            </div>

            <div class="row g-2 justify-content-center">
                <?php $__currentLoopData = $convenios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $convenio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6">
                        <div class="ally-card">
                            <!-- Logo -->
                            <div class="ally-logo">
                                <img src="<?php echo e($convenio->image_view); ?>" alt="<?php echo e($convenio->name); ?>" class="img-fluid">
                            </div>

                            <!-- Nombre -->
                            <h3 class="ally-name"><?php echo e($convenio->name); ?></h3>

                            <!-- Redes sociales – botones perfectos -->
                            <div class="ally-socials">
                                <?php $__currentLoopData = $convenio->socials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e($social->url); ?>" target="_blank" class="ally-social-btn"
                                        aria-label="<?php echo e($social->name); ?>">
                                        <i class="<?php echo e($social->Icon); ?>"></i>
                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ICAPV4\ICAP\resources\views/site/pages/agreement.blade.php ENDPATH**/ ?>