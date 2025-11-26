<div>
    <div class="col-12">
        <?php if (isset($component)) { $__componentOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card-header','data' => ['title' => 'Modulo de eventos','name' => 'Directorio']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Modulo de eventos','name' => 'Directorio']); ?>
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
        <style>
            /* From Uiverse.io by alexruix - Custom version */
            .custom-card {
                overflow: visible;
                position: relative;
                width: 100%;
                height: 354px;
                background: #fff;
                box-shadow: 0 2px 10px rgba(0, 0, 0, .2);
                border-radius: 15px
            }

            .custom-card:before,
            .custom-card:after {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                border-radius: 15px;
                background: #fff;
                transition: 0.5s;
                z-index: -1;
            }

            .custom-details {
                position: absolute;
                bottom: 118px;
                height: 60px;
                text-align: center;
                text-transform: uppercase;
                width: 100%
            }

            /*Image*/
            .custom-imgbox {
                position: absolute;
                top: 10px;
                left: 10px;
                bottom: 10px;
                right: 10px;
                transition: 0.5s;
                z-index: 1;
            }

            .custom-img {
                background: #4158D0;
                background-image: linear-gradient(45deg, #4158D0, #C850C0);
                border-radius: 15px;
                width: 100%;
                height: 100%;
            }

            /*Text*/
            .custom-title {
                font-weight: 600;
                font-size: 16px;
                color: #777;
            }

            .custom-caption {
                font-weight: 500;
                font-size: 12px;
                margin-top: 2px;
                text-align: left;
                margin-left: 2px;
            }

            /*Hover*/
            .custom-card:hover .custom-imgbox {
                bottom: 180px;
            }

            .custom-card:hover:before {
                transform: rotate(20deg);
            }

            .custom-card:hover:after {
                transform: rotate(10deg);
                box-shadow: 0 2px 20px rgba(0, 0, 0, .2);
            }

            .custom-footer {
                position: absolute;
                display: flex;
                top: 180%;
                left: 0;
                right: 0;
                padding: 8px 12px;
                justify-content: end
            }
        </style>
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
                <h5 class="py-0">Eventos</h5>
             <?php $__env->endSlot(); ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('events.create')): ?>
                <div class="col-md-12 order-1 order-md-2 col-ms-12">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" wire:target="search" wire:loading.attr="disabled"
                            class="btn btn-sm btn-success  mb-0 me-2" data-bs-toggle="modal" data-bs-target="#myModal">
                            <i class="far fa-file-alt fs-6"></i> Nuevo
                        </button>
                    </div>
                </div>
            <?php endif; ?>
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
        <div class="row pt-5 g-5">
            <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-4 ">
                    <div class="custom-card">
                        <div class="custom-imgbox">
                            <img class="custom-img"
                                src="<?php echo e(asset('storage/event_photos/' . ($event->firstPhoto->name ?? '69194dd33f84e.png'))); ?>"
                                alt="">
                            <div
                                class="badge bg-info text-white fw-bold position-absolute top-0 end-0 mt-3 me-3 px-3 py-2 rounded-pill shadow-sm price-badge">
                                <?php echo e($event->date); ?>

                            </div>
                        </div>
                        <div class="custom-details px-2 pt-2">
                            <h2 class="custom-title"><?php echo e($event->title); ?></h2>
                            <p class="custom-caption"><?php echo e($event->description); ?></p>
                            <div class="custom-footer d-flex gap-1">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('events.delete')): ?>
                                    <?php if (isset($component)) { $__componentOriginal3fa869ab4147c9277d9fa157f1637985 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3fa869ab4147c9277d9fa157f1637985 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn-delete','data' => ['id' => ''.e($event->id).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn-delete'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => ''.e($event->id).'']); ?>
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
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('events.edit')): ?>
                                    <a href="<?php echo e(route('event.photos', $event->id)); ?>" class="btn-purple-circle"
                                        data-bs-toggle="tooltip" data-bs-title="Photos">
                                        <i class="fas fa-eye"></i>

                                    </a>
                                <?php endif; ?>
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
            <?php echo e($events->links()); ?>

        </div>
    </div>
    <?php echo $__env->make('livewire.events-photo.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<?php /**PATH D:\ICAPV4\ICAP\resources\views/livewire/events-photo/event-component.blade.php ENDPATH**/ ?>