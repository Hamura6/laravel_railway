<div>
    <?php if (isset($component)) { $__componentOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card-header','data' => ['title' => 'Descuentos Aplicables','name' => 'Descuentos']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Descuentos Aplicables','name' => 'Descuentos']); ?>
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
            <div class="col-sm-12 col-md-6 order-2 order-md-1 ">
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
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('discount.create')): ?>
                <div class="col-md-4 col-ms-12 order-1 order-md-2 offset-md-2">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" wire:target="search" wire:loading.attr="disabled" class="btn btn-sm btn-success"
                            data-bs-toggle="modal" data-bs-target="#myModal">
                            <i class="far fa-file-alt fs-6"></i> Nuevo
                        </button>
                    </div>
                </div>
            <?php endif; ?>


         <?php $__env->endSlot(); ?>
        <div class="row g-3" wire:target="search" wire:loading.remove>
            <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $discounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $discount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-4">
                    <div class="card shadow  h-100 border-<?php echo e($discount->is_active ? 'success' : 'secondary'); ?> ">

                        <div
                            class="card-header py-2  text-center <?php echo e($discount->is_active ? 'bg-success' : 'bg-secondary'); ?>">
                            <h6 class="mb-0 text-white">
                                <?php echo e($discount->start_date); ?> | <?php echo e($discount->end_date); ?>

                                <span
                                    class="badge border border-light text-light ms-3 fs-6"><?php echo e($discount->discount_value); ?>%</span>
                            </h6>
                        </div>
                        <div class="card-body d-flex flex-column  m-0 py-1 px-3 ">
                            <!--[if BLOCK]><![endif]--><?php if($discount->fees->isNotEmpty()): ?>
                                <ul class="list-group list-group-flush fs-6">
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $discount->fees->chunk(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="row">
                                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col">
                                                    <?php echo e($fee->name); ?>

                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->

                                </ul>
                            <?php else: ?>
                                <p class="text-muted small mb-3 text-center"> <i class="far fa-sad-tear me-2"></i>No hay
                                    tipos de tramites</p>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->


                        </div>
                        <div class=" card-footer py-1 d-flex gap-1 justify-content-end">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('discount.edit')): ?>
                                <?php if (isset($component)) { $__componentOriginale9f0fcc686d5ab9265b8e88cbb55bbb0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale9f0fcc686d5ab9265b8e88cbb55bbb0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn-edit','data' => ['id' => ''.e($discount->id).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn-edit'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => ''.e($discount->id).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale9f0fcc686d5ab9265b8e88cbb55bbb0)): ?>
<?php $attributes = $__attributesOriginale9f0fcc686d5ab9265b8e88cbb55bbb0; ?>
<?php unset($__attributesOriginale9f0fcc686d5ab9265b8e88cbb55bbb0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale9f0fcc686d5ab9265b8e88cbb55bbb0)): ?>
<?php $component = $__componentOriginale9f0fcc686d5ab9265b8e88cbb55bbb0; ?>
<?php unset($__componentOriginale9f0fcc686d5ab9265b8e88cbb55bbb0); ?>
<?php endif; ?>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('discount.delete')): ?>
                                <?php if (isset($component)) { $__componentOriginal3fa869ab4147c9277d9fa157f1637985 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3fa869ab4147c9277d9fa157f1637985 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn-delete','data' => ['id' => ''.e($discount->id).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn-delete'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => ''.e($discount->id).'']); ?>
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
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="far fa-sad-tear me-2"></i> No se encontró ningún registro...
                    </div>
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        </div>

        <div class="border-top p-2  mt-3 d-flex align-items-center">
            <?php echo e($discounts->links()); ?>

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
    <?php echo $__env->make('livewire.discounts.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<?php /**PATH D:\ICAPV4\ICAP\resources\views/livewire/discounts/discount-component.blade.php ENDPATH**/ ?>