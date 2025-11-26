<div>
    <?php if (isset($component)) { $__componentOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card-header','data' => ['title' => 'Condecoracion','name' => 'Pagos']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Condecoracion','name' => 'Pagos']); ?>
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
                    <h6 class="text-secondary">Datos del evento </h6>
                 <?php $__env->endSlot(); ?>

                <table class="table  table-bordered border-light table-striped">
                    <tbody>
                        <tr>
                            <th> Fecha:</th>
                            <td>
                                <?php echo e($this->recognition->date); ?>

                            </td>
                        </tr>
                        <tr>
                            <th> Tipo:</th>
                            <td>
                                <?php echo e(__($this->recognition->type)); ?>

                            </td>
                        </tr>
                        <tr>
                            <th>Acontecimiento:</th>
                            <td><?php echo e($this->recognition->name); ?>

                            </td>
                        </tr>
                        <tr>
                            <th>Aportes a conciderar:</th>
                            <td><?php echo e($this->recognition->quantity); ?>

                            </td>
                        </tr>
                        <tr>
                            <th>Cantidad de participantes:
                            </th>
                            <td><?php echo e($this->recognition->participants); ?></td>

                        </tr>
                        <tr>
                            <th>Tiempo restante para el
                                evento:</th>
                            <td><?php echo e($this->recognition->remaining_days); ?></td>

                        </tr>
                        <tr>

                            <td colspan="2">
                                <div class="d-grid gap-1  d-md-flex justify-content-md-end">

                                    <a target="_blank" href="<?php echo e(route('pdf.listAffiliate', $this->recognition->id)); ?>"
                                        class="btn btn-sm btn-outline-danger mb-1" type="button">
                                        <i class="far fa-file-pdf fs-6"></i> Descargar PDF
                                    </a>
                                    <a href="<?php echo e(route('reporte.listAffiliates-excel', $this->recognition->id)); ?>"
                                        class="btn btn-sm btn-outline-success mb-1 " type="button">
                                        <i class="far fa-file-excel fs-6"></i> Exporta a Excel</a>
                                </div>
                            </td>

                        </tr>


                </table>

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
                        <th>Matricula</th>
                        <th>Nombre</th>
                        <th>Antiguedad</th>
                        <th>Fecha <br>Inscripcion</th>
                        <th>Telefono</th>
                        <th>Quitar</th>
                     <?php $__env->endSlot(); ?>
                    <tbody>
                        <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $affiliatesConfirm; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cofirm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="align-middle">
                                <td><?php echo e($cofirm->id); ?></td>
                                <td>
                                    <?php echo e($cofirm->user->title . ' ' . $cofirm->user->full_name); ?></td>
                                <td><?php echo e($cofirm->antique); ?></td>
                                <td><?php echo e($cofirm->created_at); ?></td>
                                <td><?php echo e($cofirm->user->phones->first()->number ?? 'Ninguno'); ?></td>
                                <td>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('recognitions.edit')): ?>
                                        <button class="btn-dc-circle"
                                            onclick="Question(<?php echo e($cofirm->id); ?>, '¿Desear descartar como participante?', 'removeAffiliate')">
                                            <i class="fas fa-times fs-6"></i>
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" align="center">
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

                <div class="border-top py-3 px-3 d-flex align-items-center">
                    <?php echo e($affiliatesConfirm->links()); ?>

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
        <div class="col-md-4" style="max-height: 140vh; overflow-y: auto;">
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
                    <h6 class="text-secondary">Lista de afiliados habilidatos</h6>
                    <div class="input-group input-group-sm ms-auto me-2">
                        <span class="input-group-text text-body">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" wire:model.live.debounce.1000ms="toSearch"
                            class="form-control form-control-sm" placeholder="Buscar">
                    </div>

                 <?php $__env->endSlot(); ?>
                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $affiliates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $affiliate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="card shadow-md mb-2">
                        <div class="card-body p-2">

                            <div class="d-flex align-items-center mb-1">
                                <h5 class="card-title fw-bold mb-0 text-dark">
                                    <?php echo e($affiliate->user->gender == 'Masculino' ? 'Dr. ' : 'Dra. '); ?>

                                    <?php echo e($affiliate->user->name); ?> <?php echo e($affiliate->user->last_name); ?>

                                </h5>
                            </div>

                            <ul class="list-unstyled small text-muted mb-0">
                                <li><strong>Matrícula:</strong> <?php echo e($affiliate->id); ?></li>
                                <li><strong>Estado:</strong> <span
                                        class="badge bg-light text-dark"><?php echo e($affiliate->status); ?></span></li>
                                <li><strong>Antigüedad:</strong> <?php echo e($affiliate->antique); ?></li>
                                <li><strong>Cuotas pendientes:</strong> <?php echo e($affiliate->pending_payments_count); ?></li>

                                <li><strong>Inscripción:</strong> <?php echo e($affiliate->created_at); ?></li>
                                <li class="d-flex justify-content-between m-0">
                                    <div>
                                        <strong>Celular:</strong>
                                        <?php echo e(optional($affiliate->user->phones->first())->number ?? 'N/A'); ?>

                                    </div>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('recognitions.edit')): ?>
                                        <button class="btn-cc-circle outlined"
                                            onclick="Question(<?php echo e($affiliate->id); ?>, '¿Desea confirmar su participación?', 'AddAffiliate')">
                                            <i class="fas fa-check fs-6"></i>
                                        </button>
                                    <?php endif; ?>
                                </li>
                            </ul>


                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center shadow-sm">
                            <i class="far fa-sad-tear"></i> No se encontraron registros
                        </div>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                <div class="text-center py-4 color-dark justify-content-center w-100" wire:loading
                    wire:target="toSearch">
                    <div class="spinner-border " style="width: 4rem; height: 4rem;" role="status">
                        <span class="visually-hidden ">Loading...</span>
                    </div>
                </div>
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
    </div>
</div>
<?php /**PATH D:\ICAPV4\ICAP\resources\views/livewire/recognitions/recognition-details.blade.php ENDPATH**/ ?>