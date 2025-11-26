
<?php $__env->startSection('content'); ?>
    <div class="banner">
        <img class="img-banner" src="<?php echo e(asset('assets/img/2.jpg')); ?>" alt="Cursos">
        <div class="banner-content">
            <h2 class="title-banner">Organización</h2>
            <p class="desc-banner">Una buena organización en una empresa es fundamental porque determina cómo funciona.</p>
        </div>
    </div>
    <section class="section section-color-2 py-5 px-0 mx-0">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Directorio de ICAP</h2>
                <p class="section-subtitle">
                    El Directorio de ICAP presenta la estructura organizativa de la institución y sus principales
                    autoridades.
                </p>
            </div>
            <div class="row   g-2 justify-content-center">
                <?php $__currentLoopData = $directory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4">
                        <article class="team-card h-100">
                            <!-- Rol + flechita -->
                            <div class="sub-card category d-flex align-items-center justify-content-center">
                                <span class="text-span text-center"><?php echo e($member->name); ?></span>
                            </div>

                            <!-- Imagen completa + overlay círculo -->
                            <div class="card-container">
                                <img src="<?php echo e($member->affiliate->user->image); ?>"
                                    alt="<?php echo e($member->affiliate->user->full_name); ?>" class="image">

                                <div class="overlay-circle"></div>
                            </div>

                            <!-- Nombre -->
                            <div class="sub-card named">
                                <span class="text-span"
                                    style="font-size: 10px"><?php echo e($member->affiliate->user->title . ' ' . $member->affiliate->user->full_name); ?></span>
                            </div>
                        </article>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>


    <section class="section section-color-2 py-2 px-0 mx-0">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Tribunal de Honor</h2>
                <p class="section-subtitle">
                    El Tribunal de Honor vela por el cumplimiento ético y disciplinario de los miembros, asegurando la
                    integridad profesional.
                </p>
            </div>
            <div class="row  g-2 justify-content-center ">
                <?php $__currentLoopData = $th_directory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4">
                        <article class="team-card h-100">
                            <!-- Rol + flechita -->
                            <div class="sub-card category d-flex align-items-center justify-content-center">
                                <span class="text-span text-center"><?php echo e($member->name); ?></span>
                            </div>

                            <!-- Imagen completa + overlay círculo -->
                            <div class="card-container">
                                <img src="<?php echo e($member->affiliate->user->image); ?>"
                                    alt="<?php echo e($member->affiliate->user->full_name); ?>" class="image">

                                <div class="overlay-circle"></div>
                            </div>

                            <!-- Nombre -->
                            <div class="sub-card named">
                                <span class="text-span"
                                    style="font-size: 10px"><?php echo e($member->affiliate->user->title . ' ' . $member->affiliate->user->full_name); ?></span>
                            </div>
                        </article>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ICAPV4\ICAP\resources\views/site/pages/directory.blade.php ENDPATH**/ ?>