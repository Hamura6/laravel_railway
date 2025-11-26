<div>
    <style>
        @media (max-width: 576px) {

            .stacked-table td,
            .stacked-table th {
                display: block;
                width: 100%;
                white-space: normal;
                word-wrap: break-word;
                overflow-wrap: break-word;
            }

            .stacked-table tr {
                display: block;
                margin-bottom: 1rem;
                border-bottom: 1px solid #dee2e6;
            }

            .stacked-table td strong {
                display: inline-block;
                min-width: 120px;
                vertical-align: top;
            }
        }
    </style>
    <div class="row g-2">
        <?php if (isset($component)) { $__componentOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card-header','data' => ['title' => 'Historial de Denuncias','name' => 'Demandas']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Historial de Denuncias','name' => 'Demandas']); ?>
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
        <div class="col-md-12">

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
                    <table class="table table-striped table-bordered table-sm mb-0 stacked-table">
                        <tbody>
                            <tr>
                                <td> <strong>Nombre Completo:</strong> <?php echo e($this->affiliate->user->full_name); ?></td>
                                <td><strong>Matrícula:</strong> <?php echo e($this->affiliate->id); ?></td>
                                <td> <strong>C.I:</strong> <?php echo e($this->affiliate->user->ci); ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <strong>
                                        Teléfonos:
                                    </strong>
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $this->affiliate->user->phones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="badge bg-light text-dark me-1"><?php echo e($phone->number); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                </td>
                                <td class="d-block d-sm-table-cell  text-wrap"><strong>Correo electrónico:</strong>
                                    <?php echo e($this->affiliate->user->email); ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="d-block d-sm-table-cell text-wrap"><strong>Dirección de
                                        domicilio:</strong>
                                    <?php echo e($this->affiliate->address_home . ' No ' . $this->affiliate->address_number_home . ' / ' . $this->affiliate->zone_home); ?>

                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="d-block d-sm-table-cell text-wrap">
                                    <strong>
                                        Dirección procesal:
                                    </strong>
                                    <?php echo e($this->affiliate->address_office . ' No ' . $this->affiliate->address_number . ' / ' . $this->affiliate->zone); ?>

                                </td>
                            </tr>
                        </tbody>
                    </table>

                 <?php $__env->endSlot(); ?>
                <div class="col-md-12 d-grid gap-1 d-md-flex justify-content-md-end">
                    <a href="<?php echo e(route('demandsDetails', $this->affiliate->id)); ?>"
                        class="btn btn-outline-danger btn-sm px-2" type="button">
                        <i class="fas fa-file-pdf fs-6"></i> Descargar PDF
                    </a>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('demands.create')): ?>
                        <button class="btn btn-dark btn-sm px-2" data-bs-toggle="modal" data-bs-target="#myModal"
                            type="button">
                            <i class="far fa-file-alt fs-6"></i> Agregar Nueva Demanda
                        </button>
                    <?php endif; ?>
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



        <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $demands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-4">
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
                        <h4 class="text-center p-0 m-0">
                            <i class="fas fa-user-tag"></i>
                            <?php echo e($demand->date); ?>

                        </h4>
                        <p class="fw-bold p-0 m-0 text-center text-dark "><?php echo e($demand->name); ?></p>
                        <p class="fw-bold p-0 m-0  text-dark "><?php echo e($demand->complainant); ?></p>
                        <p class="fw-bold p-0 m-0  text-dark "><?php echo e($demand->phone); ?></p>
                        <div class="card-footer bg-transparent m-0 p-0 border-0 d-flex justify-content-between ">

                            <small>
                                <i class="far fa-calendar-alt me-1"></i> <?php echo e($demand->created_at); ?>

                            </small>
                            <div>
                                <?php
                                    $statusColor = match ($demand->status) {
                                        'Rechazada' => 'success',
                                        'Abierta' => 'danger',
                                        'En proceso' => 'warning',
                                        'Pendiente' => 'secondary',
                                        'Resulta' => 'dark',
                                        default => 'info',
                                    };
                                ?>
                                <span
                                    class="badge text-bg-<?php echo e($statusColor); ?>  px-3 py-2 shadow-sm rounded-pill fw-semibold">
                                    <i class="fas fa-circle me-1"></i><?php echo e($demand->status); ?>

                                </span>
                            </div>
                        </div>
                     <?php $__env->endSlot(); ?>
                    <div class="mb-0" style="min-height: 30px;">
                        <span class=" text-info"><?php echo e($demand->description); ?></span>
                    </div>
                    <div class="card-footer bg-transparent border-0 d-flex justify-content-center d-grid gap-1">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('demands.edit')): ?>
                            <button type="button" wire:target="changeStatus, delete, edit" wire:loading.attr="disabled"
                                wire:click="edit(<?php echo e($demand->id); ?>)" class="btn btn-sm mb-0 btn-outline-info w-100 p-2 "
                                data-bs-toggle="tooltip" data-bs-title="Editar" wire:loading.attr="disabled">
                                <i class="fas fa-edit fs-6"></i> Editar
                            </button>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('demands.delete')): ?>
                            <button type="button" wire:target="changeStatus, delete, edit" wire:loading.attr="disabled"
                                onclick="Confirm(<?php echo e($demand->id); ?>)"
                                class="btn btn-sm btn-outline-danger mb-0 p-2  w-100" data-bs-toggle="tooltip"
                                data-bs-title="Eliminar" wire:loading.attr="disabled">
                                <i class="fas fa-trash fs-6"></i> Eliminar
                            </button>
                        <?php endif; ?>
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
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12">
                <div class="alert alert-info text-center rounded-3 py-3 shadow-sm">
                    <i class="far fa-sad-tear"></i> No hay demandas registradas para este afiliado.
                </div>
            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>
    <div class="border-top py-3 px-3 d-flex align-items-center">
        <?php echo e($demands->links()); ?>

    </div>
    <?php echo $__env->make('livewire.demands.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<?php /**PATH D:\ICAPV4\ICAP\resources\views/livewire/demands/demands-details.blade.php ENDPATH**/ ?>