<div class="col-12">
    <?php if (isset($component)) { $__componentOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card-header','data' => ['title' => ''.e($this->id <= 0 ? 'Registrar' : 'Actualizar').' | Usuario','name' => 'Usuario']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e($this->id <= 0 ? 'Registrar' : 'Actualizar').' | Usuario','name' => 'Usuario']); ?>
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
            <h4 class="font-weight-bolder mb-0 text-dark">Datos Personales</h4>
         <?php $__env->endSlot(); ?>

        <form role="form text-left" wire:ignore.self>
            <div class="row g-1">
                <div class="col-md-8">
                    <div class="row g-1">
                        <div class="col-md-6">
                            <?php if (isset($component)) { $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-label','data' => ['name' => 'form.name']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'form.name']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $attributes = $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $component = $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>

                        </div>
                        <div class="col-md-6">
                            <?php if (isset($component)) { $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-label','data' => ['title' => 'apellidos','name' => 'form.last_name']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'apellidos','name' => 'form.last_name']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $attributes = $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $component = $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <?php if (isset($component)) { $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-label','data' => ['title' => 'Nro de Identidad','name' => 'form.ci','type' => 'string']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Nro de Identidad','name' => 'form.ci','type' => 'string']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $attributes = $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $component = $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <?php if (isset($component)) { $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-label','data' => ['title' => 'Fecha de Nac.','name' => 'form.birthdate','type' => 'date']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Fecha de Nac.','name' => 'form.birthdate','type' => 'date']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $attributes = $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $component = $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <?php if (isset($component)) { $__componentOriginaled2cde6083938c436304f332ba96bb7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled2cde6083938c436304f332ba96bb7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['title' => 'Seleccione el genero','name' => 'form.gender']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Seleccione el genero','name' => 'form.gender']); ?>
                                <option value="Femenino">Femenino</option>
                                <option value="Masculino">Masculino</option>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $attributes = $__attributesOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__attributesOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $component = $__componentOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__componentOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <?php if (isset($component)) { $__componentOriginaled2cde6083938c436304f332ba96bb7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled2cde6083938c436304f332ba96bb7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['title' => 'Seleccione el estado civil','name' => 'form.martial_status']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Seleccione el estado civil','name' => 'form.martial_status']); ?>
                                <option value="Casado">Casado</option>
                                <option value="Soltero">Soltero</option>
                                <option value="Divorciado">Divorciado</option>
                                <option value="Viudo">Viudo</option>
                                <option value="Comprometido">Comprometido</option>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $attributes = $__attributesOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__attributesOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $component = $__componentOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__componentOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>
                        </div>
                        <div class="col-md-12">
                            <?php if (isset($component)) { $__componentOriginaled2cde6083938c436304f332ba96bb7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled2cde6083938c436304f332ba96bb7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['title' => 'Seleccione el rol','name' => 'rol']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Seleccione el rol','name' => 'rol']); ?>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($rol->name); ?>"><?php echo e($rol->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $attributes = $__attributesOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__attributesOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $component = $__componentOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__componentOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>
                        </div>
                        <div class="col-md-12">
                            <?php if (isset($component)) { $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-label','data' => ['type' => 'email','name' => 'form.email','title' => 'Correo electronico']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'email','name' => 'form.email','title' => 'Correo electronico']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $attributes = $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $component = $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
                        </div>

                    </div>
                </div>
                <div class="col-md-4">



                    <div class="card align-center shadow-none justify-content-center h-100" align="center">
                        <div class="container">
                            <div
                                class="card-header p-0 mx-3 mt-3 position-relative z-index-1 d-flex justify-content-center align-items-center flex-column">

                                
                                <!--[if BLOCK]><![endif]--><?php if($photo): ?>
                                    <img class="border-radius-lg rounded-circle" width="200" height="200"
                                        src="<?php echo e($photo->temporaryUrl()); ?>" alt="Image placeholder" wire:loading.remove
                                        wire:target="photo">
                                <?php else: ?>
                                    <img class="border-radius-lg rounded-circle" width="200" height="200"
                                        src="<?php echo e($this->image ? $this->image : asset('image/user.png')); ?>"
                                        alt="Image placeholder" wire:loading.remove wire:target="photo">
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                <span class="spinner-grow text-dark" style="width: 3rem; height: 3rem;" wire:loading
                                    wire:target="photo" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </span>

                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="basic-url">Elija imagen</label>
                                <div class="input-group">
                                    <input type="file" wire:model="photo" wire:target="photo"
                                        wire:loading.attr="disabled"
                                        class="form-control <?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                is-invalid
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        id="basic-url" aria-describedby="basic-addon3">
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div id="validationServer05Feedback" class="invalid-feedback">
                                            <?php echo e($message); ?>

                                        </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            </div>
                        </div>
                    </div>

                </div>





                <div class="card-header border-bottom pb-0 mb-2">
                    <h4>Telefonos</h4>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3 text-sm-end">
                    <button class="btn btn-sm btn-warning" wire:click.prevent="add()" wire:target="add"
                        wire:loading.attr="disabled"> <i class="fas fa-plus-circle fs-6"></i> Agregar
                        telefono</button>
                </div>
                <div class="col-md-12">
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $phones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $phone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row g-1">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text">Telefono <?php echo e($index + 1); ?></span>
                                    <input type="number" wire:model="phones.<?php echo e($index); ?>"
                                        aria-label="First name"
                                        class="form-control <?php $__errorArgs = ['phones.' . $index];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            is-invalid
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                                </div>
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['phones.' . $index];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                            <div class="col-md-6">
                                <div class="d-grid gap-2 d-md-flex d-md-block justify-content-md-center">
                                    <!--[if BLOCK]><![endif]--><?php if($index): ?>
                                        <button class=" btn btn-sm btn-danger" wire:target="Phone"
                                            wire:loading.attr="disabled"
                                            wire:click.prevent="Phone(<?php echo e($index); ?>)">
                                            <i class="fa-solid fa-trash-can-arrow-up fs-6"></i>
                                            Quitar
                                        </button>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                </div>


                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3 text-sm-end">
                    <a href="<?php echo e(route('users')); ?>" wire:target="add,update,store"
                        wire:loading.class="disabled pointer-events-none opacity-50" class="btn btn-sm btn-danger">
                        <i class="fas fa-ban fs-6"></i> Cancel</a>
                    <!--[if BLOCK]><![endif]--><?php if($this->id): ?>
                        <button wire:click.prevent="update()" wire:target="add,update,store,photo"
                            wire:loading.attr="disabled" class="btn btn-sm btn-info"> <i
                                class="fas fa-paste fs-6"></i> Actualizar</button>
                    <?php else: ?>
                        <button class="btn btn-sm btn-dark" wire:target="add,update,store,photo"
                            wire:loading.attr="disabled" wire:click.prevent="store()"> <i
                                class="fas fa-save fs-6"></i> Guardar</button>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>
            </div>
        </form>

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
<?php /**PATH D:\ICAPV4\ICAP\resources\views/livewire/auth/create.blade.php ENDPATH**/ ?>