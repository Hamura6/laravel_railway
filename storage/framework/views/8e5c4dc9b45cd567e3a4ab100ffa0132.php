<div>
    <?php if (isset($component)) { $__componentOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card-header','data' => ['title' => 'Reconocimientos Oficiales','name' => 'Reconocimientos']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Reconocimientos Oficiales','name' => 'Reconocimientos']); ?>
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
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" placeholder="Escriba un año" wire:model="search">
                    <button wire:click="UpdatedSearch()" class="btn btn-outline-secondary" type="button"
                        id="button-addon2">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                </div>


            </div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('recognitions.create')): ?>
                <div class="col-md-6 order-1 order-md-2 col-ms-12">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" wire:target="search" wire:loading.attr="disabled"
                            class="btn btn-sm btn-success " data-bs-toggle="modal" data-bs-target="#myModal">
                            <i class="far fa-file-alt fs-6"></i> Nuevo
                        </button>
                    </div>
                </div>
            <?php endif; ?>
         <?php $__env->endSlot(); ?>
        <div class="row g-1">


            <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $recognitions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recognition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-3">
                    <div class="card border  mb-0 h-100 d-flex flex-column">
                        <div class="card-header py-1 d-flex justify-content-center >
                            <h6 class="text-center
                            p-0 m-0 ">
                                <i class="<?php echo e($recognition->icon); ?>"></i>
                                <?php echo e(__($recognition->type)); ?>

                            </h6>
                        </div>
                        <div class="card-body px-0 ">
                            <ul class="list-group list-group-flush ">
                                <li class="list-group-item py-0 pb-1 border-0"> <i class="fas fa-flag"></i> Nombre:
                                    </strong><?php echo e($recognition->name); ?> </li>
                                <li class="list-group-item py-0 pb-1 border-0"> <strong><i class="far fa-calendar-alt"></i>
                                        Fecha:
                                    </strong> <?php echo e($recognition->date); ?> </li>
                                
                                <li class="list-group-item py-0 pb-1 border-0"><strong><i class="fas fa-user-edit"></i>
                                        Participantes:
                                    </strong><?php echo e($recognition->cant); ?>

                                </li>
                               
                                <li class="list-group-item py-0 pb-1 border-0 text-center <?php echo e($recognition->is_date ? 'text-success' : 'text-danger'); ?>"> <strong><i class="fas fa-clock"></i> <?php echo e($recognition->remaining_days); ?>

                                    </strong> </li>
                            </ul>
                        </div>
                        <div class="card-footer py-1 d-flex gap-1 justify-content-center">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('recognitions.edit')): ?>
    <button type="button" wire:target="changeStatus, delete, edit" wire:loading.attr="disabled"
                                        wire:click="edit(<?php echo e($recognition->id); ?>)"
                                        class="btn-uc-circle" data-bs-toggle="tooltip"
                                        data-bs-title="Editar" wire:loading.attr="disabled">
                                        <i class="fas fa-edit fs-6"></i>
                                    </button>
<?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('recognitions.delete')): ?>
    <button type="button" wire:target="changeStatus, delete, edit" wire:loading.attr="disabled"
                                    onclick="Confirm(<?php echo e($recognition->id); ?>)"
                                    class="btn-dc-circle outlined " data-bs-toggle="tooltip"
                                    data-bs-title="Eliminar" wire:loading.attr="disabled">
                                    <i class="fas fa-trash fs-6"></i>
                                    </button>
<?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('recognitions.view')): ?>
    <a type="button" wire:target="changeStatus, delete, edit" wire:loading.attr="disabled"
                                    href="<?php echo e(route('recognitions.details', $recognition->id)); ?>" wire:navigate
                                    class="btn-purple-circle"
                                    data-bs-toggle="tooltip" data-bs-title="Detalle" wire:loading.attr="disabled">
                                    <i class="fas fa-eye fs-6"></i>
                                    </a>
<?php endif; ?>
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
    <?php echo $__env->make('livewire.recognitions.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<?php /**PATH D:\ICAPV4\ICAP\resources\views/livewire/recognitions/recognition-component.blade.php ENDPATH**/ ?>