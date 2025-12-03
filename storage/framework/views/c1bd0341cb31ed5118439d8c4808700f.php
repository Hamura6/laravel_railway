
<?php $__env->startSection('content'); ?>
    <div class="banner">
        <img class="img-banner" src="<?php echo e(asset('image/courses1.jpg')); ?>" alt="Cursos">
        <div class="banner-content">
            <h2 class="title-banner">Cursos</h2>
            <p class="desc-banner">Aprende nuevas habilidades con nuestros cursos en línea.</p>
        </div>
    </div>

    
    <section class="section section-color-1 py-5 px-0 mx-0">
    <div class="container">
        <div class="section-header">
                <h2 class="section-title">Nuestros Cursos</h2>
                <p class="section-subtitle">
                    Formación continua para profesionales del derecho. Capacítate con nuestros programas especializados.
                </p>
            </div>

        <div class="row g-2 g-xl-5 justify-content-center">
            <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-12 col-md-6">
                    <div class="course-card-web">
                        <!-- Imagen principal -->
                        <div class="course-image">
                            <img src="<?php echo e($course->image_view); ?>" alt="<?php echo e($course->title); ?>">
                        </div>

                        <!-- Contenido que se expande al hacer hover -->
                        <div class="course-bottom">
                            <div class="course-content">
                                <h3 class="course-title"><?php echo e($course->title); ?></h3>

                                <!-- Precio destacado -->
                                <div class="course-price mb-3">
                                    <span class="badge bg-warning text-dark fw-bold px-4 py-2 fs-6">
                                        <?php echo e($course->price); ?> Bs.
                                    </span>
                                </div>

                                <p class="course-desc text-light opacity-90">
                                    <?php echo e(Str::limit($course->description, 120)); ?>

                                </p>

                                <div class="course-actions mt-4">
                                   
                                    <a href="<?php echo e($course->image_view); ?>" target="_blank"
                                       class="btn btn-outline-warning btn-sm px-4">
                                        <i class="fas fa-image"></i> Vista previa
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center">
                    <p class="text-light">No hay cursos disponibles en este momento.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ICAPV4\ICAP\resources\views/site/pages/courses.blade.php ENDPATH**/ ?>