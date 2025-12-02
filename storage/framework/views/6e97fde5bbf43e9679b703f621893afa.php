<div>
    <?php if (isset($component)) { $__componentOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card-header','data' => ['title' => 'Lista de Afiliados']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Lista de Afiliados']); ?>
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
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('affiliates.create')): ?>
                <div class="col-md-6 order-1 order-md-2 col-ms-12">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="<?php echo e(route('register.affiliate')); ?>" wire:navigate class="btn btn-sm  btn-success">
                            <i class="far fa-file-alt "></i> Nuevo
                        </a>
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
                <th>Nombres Completo</th>
                <th>C.I</th>
                <th>Estado</th>
                <th>Situación</th>
                <th>Correo Electrónico</th>
                <th>Edad</th>
                <th>Antigüedad</th>
                <th>Teléfono</th>
                <th>Opciones</th>
             <?php $__env->endSlot(); ?>
            <tbody wire:target="search" wire:loading.remove>
                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $affiliates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $affiliate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <tr class="align-middle">
                        <td class="font-weight-normal">
                            <?php echo e($affiliate->id); ?>

                        </td>
                        <td class="font-weight-normal">

                            <?php echo e($affiliate->user->title); ?>

                            <?php echo e($affiliate->user->full_name); ?>



                        </td>
                        <td class="font-weight-normal">
                            <?php echo e($affiliate->user->ci); ?>

                        </td>
                        <td
                            class="text-center align-middle d-flex flex-column justify-content-center align-items-center">
                            <span
                                class="badge badge-sm border 
        <?php echo e($affiliate->user->status == 'ENABLED' ? 'border-success text-success ' : 'border-danger text-danger'); ?>">
                                <?php echo e(__($affiliate->user->status)); ?>

                            </span>
                            <button
                                class="btn p-0 m-2 border-0 rounded-fill 
               d-flex align-items-center justify-content-center
               <?php echo e($affiliate->user->status == 'ENABLED' ? 'bg-success text-white' : 'bg-light text-muted'); ?>"
                                style="width: 20px; height: 20px; font-size: 0.7rem;"
                                onclick="Question(<?php echo e($affiliate->user->id); ?>, 'Desea bloquear al afiliado del sistema?', 'changeStatus')"
                                wire:loading.attr="disabled" data-toggle="tooltip" data-placement="top"
                                title="<?php echo e($affiliate->user->status == 'ENABLED' ? 'Bloquear' : 'Habilitar'); ?>">
                                <i
                                    class="fas <?php echo e($affiliate->user->status == 'ENABLED' ? 'fa-check' : 'fa-circle'); ?>"></i>
                            </button>
                        </td>
                        <td class="text-center">
                            <?php echo e($affiliate->status); ?>

                        </td>
                        <td>
                            <?php echo e($affiliate->user->email); ?>

                        </td>

                        <td align="center">
                            <?php echo e($affiliate->user->age); ?>

                        </td>
                        <td>
                            <?php echo e($affiliate->antique); ?>

                        </td>
                        <td class="align-middle text-center">
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $affiliate->user->phones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="text-secondary text-sm"><?php echo e($phone->number); ?> </span><br>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        </td>
                        <td>
                            <div class="d-flex flex-row justify-content-center align-items-center gap-1">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('affiliates.reset.password')): ?>
                                    <button type="button" wire:target="changeStatus, delete, edit,resetPassword"
                                        onclick="Question(<?php echo e($affiliate->user->id); ?>,'Desea bloquear al afiliado del sistema?','resetPassword')"
                                        wire:loading.attr="disabled"  class="btn btn-warning-circle"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        data-bs-title="Restablecer contrasena">
                                        <i class="fas fa-key fs-6"></i>
                                    </button>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('affiliates.edit')): ?>
                                    <a href="<?php echo e(route('register.affiliate', $affiliate->id)); ?>" wire:navigate
                                        type="button" class="btn btn-uc-circle" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" data-bs-title="Editar afiliado">
                                        <i class="fas fa-edit fs-6"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('affiliates.delete')): ?>
                                    <?php if (isset($component)) { $__componentOriginal3fa869ab4147c9277d9fa157f1637985 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3fa869ab4147c9277d9fa157f1637985 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn-delete','data' => ['id' => ''.e($affiliate->user->id).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn-delete'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => ''.e($affiliate->user->id).'']); ?>
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
                                <a type="button" href="<?php echo e(route('form.affiliate', $affiliate->id)); ?>"
                                    class="btn btn-primary-circle" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    data-bs-title="Ver detalle">
                                    <i class="fas fa-eye fs-6"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="14" class="text-center">
                            <i class="far fa-sad-tear"></i> No se encontraron registros
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
        <div class="border-top py-3 px-3 d-flex align-items-center">
            <?php echo e($affiliates->links()); ?>

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
<?php /**PATH D:\ICAPV4\ICAP\resources\views/livewire/affiliate/view-affiliate.blade.php ENDPATH**/ ?>