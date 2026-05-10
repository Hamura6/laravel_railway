<?php $__env->startSection('content'); ?>
    <div class="banner">
        <img class="img-banner" src="<?php echo e(asset('image/single.jpg')); ?>" alt="Galería">
        <div class="banner-content">
            <span class="banner-eyebrow">Galería oficial</span>
            <h2 class="title-banner">Imágenes</h2>
            <p class="desc-banner">Bienvenidos a nuestra galería de imágenes</p>
        </div>
    </div>

    <div class="gallery-toolbar">
        <span class="gallery-count"><?php echo e($photos->total()); ?> imágenes · página <?php echo e($photos->currentPage()); ?> de
            <?php echo e($photos->lastPage()); ?></span>
    </div>

    <div class="gallery-grid">
        <?php $__empty_1 = true; $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="gallery-item <?php echo e($loop->iteration === 7 ? 'gallery-item--wide' : ''); ?>">
                <span class="gallery-item-num"><?php echo e(str_pad($loop->iteration, 2, '0', STR_PAD_LEFT)); ?></span>
                <img src="<?php echo e($photo->image); ?>" alt="Fotografía <?php echo e($loop->iteration); ?>" loading="lazy">
                <div class="gallery-item-overlay">
                    <a href="<?php echo e($photo->image); ?>" target="_blank" rel="noopener" class="gallery-item-btn"
                        title="Ver imagen">
                        <i class="fas fa-eye"></i>
                    </a>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="gallery-empty">
                <i class="far fa-images"></i>
                <p>No hay fotografías disponibles.</p>
            </div>
        <?php endif; ?>
    </div>

    <div class="gallery-footer">
        <span class="gallery-footer-info">
            Mostrando <?php echo e($photos->firstItem()); ?>–<?php echo e($photos->lastItem()); ?> de <?php echo e($photos->total()); ?> imágenes
        </span>
        <?php echo e($photos->links()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ICAPV4\ICAP\resources\views/site/pages/event_photos.blade.php ENDPATH**/ ?>