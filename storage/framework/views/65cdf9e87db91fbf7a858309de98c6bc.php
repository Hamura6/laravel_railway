<div>
    <style>
        /* Elevación suave al hover */
        .hover-elevate {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .hover-elevate:hover {
            transform: translateY(-4px);
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.1) !important;
        }

        /* Badge de artículo más elegante */
        .badge.bg-white.text-primary {
            backdrop-filter: blur(4px);
            background-color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
        }
    </style>
    <?php if (isset($component)) { $__componentOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card-header','data' => ['title' => 'Artículos','name' => 'Articulo']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Artículos','name' => 'Articulo']); ?>
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
            <div class="col-sm-12 col-md-6 order-2 order-md-1">
                <?php if (isset($component)) { $__componentOriginal9b33c063a2222f59546ad2a2a9a94bc6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9b33c063a2222f59546ad2a2a9a94bc6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('search'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9b33c063a2222f59546ad2a2a9a94bc6)): ?>
<?php $attributes = $__attributesOriginal9b33c063a2222f59546ad2a2a9a94bc6; ?>
<?php unset($__attributesOriginal9b33c063a2222f59546ad2a2a9a94bc6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9b33c063a2222f59546ad2a2a9a94bc6)): ?>
<?php $component = $__componentOriginal9b33c063a2222f59546ad2a2a9a94bc6; ?>
<?php unset($__componentOriginal9b33c063a2222f59546ad2a2a9a94bc6); ?>
<?php endif; ?>
            </div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Crear artículos')): ?>
                <div class="col-md-6 order-1 order-md-2 col-ms-12">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="<?php echo e(route('article.form')); ?>" wire:navigate
                            wire:loading.class="disabled pointer-events-none opacity-50" type="button"
                            class="btn btn-sm btn-success mb-0">
                            <i class="far fa-file-alt fs-6"></i> Nuevo artículo
                        </a>
                    </div>
                </div>
            <?php endif; ?>
         <?php $__env->endSlot(); ?>

        <!-- Grid de tarjetas estilo repositorio -->
        <div class="row g-4 mt-2" wire:target="search" wire:loading.remove>
            <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
               <!-- Dentro del loop de artículos, reemplaza el div .card por este: -->
<div class="col-sm-12 col-md-6 col-lg-4">
    <div class="card h-100 border-0 shadow-sm hover-elevate overflow-hidden rounded-4">
        <!-- Imagen (sin cambios, pero no uses position-relative innecesario) -->
        <div style="position: relative; z-index: 1;">
            <img src="<?php echo e($article->image_view); ?>" class="card-img-top rounded-top-4" alt="Portada del artículo"
                style="height: 200px; object-fit: cover; width: 100%; display: block;">
            <div class="position-absolute top-0 start-0 m-2" style="z-index: 3;">
                <span class="badge bg-white text-dark rounded-pill px-3 py-1 shadow-sm">
                    <i class="fas fa-file-alt me-1"></i> <?php echo e($article->date ? \Carbon\Carbon::parse($article->date)->format('d/m/Y') : 'Sin fecha'); ?>

                </span>
            </div>
        </div>

        <!-- Card-body con margen negativo y fondo oscuro -->
        <div class="card-body bg-dark" 
             style="border-radius: 30px 30px 0 0; margin-top: -50px; position: relative; z-index: 2;">
            <div class="small px-2 py-1" style="color: #927700">
                <i class="fas fa-star me-1"></i>
                Autor: <?php echo e($article->author ?? 'no especificado'); ?> 
            </div>
            <h5 class="card-title fs-6 text-white mb-2"><?php echo e($article->title); ?></h5>

            <p class="card-text small mb-1" style=" color: color-mix(in srgb, #fafafa, black 50%) !important;">
                <?php echo e($article->description); ?>

            </p>
        </div>

        <div class="card-footer p-1" style="background: #f3f8fd">
            <!-- Tus botones igual -->
            <div class="d-flex justify-content-end gap-2">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Eliminar artículos')): ?>
                    <?php if (isset($component)) { $__componentOriginal3fa869ab4147c9277d9fa157f1637985 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3fa869ab4147c9277d9fa157f1637985 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn-delete','data' => ['id' => ''.e($article->id).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn-delete'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => ''.e($article->id).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3fa869ab4147c9277d9fa157f1637985)): ?>
<?php $attributes = $__attributesOriginal3fa869ab4147c9277d9fa157f1637985; ?>
<?php unset($__attributesOriginal3fa869ab4147c9277d9fa157f1637985); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3fa869ab4147c9277d9fa157f1637985)): ?>
<?php $component = $__componentOriginal3fa869ab4147c9277d9fa157f1637985; ?>
<?php unset($__componentOriginal3fa869ab4147c9277d9fa157f1637985); ?>
<?php endif; ?>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Editar artículos')): ?>
                    <a wire:target="delete" wire:loading.class="disabled pointer-events-none opacity-50"
                        href="<?php echo e(route('article.form', $article->id)); ?>"
                        class="btn-uc-circle" style="width: 34px; height: 34px;" data-bs-toggle="tooltip" data-bs-title="Editar">
                        <i class="fas fa-edit"></i>
                    </a>
                <?php endif; ?>
                <a href="<?php echo e(Storage::url('articles/files/' . $article->file)); ?>" target="_black"
                    class="btn btn-sm btn-outline-purple rounded-pill" data-bs-toggle="tooltip" data-bs-title="Descargar archivo">
                    <i class="fas fa-eye"></i> Ver archivo
                </a>
            </div>
        </div>
    </div>
</div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12">
                    <div class="alert alert-light text-center py-5 rounded-4 border">
                        <i class="far fa-sad-tear fa-3x text-muted mb-3 d-block"></i>
                        <p class="mb-0 text-secondary">No se encontraron artículos en el repositorio...</p>
                    </div>
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>

        <!-- Loading -->
        <div wire:loading wire:target="search" class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>

        <!-- Paginación -->
        <div class="border-top py-3 px-3 d-flex align-items-center justify-content-center mt-4">
            <?php echo e($articles->links()); ?>

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
</div>
<?php /**PATH D:\ICAPV4\ICAP\resources\views/livewire/articles/article-component.blade.php ENDPATH**/ ?>