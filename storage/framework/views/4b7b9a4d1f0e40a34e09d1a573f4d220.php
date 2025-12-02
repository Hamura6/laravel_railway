<div>
    <?php if (isset($component)) { $__componentOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card-header','data' => ['title' => 'Control de Licencias','name' => 'Licencia']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Control de Licencias','name' => 'Licencia']); ?>
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
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('licenses.create')): ?>
                <div class="col-md-6 order-1 order-md-2 col-ms-12">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" wire:target="search" wire:loading.attr="disabled"
                            class="btn btn-sm btn-success  mb-0 me-2" data-bs-toggle="modal" data-bs-target="#myModal">
                            <i class="far fa-file-alt fs-6"></i> Agregar
                        </button>
                    </div>
                </div>
            <?php endif; ?>
            

         <?php $__env->endSlot(); ?>
        <?php if (isset($component)) { $__componentOriginal230577b50e69c5450bcc4895115fe6d2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal230577b50e69c5450bcc4895115fe6d2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table-registers','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table-registers'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
             <?php $__env->slot('header', null, []); ?> 
                <th>Matrícula</th>
                <th>Nombre Completo</th>
                <th>C.I.</th>
                <th>Fecha de registro</th>
                <th>Descripción</th>
                <th>Fecha de licencia</th>
                <th>Opciones</th>
             <?php $__env->endSlot(); ?>
            <tbody wire:target="search" wire:loading.remove>
                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $licenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $license): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="align-middle">
                        <td>
                            <?php echo e($license->affiliate->id); ?>

                        </td>
                        <td>
                            <?php echo e($license->affiliate->user->full_name); ?>

                        </td>
                        <td>
                            <?php echo e($license->affiliate->user->ci); ?>

                        </td>

                        <td class="text-secondary">
                            <?php echo e($license->affiliate->created_at); ?>


                        </td>

                        <td class="text-secondary">
                            <?php echo e($license->description); ?>

                        </td>
                        <td class="text-secondary">
                            <?php echo e($license->date); ?>

                        </td>
                        <td class="text-center">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('licenses.delete')): ?>
                                
                            <?php if (isset($component)) { $__componentOriginal3fa869ab4147c9277d9fa157f1637985 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3fa869ab4147c9277d9fa157f1637985 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn-delete','data' => ['id' => ''.e($license->id).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn-delete'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => ''.e($license->id).'']); ?>
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
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="11" align="center">
                            <h5>
                                <i class="far fa-sad-tear"></i>

                                No se encontraron registros...
                            </h5>
                        </td>
                    </tr>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

            </tbody>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal230577b50e69c5450bcc4895115fe6d2)): ?>
<?php $attributes = $__attributesOriginal230577b50e69c5450bcc4895115fe6d2; ?>
<?php unset($__attributesOriginal230577b50e69c5450bcc4895115fe6d2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal230577b50e69c5450bcc4895115fe6d2)): ?>
<?php $component = $__componentOriginal230577b50e69c5450bcc4895115fe6d2; ?>
<?php unset($__componentOriginal230577b50e69c5450bcc4895115fe6d2); ?>
<?php endif; ?>
        <div class="border-top py-2  mt-2 px-3 d-flex align-items-center">
            <?php echo e($licenses->links()); ?>

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
    <?php echo $__env->make('livewire.licenses.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<?php /**PATH D:\ICAPV4\ICAP\resources\views/livewire/licenses/license-component.blade.php ENDPATH**/ ?>