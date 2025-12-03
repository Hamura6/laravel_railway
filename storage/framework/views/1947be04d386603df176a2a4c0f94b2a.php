<div>
    <?php if (isset($component)) { $__componentOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card-header','data' => ['title' => 'Historial de Saldo','name' => 'Afiliados']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Historial de Saldo','name' => 'Afiliados']); ?>
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
        <div class="col-md-12">
            <div class="card border shadow-xs mb-4">
                <div class="card-header border-bottom pb-0">
                    <table class="table  table-bordered border-light table-striped  stacked-table">
                        <tbody>
                            <tr>
                                <th scope="col" class="text-dark text-xs font-weight-bold ">Nombre Completo:</th>
                                <td class="text-sm text-secondary mb-0"><?php echo e($affiliate->user->name); ?> </td>
                                <th scope="col" class="text-dark text-xs font-weight-bold ">Matricula:</th>
                                <td class="text-sm text-secondary mb-0"><?php echo e($affiliate->id); ?></td>
                                <th scope="col" class="text-dark text-xs font-weight-bold ">C.I:</th>
                                <td class="text-sm text-secondary mb-0"><?php echo e($affiliate->user->ci); ?></td>
                            </tr>
                            <tr>
                                <th scope="col" class="text-dark text-xs font-weight-bold ">Telefonos:</th>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $affiliate->user->phones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <td class="text-sm text-secondary mb-0"><?php echo e($phone->number); ?> </td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                <th scope="col" class="text-dark text-xs font-weight-bold ">Correo electronico:</th>
                                <td class="text-sm text-secondary mb-0" colspan="3"><?php echo e($affiliate->user->email); ?>

                                </td>

                            </tr>
                            <tr>
                                <th scope="col" class="text-dark text-xs font-weight-bold "> total:</th>
                                <td class="text-sm text-secondary mb-0">
                                    <?php echo e($affiliate->totalSum); ?> Bs.
                                </td>
                                <th scope="col" class="text-dark text-xs font-weight-bold "> Pagado:</th>
                                <td class="text-sm text-secondary mb-0">
                                    <?php echo e($affiliate->total_pagado + $affiliate->planes); ?> Bs.
                                </td>
                                <th scope="col" class="text-dark text-xs font-weight-bold "> Deuda:</th>
                                <td class="text-sm text-secondary mb-0">
                                    <?php echo e($affiliate->prest - $affiliate->planes); ?> Bs.
                                </td>
                            </tr>
                    </table>
                    <hr class="my-0">
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input type="number " class="form-control" wire:model="year" id="floatingInput"
                                    placeholder="name@example.com">
                                <label for="floatingInput">Desde</label>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" wire:model="type" id="floatingSelect"
                                    aria-label="Floating label select example">
                                    <option value="">Todos</option>
                                    <option value="Por pagar">Por pagar</option>
                                    <option value="Pagado">Pagado</option>
                                </select>
                                <label for="floatingSelect">Seleccione</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" wire:model="concept" id="floatingSelect"
                                    aria-label="Floating label select example">
                                    <option value="">Todos</option>
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $fees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($fee->id); ?>"><?php echo e($fee->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                </select>
                                <label for="floatingSelect">Seleccione el concepto</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-grid gap-1  d-md-flex justify-content-md-end">
                                <a href="<?php echo e(route('pdf.report.affiliateDebt', [$affiliate->id, $this->year, $this->type, $this->concept])); ?>"
                                    class="btn btn-sm btn-outline-danger mb-1" type="button">
                                    <i class="far fa-file-pdf fs-6"></i>
                                    Descargar PDF
                                </a>
                                <button class="btn btn-sm btn-info mb-1 " wire:click.prevent='update()' type="button">
                                    <i class="far fa-question-circle fs-6"></i>
                                    Realizar consulta</button>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 py-0">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th>#</th>
                                    <th>Tipo</th>
                                    <th>Fecha</th>
                                    <th>Fecha de registro</th>
                                    <th>Monto</th>
                                    <th>Deuda</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>


                                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($payment->fee->name); ?></td>
                                        <td><?php echo e($payment->fecha_display); ?></td>
                                        <td><?php echo e($payment->updated_at); ?></td>
                                        <td><?php echo e($payment->amount); ?></td>
                                        <td><?php echo e($payment->debt); ?></td>
                                        <td><span
                                        class="badge rounded-pill  <?php echo e($payment->status == 'Por pagar' ? 'text-danger  border border-danger ' : 'text-success  border border-success '); ?> border-1"><?php echo e($payment->status); ?></span></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr class="align-middle" align="center">
                                <td colspan="7">
                                    <h5>
                                        <i class="far fa-sad-tear"></i>

                                        No se encontraron registros...
                                    </h5>
                                </td>
                            </tr>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </tbody>
                        </table>
                        <div class="border-top py-3 px-3 d-flex align-items-center">
                            <?php echo e($payments->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





</div>
<?php /**PATH D:\ICAPV4\ICAP\resources\views/livewire/affiliate/view-component.blade.php ENDPATH**/ ?>