<div>
    <div class="row mx-1 g-2">
        <div class="col-md-3">
            <a href="#" class="text-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                aria-controls="offcanvasRight"> <u> <i class="far fa-question-circle"></i> Filtros de busqueda </u></a>
        </div>
        <div class="col-md-9">
            <div class="d-grid gap-1  d-md-flex justify-content-md-end">
                <a target="_blank" href="<?php echo e(route('pdf.report.statusAffiliate',['statusTotal' => $statusTotal])); ?>" class="btn btn-sm btn-outline-danger mb-1" type="button">
                    <i class="far fa-file-pdf fs-6"></i> Descargar PDF
                </a>
                <a href="<?php echo e(route('reporte.afiliados-excel',['statusTotal' => $statusTotal])); ?>" class="btn btn-sm btn-outline-success mb-1 " type="button">
                    <i class="far fa-file-excel fs-6"></i> Exporta a Excel</a>
            </div>
        </div>
    </div>
    <hr>
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
            <td><strong>GESTION:</strong> <?php echo e(now()->year); ?> </td>
        </tr>
        <tr>
            <td>
                <strong>Estados</strong>
                <div class="d-flex flex-wrap gap-1">
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $statusTotal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="badge rounded-pill text-dark  border border-dark border-1 text-bg-light d-inline-flex align-items-center">
                            <button type="button" class="border-0 bg-transparent text-dark"
                                wire:click="deleteItem('<?php echo e($key); ?>')" aria-label="Close"><i class="fas fa-times"></i></button> 
                             <?php echo e($key . ' = ' . $stat); ?>

                        </span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                </div>

            </td>
            <td class="text-center text-center fs-6" rowspan="2">
                <strong>
                    <?php echo e($affiliates->total()); ?>

                    <br>
                    TOTAL
                </strong>
            </td>
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
                <th class="text-center">Affiliado</th>
                <th class="text-center">Antiguedad</th>
                <th class="text-center">Ultimo pago aporte</th>
                <th class="text-center">Estado</th>
             <?php $__env->endSlot(); ?>
            <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $affiliates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $affiliate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($affiliate->id); ?></td>
                    <td><?php echo e($affiliate->user->full_name); ?></td>
                    <td class="text-center"><?php echo e($affiliate->antique); ?></td>
                    </td>
                    <td class="text-center">
                        <?php echo e(\Carbon\Carbon::parse($affiliate->ultimoPago)->locale('es')->isoFormat('MMMM YYYY')); ?>

                    </td>
                    <td class="text-center"><?php echo e($affiliate->status); ?></td>
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
        <?php echo e($affiliates->links()); ?>

    </div>
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
            <div class="form-floating">
                <select class="form-select" wire:model="status" id="floatingSelect"
                    aria-label="Floating label select example">
                    <option value="Activo">Activos</option>
                    <option value="Inactivo">Inactivos</option>
                    <option value="Exento">Exentos</option>
                    <option value="Fallecido">Fallecidos</option>
                    <option value="Retirada">Retirada</option>
                    <option value="Licencia">Licencia</option>
                </select>
                <label for="floatingSelect">Seleccione un estado</label>
                <span
                    style="font-size: 0.80rem; display: inline-block;
                            line-height: 1;">Filtra
                    los resultados de acuerdo al estado seleccionado</span>
            </div>
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
<?php /**PATH D:\ICAPV4\ICAP\resources\views/livewire/reports/status-affiliate.blade.php ENDPATH**/ ?>