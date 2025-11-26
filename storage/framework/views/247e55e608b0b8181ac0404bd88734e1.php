<div>
    <div class="row mx-1 g-2">

        <div class="col-md-3">
            <a href="#" class="text-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                aria-controls="offcanvasRight"> <u> <i class="far fa-question-circle"></i> Filtros de busqueda </u></a>
        </div>
        <div class="col-md-9">
            <div class="d-grid gap-1  d-md-flex justify-content-md-end">

                <a target="_blank" href="<?php echo e(route('pdf.report.ageAffiliate', [$this->minor, $this->max,$this->status])); ?>"
                    class="btn btn-sm btn-outline-danger mb-1" type="button">
                    <i class="far fa-file-pdf fs-6"></i> Descargar PDF
                </a>
                <a href="<?php echo e(route('reporte.age.afiliados-excel',[$this->minor, $this->max,$this->status])); ?>" class="btn btn-sm btn-outline-success mb-1 " type="button">
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
                <td colspan="2"><strong>INSTITUCION:</strong> <?php echo e($institution->name); ?> </td>
                <td><strong>GESTION:
                        <?php echo e(now()->year); ?>

                    </strong></td>

            </tr>
            <tr>
                <td><strong>Masculino:</strong> <?php echo e($masculino); ?> </td>
                <td><strong>Femenino:</strong> <?php echo e($femenino); ?> </td>
                <td rowspan="3" class="text-center"> <strong class="fs-6"> <?php echo e($affiliates->total()); ?></strong>
                    <br><strong>Total</strong>
                </td>
            </tr>
            <tr>
                <td colspan="2"><strong>Rango de edad:</strong> De <?php echo e($this->minor); ?> a <?php echo e($this->max); ?> anos de
                    edad
                </td>
            </tr>
            <tr>
                <td colspan="2"><strong>Estado: </strong> <?php echo e($this->status ? $this->status : 'Todos'); ?>

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
                    <th class="text-center">#</th>
                    <th class="text-center">Nombres Completo</th>
                    <th class="text-center">Edad</th>
                    <th class="text-center">Correo Electronico</th>
                    <th class="text-center">Genero</th>
                    <th class="text-center">Telefono</th>
                 <?php $__env->endSlot(); ?>

                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $affiliates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $affiliate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="text-center">
                            <?php echo e($loop->iteration); ?>

                        </td>
                        <td>
                            <?php echo e($affiliate->user->full_name); ?>

                        </td>
                        <td class="text-center">
                            <?php echo e($affiliate->user->age); ?>

                        </td>
                        <td>

                            <?php echo e($affiliate->user->email); ?>


                        </td>
                        <td class="text-center">

                            <?php echo e($affiliate->user->gender); ?>


                        </td>
                        <td class="text-center">
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $affiliate->user->phones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($phone->number); ?>

                                <br>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
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
                <input type="input" class="form-control" wire:model="minor" id="floatingInput"
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
                <input type="input" class="form-control" wire:model="max" id="floatingInput"
                    placeholder="name@example.com">
                <label for="floatingInput">Hasta</label>
            </div>
            <span style="font-size: 0.90rem; display: inline-block;
                            line-height: 1;">Filtra
                los resultados que tenga menor o igual a la edad ingresada</span>
        </div>
        <div class="col-md-12">
            <strong class="text-dark"> Seleccione estado</strong>
            <div class="form-floating">
                <select class="form-select" wire:model="status" id="floatingSelect"
                    aria-label="Floating label select example">
                    <option value="">Todos</option>
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
<?php /**PATH D:\ICAPV4\ICAP\resources\views/livewire/reports/age-affiliate.blade.php ENDPATH**/ ?>