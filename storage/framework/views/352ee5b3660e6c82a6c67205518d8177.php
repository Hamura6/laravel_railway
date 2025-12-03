<div>
    <?php if (isset($component)) { $__componentOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card-header','data' => ['title' => 'Historial de Cuotas']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Historial de Cuotas']); ?>
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
            <div class="col-md-12">
                <div class="d-grid gap-1  d-md-flex justify-content-md-end">

                    <a href="<?php echo e(route('pdf.report.contribution.affiliate',[$this->affiliate->id,$this->from,$this->to])); ?>" target="_blank" class="btn btn-sm btn-outline-danger mb-1" type="button">
                        <i class="far fa-file-pdf fs-6"></i> Descargar PDF
                    </a>
                    <a href="<?php echo e(route('reporte.contribution.affiliate-excel' ,[$this->affiliate->id,$this->from,$this->to])); ?>" class="btn btn-sm btn-outline-success mb-1 " type="button">
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
                    <td colspan="2"><strong>INSTITUCION: </strong><?php echo e($institution->name); ?> </td>
                    <td><strong>GESTION: <span id="year"></span></strong></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Nombre: </strong><?php echo e($this->affiliate->user->full_name); ?> </td>
                    <td><strong>Matricula: </strong><?php echo e($this->affiliate->id); ?> </td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Fecha: </strong><?php echo e($this->date); ?></td>
                    <td><strong>Estado:</strong> <?php echo e($this->affiliate->status); ?></td>
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
                        <th class="text-center">Nro</th>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Recaudador</th>
                        <th class="text-center">Aportes</th>
                        <th class="text-center">Descargo</th>
                        <th class="text-center">Total</th>
                     <?php $__env->endSlot(); ?>

                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $pagos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pago): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <?php echo e($loop->iteration); ?>

                            </td>
                            <td class="text-center">
                                <?php echo e($pago->updated_at); ?>

                            </td>
                            <td class="text-center">
                                <?php echo e($pago->user->full_name); ?>

                            </td>
                            <td class="text-center">
                                <?php echo e($pago->fecha_display); ?>

                            </td>
                            <td>

                                <?php echo e($pago->type); ?>

                            </td>
                            <td class="text-center">

                                <?php echo e($pago->amount); ?>


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
<?php /**PATH D:\ICAPV4\ICAP\resources\views/livewire/reports/contribution-affiliate.blade.php ENDPATH**/ ?>