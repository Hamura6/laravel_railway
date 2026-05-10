<?php $__env->startSection('content'); ?>

    <div class="banner">
        <img class="img-banner" src="<?php echo e(asset('image/news.jpg')); ?>" alt="Requisitos">
        <div class="banner-content">
            <span class="banner-eyebrow">Admisiones</span>
            <h2 class="title-banner">Requisitos de inscripción</h2>
            <p class="desc-banner">Forma parte de nuestra comunidad y accede a cursos, seminarios, diplomados y maestrías.</p>
        </div>
    </div>

    <section class="req-section">
        <div class="req-container">

            <div class="req-header">
                <span class="req-header-label">Proceso de admisión</span>
                <h2 class="req-header-title">Requisitos de inscripción</h2>
                <p class="req-header-sub">Revisa los requisitos necesarios para formar parte de nuestra institución.</p>
            </div>

            <div class="req-body">
                <?php echo $institution->requirement; ?>

            </div>

        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ICAPV4\ICAP\resources\views/site/pages/requirement.blade.php ENDPATH**/ ?>