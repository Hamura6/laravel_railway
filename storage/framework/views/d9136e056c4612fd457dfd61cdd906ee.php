<div>

    <style>
        .my-card {
            position: relative;
            aspect-ratio: 4/3;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            border-radius: 12px;
            border: 0.5px solid rgba(0, 0, 0, 0.1);
            background: #f1f1f0;
        }

        .my-card img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 1;
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1), filter 0.4s ease;
        }

        .my-card:hover img {
            transform: scale(1.06);
            filter: brightness(0.4);
        }

        .my-card .content-my {
            position: absolute;
            z-index: 3;
            bottom: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            transform: scale(0);
            transition: 0.5s;
        }

        .my-card:hover .content-my {
            transform: scale(1);
            bottom: 25px;
        }
    </style>

    <?php if (isset($component)) { $__componentOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card-header','data' => ['title' => 'Administracion de fotografias','name' => 'Fotografias']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Administracion de fotografias','name' => 'Fotografias']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf8fdb5e325b86ec4fcbd12174b8a2d26)): ?>
<?php $attributes = $__attributesOriginalf8fdb5e325b86ec4fcbd12174b8a2d26; ?>
<?php unset($__attributesOriginalf8fdb5e325b86ec4fcbd12174b8a2d26); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf8fdb5e325b86ec4fcbd12174b8a2d26)): ?>
<?php $component = $__componentOriginalf8fdb5e325b86ec4fcbd12174b8a2d26; ?>
<?php unset($__componentOriginalf8fdb5e325b86ec4fcbd12174b8a2d26); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginal715227d04bfdbc5a76353a8876a0c5ef = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal715227d04bfdbc5a76353a8876a0c5ef = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card-body','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card-body'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
         <?php $__env->slot('header', null, []); ?> 
            <div class="col-9">

                <h4><strong><?php echo e($this->title); ?> | <?php echo e($this->date); ?></strong></h4>
            </div>
            <div class="col-3">
                <div class="d-grid gap-2 d-flex justify-content-end">
                    <button wire:loading.attr="disabled" data-bs-toggle="modal" data-bs-target="#myModal"
                        class="btn btn-sm btn-outline-success mb-1 " type="button">
                        <i class="fas fa-plus fs-6"></i></button>
                </div>
            </div>
         <?php $__env->endSlot(); ?>
        <div class="row g-2">
            <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-4">
                    <div class="my-card w-100">
                        <img src="<?php echo e($photo->image); ?>" alt="image" loading="lazy">
                        <div class="content-my">
                            <div class="position-absolute bottom-0 d-flex gap-2 justify-content-center">

                                <a class="btn-info-circle outlined" href="<?php echo e($photo->image); ?>" target="_blank"
                                    rel="noopener" title="Ver imagen">
                                    <i class="fas fa-expand"></i>
                                </a>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Editar eventos')): ?>
                                    <button type="button" wire:target="changeStatus, delete, edit"
                                        wire:loading.attr="disabled" onclick="Confirm(<?php echo e($photo->id); ?>)"
                                        class="btn-dc-circle" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                <?php endif; ?>
                                <a class="btn-success-circle outlined" href="<?php echo e($photo->image_download); ?>" download
                                    title="Descargar">
                                    <i class="fas fa-download"></i>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12">
                    <div class="alert alert-info text-center rounded-3 py-3 shadow-sm">
                        <i class="far fa-sad-tear"></i> No se encontraron registros.
                    </div>
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>
        <div class="border-top py-3 px-3 d-flex align-items-center">
            <?php echo e($photos->links()); ?>

        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal715227d04bfdbc5a76353a8876a0c5ef)): ?>
<?php $attributes = $__attributesOriginal715227d04bfdbc5a76353a8876a0c5ef; ?>
<?php unset($__attributesOriginal715227d04bfdbc5a76353a8876a0c5ef); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal715227d04bfdbc5a76353a8876a0c5ef)): ?>
<?php $component = $__componentOriginal715227d04bfdbc5a76353a8876a0c5ef; ?>
<?php unset($__componentOriginal715227d04bfdbc5a76353a8876a0c5ef); ?>
<?php endif; ?>
    <?php echo $__env->make('livewire.events-photo.formPlusPhotos', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<?php /**PATH D:\ICAPV4\ICAP\resources\views/livewire/events-photo/photos-component.blade.php ENDPATH**/ ?>