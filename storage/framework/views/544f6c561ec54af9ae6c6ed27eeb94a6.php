<div>
    <?php if (isset($component)) { $__componentOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card-header','data' => ['title' => 'Asignar | Permisos ','name' => 'Permisos']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Asignar | Permisos ','name' => 'Permisos']); ?>
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
            <div class="col-md-6 col-ms-12">
                <div class="input-group">
                    <label class="input-group-text" for="inputGroupSelect01">Seleccionar</label>
                    <select class="form-select" id="inputGroupSelect01" wire:model.live="role">
                        <option value="0">Seleccionar</option>
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($rol->id); ?>"><?php echo e($rol->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </select>
                </div>

            </div>
            <div class="col-md-6">
                <div class="d-grid gap-2 d-md-flex d-md-block justify-content-md-end">
                    <button class="btn btn-outline-success w-100 " type="button" wire:loading.attr="disabled"
                        wire:target="syncAll" wire:click="syncAll()">
                        <span class="spinner-grow spinner-grow-sm" wire:loading wire:target="syncAll"
                            aria-hidden="true"></span>
                        <i class="fas fa-sync fs-6" wire:target="syncAll" wire:loading.remove></i>
                        Asignar todo</button>
                    <button class="btn btn-outline-danger w-100 " type="button" wire:loading.attr="disabled"
                        wire:click="revokeAll()">
                        <span class="spinner-grow spinner-grow-sm" wire:loading wire:target="revokeAll"
                            aria-hidden="true"></span>
                        <i class="fas fa-eraser fs-6" wire:loading.remove wire:target="revokeAll"></i>
                        Revocar todo
                    </button>
                </div>
            </div>

            <div class="col-sm-12 col-md-6">
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

         <?php $__env->endSlot(); ?>
        <div class="row g-2">
            <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-3">
                    <div class="card border-secondary border h-100">
                        <div class="card-body">
                            <div class="d-grid gap-2 d-md-flex  justify-content-md-between justify-content-sm-end">

                                <button
                                    class="btn p-0 m-0 border-0 rounded-circle 
              d-flex align-items-center justify-content-center
              <?php echo e($permission->checked ? 'bg-success text-white' : 'bg-light text-muted'); ?>"
                                    style="width: 20px; height: 20px; font-size: 0.7rem;"
                                    wire:click="syncPermission(<?php echo e($permission->checked ? 'false' : 'true'); ?>, '<?php echo e($permission->name); ?>')"
                                    wire:loading.attr="disabled" data-toggle="tooltip" data-placement="top"
                                    title="<?php echo e($permission->checked ? 'Revocar permiso' : 'Asignar permiso'); ?>">
                                    <i class="fas <?php echo e($permission->checked ? 'fa-check' : 'fa-circle'); ?>"></i>
                                </button>


                                <!--[if BLOCK]><![endif]--><?php if($permission->checked == 0): ?>
                                    <span class="badge badge-danger">Asignar</span>
                                <?php else: ?>
                                    <span class="badge badge-info">Asignado</span>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                            <h5 class="card-title"><?php echo e($permission->name); ?> </h5>
                            <p class="card-text"><?php echo e($permission->description); ?> </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-md-12" align="center" wire:target="search" wire:loading.remove>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="far fa-sad-tear"></i> No se encontraron
                                registros... </h5>
                        </div>
                    </div>
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            <div class="text-center py-4 color-dark" wire:loading wire:target="search">
                <div class="spinner-border " style="width: 4rem; height: 4rem;" role="status">
                    <span class="visually-hidden ">Loading...</span>
                </div>
            </div>

        </div>
        <?php echo e($permissions->links()); ?>


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
<?php /**PATH D:\ICAPV4\ICAP\resources\views/livewire/permission-component.blade.php ENDPATH**/ ?>