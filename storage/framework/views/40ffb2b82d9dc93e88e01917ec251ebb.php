<div>
    <?php if (isset($component)) { $__componentOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card-header','data' => ['title' => 'Reporte de Pagos']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Reporte de Pagos']); ?>
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
        <div class="row mx-1 g-2">

            <div class="col-md-3">
                <a href="#" class="text-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                    aria-controls="offcanvasRight"> <u> <i class="far fa-question-circle"></i> Filtros de busqueda
                    </u></a>
            </div>
            <div class="col-md-9">
                <div class="d-grid gap-1  d-md-flex justify-content-md-end">

                    <a target="_blank" href="<?php echo e(route('pdf.report.contribution', [$this->from, $this->to])); ?>"
                        class="btn btn-sm btn-outline-danger mb-1" type="button">
                        <i class="far fa-file-pdf fs-6"></i> Descargar PDF
                    </a>
                    <a href="<?php echo e(route('reporte.contribution-excel', [$this->from, $this->to])); ?>"
                        class="btn btn-sm btn-outline-success mb-1 " type="button">
                        <i class="far fa-file-excel fs-6"></i> Exporta a Excel</a>
                </div>
            </div>
        </div>
        <hr>
        <div class="mx-2">
            <?php if (isset($component)) { $__componentOriginal32c4293829977fbd3fb7bfcb6f502967 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal32c4293829977fbd3fb7bfcb6f502967 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table-report','data' => ['class' => 'table-report table-striped']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table-report'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'table-report table-striped']); ?>
                <tr>
                    <td><strong>INSTITUCION:</strong> <?php echo e($institution->name); ?> </td>
                    <td><strong>GESTION:
                            <?php echo e(now()->year); ?>

                        </strong></td>

                </tr>
                <tr>
                    <td colspan="2"><strong>Fecha:</strong>
                        <?php echo e(\Carbon\Carbon::parse($this->from)->isoFormat('ddd, D \d\e MMM \d\e\l Y') .
                            ' al ' .
                            \Carbon\Carbon::parse($this->to)->isoFormat('ddd, D \d\e MMM \d\e\l Y')); ?>

                    </td>

                </tr>
                <tr>
                    <td><strong>CANTIDAD DE AFILIADOS:</strong> <?php echo e($affiliates->total()); ?> </td>
                    <td><strong>TOTAL DE APORTES:
                        </strong><?php echo e($affiliates->sum('payments_sum_amount')); ?> Bs.</td>

                </tr>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal32c4293829977fbd3fb7bfcb6f502967)): ?>
<?php $attributes = $__attributesOriginal32c4293829977fbd3fb7bfcb6f502967; ?>
<?php unset($__attributesOriginal32c4293829977fbd3fb7bfcb6f502967); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal32c4293829977fbd3fb7bfcb6f502967)): ?>
<?php $component = $__componentOriginal32c4293829977fbd3fb7bfcb6f502967; ?>
<?php unset($__componentOriginal32c4293829977fbd3fb7bfcb6f502967); ?>
<?php endif; ?>
            <div class="row mx-1 g-2">
                <div class="col-md-6">
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
            </div>
            <div class="table-responsive">
                <?php if (isset($component)) { $__componentOriginal32c4293829977fbd3fb7bfcb6f502967 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal32c4293829977fbd3fb7bfcb6f502967 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table-report','data' => ['class' => 'table table-report table-striped table-bordered']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table-report'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'table table-report table-striped table-bordered']); ?>
                     <?php $__env->slot('header', null, []); ?> 
                        <th class="text-center">Matricula</th>
                        <th class="text-center">Nombres Completo</th>
                        <th class="text-center">monto de aportes</th>
                        <th class="text-center">fecha de registro</th>
                        <th class="text-center">Telefono</th>
                        <th class="text-center">Detalle</th>
                     <?php $__env->endSlot(); ?>

                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $affiliates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $affiliate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="align-middle">
                            <td>
                                <?php echo e($affiliate->id); ?>

                            </td>
                            <td>
                                <?php echo e($affiliate->user->full_name); ?>

                            </td>
                            <td class="text-center">
                                <?php echo e($affiliate->payments_sum_amount ?? 0); ?> Bs.
                            </td>
                            <td class="text-center">

                                <?php echo e($affiliate->created_at); ?>


                            </td>

                            <td class="text-center">
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $affiliate->user->phones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo e($phone->number); ?>

                                    <br>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            </td>
                            <td class="text-center">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('reports')): ?>
                                    <a href="<?php echo e(route('report.contribution.affiliate', [$affiliate->id, $this->from, $this->to])); ?>"
                                        class="btn-purple-circle"> <i class="fas fa-eye"></i> </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal32c4293829977fbd3fb7bfcb6f502967)): ?>
<?php $attributes = $__attributesOriginal32c4293829977fbd3fb7bfcb6f502967; ?>
<?php unset($__attributesOriginal32c4293829977fbd3fb7bfcb6f502967); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal32c4293829977fbd3fb7bfcb6f502967)): ?>
<?php $component = $__componentOriginal32c4293829977fbd3fb7bfcb6f502967; ?>
<?php unset($__componentOriginal32c4293829977fbd3fb7bfcb6f502967); ?>
<?php endif; ?>
            </div>
        </div>
        <?php echo e($affiliates->links()); ?>

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
    <?php if (isset($component)) { $__componentOriginal05e1b91381536243391882e7bdd0b31f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal05e1b91381536243391882e7bdd0b31f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.question-offcanvas','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('question-offcanvas'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
        <div class="col-md-12">
            <strong class="text-dark">Edad minima</strong>
            <div class="form-floating ">
                <input type="date" class="form-control" wire:model="from" id="floatingInput"
                    placeholder="name@example.com">
                <label for="floatingInput">Desde</label>
            </div>
            <span style="font-size: 0.90rem; display: inline-block;
                            line-height: 1;">Filtra
                los resultados que tienes mayor o igual a la edad ingresada</span>
        </div>
        <div class="col-md-12">
            <strong class="text-dark"> Edad maxima</strong>
            <div class="form-floating">
                <input type="date" class="form-control" wire:model="to" id="floatingInput"
                    placeholder="name@example.com">
                <label for="floatingInput">Hasta</label>
            </div>
            <span style="font-size: 0.90rem; display: inline-block;
                            line-height: 1;">Filtra
                los resultados que tenga menor o igual a la edad ingresada</span>
        </div>

     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal05e1b91381536243391882e7bdd0b31f)): ?>
<?php $attributes = $__attributesOriginal05e1b91381536243391882e7bdd0b31f; ?>
<?php unset($__attributesOriginal05e1b91381536243391882e7bdd0b31f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal05e1b91381536243391882e7bdd0b31f)): ?>
<?php $component = $__componentOriginal05e1b91381536243391882e7bdd0b31f; ?>
<?php unset($__componentOriginal05e1b91381536243391882e7bdd0b31f); ?>
<?php endif; ?>

</div>
<?php /**PATH D:\ICAPV4\ICAP\resources\views/livewire/reports/contribution-report.blade.php ENDPATH**/ ?>