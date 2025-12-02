<div>
    <?php if (isset($component)) { $__componentOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card-header','data' => ['title' => 'Pagos realizados','name' => 'Pagos']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Pagos realizados','name' => 'Pagos']); ?>
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
    <div class="row g-1">

        <div class="col-md-8">
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
                    <h6 class="text-secondary">Tipo de tramite <?php echo e($this->payment->fee->name); ?></h6>
                 <?php $__env->endSlot(); ?>

                <table class="table  table-bordered border-light table-striped">
                    <tbody>
                        <tr>
                            <th scope="col"> Costo:</th>
                            <td>
                                <?php echo e($this->payment->amount); ?> Bs.
                            </td>
                        </tr>
                        <tr>
                            <th scope="col"> Deuda:</th>
                            <td>
                                <?php echo e($this->debt); ?> Bs.
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">Nombre Completo:</th>
                            <td><?php echo e($this->payment->affiliate->user->full_name); ?>

                            </td>
                        </tr>
                        <tr>
                            <th scope="col">Matrícula:</th>
                            <td><?php echo e($this->payment->affiliate->id); ?></td>

                        </tr>
                        <tr>
                            <th scope="col">C.I:</th>
                            <td><?php echo e($this->payment->affiliate->user->ci); ?></td>

                        </tr>
                        <tr>
                            <th scope="col">Teléfonos:</th>
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $this->payment->affiliate->user->phones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <td> <span class="badge rounded-pill text-bg-dark  border border-dark border-1">
                                        <?php echo e($phone->number); ?>

                                    </span>
                                </td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        </tr>
                        <tr>
                            <th scope="col">Correo electrónico:</th>
                            <td colspan="2">
                                <?php echo e($this->payment->affiliate->user->email); ?>

                            </td>
                        </tr>
                        

                </table>
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
        <div class="col-md-4" style="max-height: 80vh; overflow-y: auto;">
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
                    <h6 class="text-secondary">Historial de pagos</h6>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('payments.pay')): ?>
                        <button type="button" class="btn btn-sm  btn-success  mb-0 me-2" data-bs-toggle="modal"
                            data-bs-target="#myModal">
                            <i class="far fa-file-alt fs-6"></i> Nuevo
                        </button>
                    <?php endif; ?>
                 <?php $__env->endSlot(); ?>
                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="card border-0 mb-3"
                        style="box-shadow: inset 2px 2px  7px rgba(0, 0, 0, 0.39); border-radius: 0.5rem;">
                        <div class="card-body p-3">
                            <h5 class="card-title text-dark fw-bold mb-1"><?php echo e($plan->amount); ?> Bs.</h5>
                            <p class="card-text text-muted mb-0" style="font-size: 0.75rem;">
                                <?php echo e($plan->created_at->format('d/m/Y H:i')); ?>

                            </p>
                            <button class="btn btn-sm btn-outline-danger rounded-circle position-absolute"
                                onclick="Confirm(<?php echo e($plan->id); ?>)"
                                style="top: 8px; right: 8px; width: 24px; height: 24px; padding: 0;">
                                <i class="fas fa-trash" style="font-size: 0.65rem;"></i>
                            </button>
                        </div>
                    </div>


                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="card border-dark border  ">
                        <div class="card-body p-2 pt-1">
                            <p class="card-text">No se encontraron registros </p>
                        </div>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
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
    </div>
    <?php echo $__env->make('livewire.procedures.form-pay', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<?php /**PATH D:\ICAPV4\ICAP\resources\views/livewire/procedures/plan-payment.blade.php ENDPATH**/ ?>