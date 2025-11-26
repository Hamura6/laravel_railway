<div>
    <style>
        .shadow-red {
            text-shadow: 0 0 9px rgb(212, 6, 6);
            color: rgb(150, 150, 150)
        }

        .shadow-success {

            text-shadow: 0 0 9px rgb(6, 212, 33);
            color: gray;
        }
    </style>
    <?php if (isset($component)) { $__componentOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card-header','data' => ['title' => 'Gestión de Trámites','name' => 'Trámites']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Gestión de Trámites','name' => 'Trámites']); ?>
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
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('procedures.create')): ?>
                <div class="col-12 col-md-6 order-1 order-md-2">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" class="btn btn-sm  btn-success " data-bs-toggle="modal"
                            data-bs-target="#myModal">
                            <i class="far fa-file-alt fs-6"></i> Nuevo
                        </button>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-12 col-md-6 order-2  order-md-1">
                <?php if (isset($component)) { $__componentOriginal22b5b970271de63f2ab96f835624c6eb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal22b5b970271de63f2ab96f835624c6eb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.selected-live','data' => ['name' => 'selected','title' => 'Seleccione el tipo de tramite']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('selected-live'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'selected','title' => 'Seleccione el tipo de tramite']); ?>
                    <option value="">Todas</option>
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $fees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($fee->id); ?>"><?php echo e($fee->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal22b5b970271de63f2ab96f835624c6eb)): ?>
<?php $attributes = $__attributesOriginal22b5b970271de63f2ab96f835624c6eb; ?>
<?php unset($__attributesOriginal22b5b970271de63f2ab96f835624c6eb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal22b5b970271de63f2ab96f835624c6eb)): ?>
<?php $component = $__componentOriginal22b5b970271de63f2ab96f835624c6eb; ?>
<?php unset($__componentOriginal22b5b970271de63f2ab96f835624c6eb); ?>
<?php endif; ?>
            </div>
            <div class="col-12 col-md-6  order-3">
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
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $this->discounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $discount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="alert alert-success alert-dismissible fade show mb-1 p-1" role="alert">
                    <strong>Descuento del <?php echo e($discount->discount_value); ?>% válido:</strong>
                    <?php echo e($discount->start_date . ' | ' . $discount->end_date); ?> <br>
                    <small>Aplicado a: <em><?php echo e($discount->fees->pluck('name')->join(', ')); ?></em></small>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->

         <?php $__env->endSlot(); ?>
        <div class="row g-2" wire:target="search" wire:loading.remove>
            <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $procedures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $procedure): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-4">
                    <div class="card border  mb-0 h-100 d-flex flex-column">
                        <div class="card-header  py-1 d-flex justify-content-between text-center ">
                            <strong class="fs-6">
                                <?php echo e($procedure->fee->name); ?>

                            </strong>
                            <i
                                class="fas fa-clipboard-list <?php if($procedure->status == 'Por pagar'): ?> shadow-red <?php else: ?> shadow-success <?php endif; ?> fs-4"></i>
                        </div>
                        <div class="card-body px-0 ">
                            <ul class="list-group list-group-flush ">
                                <li class="list-group-item py-0 pb-1 border-0"> <strong> <i
                                            class="fas fa-calendar-alt"></i> Fecha:
                                    </strong><?php echo e($procedure->date); ?> </li>
                                <li class="list-group-item py-0 pb-1 border-0"> <strong><i class="fas fa-id-badge"></i>
                                        Matrícula:
                                    </strong> <?php echo e($procedure->affiliate->id); ?> </li>
                                <li class="list-group-item py-0 pb-1 border-0"><strong><i class="far fa-id-card"></i>
                                        ci:
                                    </strong><?php echo e($procedure->affiliate->user->ci); ?>

                                </li>
                                <li class="list-group-item py-0 pb-1 border-0"><strong><i
                                            class="fas fa-user-circle"></i> Nombre:
                                    </strong><?php echo e($procedure->affiliate->user->full_name); ?> </li>
                                <li class="list-group-item py-0 pb-1 border-0"><strong><i class="fas fa-phone"></i>
                                        Celular:
                                    </strong><?php echo e($procedure->affiliate->user->phones->first()->number ?? 'No registrado'); ?>

                                </li>
                                <hr class="p-0  m-0 mx-3 text-middle pb-1">
                                <li class="list-group-item border-0 py-0"><strong><i
                                            class="fas fa-money-bill-wave text-info"></i> Costo:
                                    </strong><?php echo e($procedure->amount); ?> Bs. </li>
                                <!--[if BLOCK]><![endif]--><?php if($procedure->debt): ?>
                                    <li class="list-group-item py-0  border-0"> <strong><i
                                                class="fas fa-file-invoice-dollar text-danger"></i> Deuda:
                                            
                                        </strong><span
                                            class="badge badge-sm border rounded-pill border-danger text-danger"><?php echo e($procedure->debt); ?>

                                            Bs.</span> </li>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </ul>

                        </div>
                        <div class="card-footer py-1 d-flex gap-1 justify-content-end">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('procedures.delete')): ?>
                                <?php if (isset($component)) { $__componentOriginal3fa869ab4147c9277d9fa157f1637985 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3fa869ab4147c9277d9fa157f1637985 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn-delete','data' => ['id' => ''.e($procedure->id).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn-delete'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => ''.e($procedure->id).'']); ?>
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
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('procedures.edit')): ?>
                                <?php if (isset($component)) { $__componentOriginale9f0fcc686d5ab9265b8e88cbb55bbb0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale9f0fcc686d5ab9265b8e88cbb55bbb0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn-edit','data' => ['id' => ''.e($procedure->id).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn-edit'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => ''.e($procedure->id).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale9f0fcc686d5ab9265b8e88cbb55bbb0)): ?>
<?php $attributes = $__attributesOriginale9f0fcc686d5ab9265b8e88cbb55bbb0; ?>
<?php unset($__attributesOriginale9f0fcc686d5ab9265b8e88cbb55bbb0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale9f0fcc686d5ab9265b8e88cbb55bbb0)): ?>
<?php $component = $__componentOriginale9f0fcc686d5ab9265b8e88cbb55bbb0; ?>
<?php unset($__componentOriginale9f0fcc686d5ab9265b8e88cbb55bbb0); ?>
<?php endif; ?>
                            <?php endif; ?>
                            <!--[if BLOCK]><![endif]--><?php if($procedure->fee->type == 'installments'): ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('procedures.view')): ?>
                                    <a type="button" wire:target="changeStatus, delete"
                                        wire:loading.class="disabled pointer-events-none opacity-50"
                                        href="<?php echo e(route('procedures.details', $procedure->id)); ?>" class="btn-purple-circle"
                                        data-bs-toggle="tooltip" data-bs-title="Ver detalle">
                                        <i class="fas fa-eye fs-6"></i>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            <!--[if BLOCK]><![endif]--><?php if($procedure->debt > 0): ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('payments.pay')): ?>
                                    <button wire:target="check, delete, edit" wire:loading.attr="disabled"
                                        class="btn-cc-circle outlined"
                                        onclick="Question(<?php echo e($procedure->id); ?>,'Desea realizar el pago completo del tramite?','check')"
                                        data-bs-toggle="tooltip" data-bs-title="Pagar saldo">
                                        <i class="fas fa-hand-holding-usd fs-6"></i></button>
                                <?php endif; ?>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="far fa-sad-tear me-2"></i> No se encontró ningún registro...
                    </div>
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>

        <div class="col-md-12" wire:target="search" wire:loading>
            <div class="card border m-2">
                <div class="card-body m-0">
                    <div class="d-flex flex-row justify-content-center">
                        <div class="spinner-border " style="width: 4rem; height: 4rem;" role="status">
                            <span class="visually-hidden ">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-top py-3 px-3 d-flex align-items-center">
            <?php echo e($procedures->links()); ?>


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
    <?php echo $__env->make('livewire.procedures.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<?php /**PATH D:\ICAPV4\ICAP\resources\views/livewire/procedures/procedure-component.blade.php ENDPATH**/ ?>