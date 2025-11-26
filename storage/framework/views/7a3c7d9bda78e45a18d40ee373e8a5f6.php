<div>
    <?php if (isset($component)) { $__componentOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card-header','data' => ['title' => 'Gestión de Pagos','name' => 'Saldos']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Gestión de Pagos','name' => 'Saldos']); ?>
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
            <div class="col-md-6  col-ms-12 order-md-2 order-sm-1">
                <div class="form-floating">
                    <select class="form-select" wire:model.live="selected" id="floatingSelect"
                        aria-label="Floating label select example">
                        <option value="">Todos</option>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                        <option value="Fallecido">Fallecidos</option>
                        
                    </select>
                    <label for="floatingSelect">Seleccione el estado</label>
                </div>
            </div>
            <div class="col-sm-12 col-md-6  order-md-1 order-sm-2">
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
                <th>Afiliado</th>
                <th>C.I.</th>
                <th>Antigüedad</th>
                <th>Último pago de aporte</th>
                <th>Deuda de aporte</th>
                <th>Deuda total</th>
                <th>Estado</th>
                <th>Acciones
                </th>
             <?php $__env->endSlot(); ?>
            <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $affiliates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $affiliate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="align-middle">
                    <td><?php echo e($affiliate->id); ?></td>
                    <td><?php echo e($affiliate->user->full_name); ?></td>
                    <td><?php echo e($affiliate->user->ci); ?></td>
                    <td class="text-secondary"><?php echo e($affiliate->antique); ?>

                    </td>
                    <td class="text-secondary">
                        <?php echo e(\Carbon\Carbon::parse($affiliate->ultimoPago)->locale('es')->isoFormat('MMMM YYYY')); ?>

                    </td>
                    <td class="text-secondary"><?php echo e(number_format($affiliate->aportes, 2)); ?> Bs. =>
                        <?php echo e($affiliate->aportes_cant); ?></td>
                    <td class="text-secondary"><?php echo e($affiliate->prest - $affiliate->planes); ?>

                        Bs.</td>


                    <td align="center">
                        <span class="badge rounded-pill text-dark  border border-dark border-1">
                            <?php echo e($affiliate->status); ?>

                        </span>
                    </td>

                    <td class="text-center">
                        <div class="d-flex flex-row justify-content-center align-items-center gap-1">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('payments.pay')): ?>
                                <button class="btn-uc-circle" wire:loading.attr="disabled" data-bs-toggle="tooltip"
                                    data-bs-title="Pagar Aporte"
                                    wire:click="edit(<?php echo e($affiliate->id); ?>,<?php echo e($affiliate->aportes_cant ? $affiliate->aportes_cant : 0); ?>,<?php echo e($affiliate->aportes ? $affiliate->aportes : 0); ?>)">
                                    <i class="fas fa-edit fs-6"></i>

                                </button>
                            <?php endif; ?>
                            <a href="<?php echo e(route('finances.details', $affiliate->id)); ?>" class="btn-purple-circle"
                                data-bs-toggle="tooltip" data-bs-title="Detalle">
                                <i class="fs-6 fas fa-eye"></i>
                            </a>
                            <!--[if BLOCK]><![endif]--><?php if($affiliate->prest - $affiliate->planes > 0): ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('payments.pays')): ?>
                                    <button wire:target="check, delete, edit" wire:loading.attr="disabled"
                                        class="btn-cc-circle outlined"
                                        onclick="Question(<?php echo e($affiliate->id); ?>,'Desea realizar el pagos de todas las deudas?','toPay')"
                                        data-bs-toggle="tooltip" data-bs-title="Realizar pago">
                                        <i class="fas fa-hand-holding-usd fs-6"></i></button>
                                <?php endif; ?>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="9">
                        <h5>
                            <i class="far fa-sad-tear"></i>

                            No se encontraron registros...
                        </h5>
                    </td>
                </tr>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

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
    <?php echo $__env->make('livewire.finances.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<?php /**PATH D:\ICAPV4\ICAP\resources\views/livewire/finances/debts-component.blade.php ENDPATH**/ ?>