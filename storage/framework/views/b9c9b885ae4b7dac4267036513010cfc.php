
<?php $__env->startSection('content'); ?>
    <div class="banner">
        <img class="img-banner" src="<?php echo e(asset('assets/img/single.jpg')); ?>" alt="Cursos">
        <div class="banner-content">
            <h2 class="title-banner">Imagenes </h2>
            <p class="desc-banner">Bienvenidos a nuestra galeria de imagenes</p>
        </div>
    </div>
    <div
        class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4 g-xl-5 justify-content-center p-5">
        <?php $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col">
                <div class="polaroid-card" data-bs-toggle="tooltip" title="<?php echo e($photo->title ?? ''); ?>">
                    <div class="polaroid">
                        <div class="photo">
                            <img src="<?php echo e($photo->image); ?>" class="w-100 h-100 object-fit-cover" alt="Imagen">

                            <!-- Efectos vintage (super ligeros) -->
                            <div class="dust"></div>
                            <div class="scratches"></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="border-top py-3 px-3 d-flex align-items-center">
        <?php echo e($photos->links()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ICAPV4\ICAP\resources\views/site/pages/event_photos.blade.php ENDPATH**/ ?>