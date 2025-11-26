<div>
    <?php if (isset($component)) { $__componentOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card-header','data' => ['title' => 'Gestión de Pagos','name' => 'Saldos']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Gestión de Pagos','name' => 'Saldos']); ?>
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
    <div class="card border m-0  border-dark h-100">
        <div class="card-header p-2 border-bottom">
            <div class="row g-1 ustify-content-between">
                <h4>Configuracion</h4>
                <div class="d-flex justify-content-start">
                    <a href="<?php echo e(route('institution.requirement')); ?>" class="btn btn-sm btn-success"> <i class="fas fa-clipboard-list"></i> Requisitos</a>
                </div>
            </div>
        </div>
        <div class="card-body p-2">
            <fieldset>
                <div class="row  g-2">
                    <div class="col-md-12">
                        <div
                            class="p-0 mx-3 mt-3 position-relative z-index-1 d-flex justify-content-center align-items-center flex-column">
                            <!--[if BLOCK]><![endif]--><?php if($photo): ?>
                                <img class="border-radius-lg rounded-circle" width="200" height="200"
                                    src="<?php echo e($photo->temporaryUrl()); ?>" alt="Image placeholder" wire:loading.remove
                                    wire:target="photo">
                            <?php else: ?>
                                <img class="border-radius-lg rounded-circle" width="200" height="200"
                                    src="<?php echo e($this->image ? $this->image : 'https://i.pinimg.com/originals/bd/2e/0d/bd2e0d56cc9b061d694979158bda4d0b.jpg'); ?>"
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
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text"
                                class="form-control <?php $__errorArgs = ['institution.initials'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                wire:model="institution.initials" id="floatingInput" placeholder="Fecha">
                            <label for="floatingInput">Nombre abreviado de la institucion </label>
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['institution.initials'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger"> <?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-floating">
                            <input type="text" class="form-control <?php $__errorArgs = ['institution.name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                wire:model="institution.name" id="floatingInput" placeholder="Fecha">
                            <label for="floatingInput">Licencia hasta </label>
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['institution.name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger"> <?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <textarea style="height: 150px" class="form-control <?php $__errorArgs = ['institution.mission'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                wire:model="institution.mission" id="floatingInput" placeholder="Descripcion" cols="30" rows="20"></textarea>
                            <label for="floatingInput">Mision</label>
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['institution.mission'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger"> <?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <textarea style="height: 150px" class="form-control <?php $__errorArgs = ['institution.vision'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                wire:model="institution.vision" id="floatingInput" placeholder="Descripcion" cols="30" rows="20"></textarea>
                            <label for="floatingInput">Vision</label>
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['institution.vision'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger"> <?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-floating">
                            <input type="email" class="form-control <?php $__errorArgs = ['institution.email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                wire:model="institution.email" id="floatingInput" placeholder="Fecha">
                            <label for="floatingInput">Correo electronico </label>
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['institution.email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger"> <?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="number" class="form-control <?php $__errorArgs = ['institution.phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                wire:model="institution.phone" id="floatingInput" placeholder="Fecha">
                            <label for="floatingInput">Numero de telefono </label>
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['institution.phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger"> <?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-floating">
                            <input type="text"
                                class="form-control <?php $__errorArgs = ['institution.address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                wire:model="institution.address" id="floatingInput" placeholder="Fecha">
                            <label for="floatingInput">Direccion</label>
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['institution.address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger"> <?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-floating">
                            <select class="form-select <?php $__errorArgs = ['institution.city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> "
                                wire:model="institution.city" id="floatingSelect"
                                aria-label="Floating label select example">
                                <option value="Elegir" disabled>Seleccion</option>
                                <option value="LP">La Paz</option>
                                <option value="PT">Potosi</option>
                                <option value="OR">Oruro</option>
                                <option value="CB">Cochabamba</option>
                                <option value="SC">Santa Cruz</option>
                                <option value="TJ">Tarija</option>
                                <option value="CH">Chuquisaca</option>
                                <option value="BN">Beni</option>
                                <option value="PD">Pando</option>
                            </select>
                            <label for="floatingSelect">Seleccione una ciudad</label>
                        </div>
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['institution.city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger"> <?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button class="btn btn-sm  btn-info" wire:click="update()"
                wire:loading.class="disabled pointer-events-none opacity-50"><i class="fas fa-edit"></i> Actualizar
                Informacion</button>
        </div>
    </div>
</div>
<?php /**PATH D:\ICAPV4\ICAP\resources\views/livewire/institutions/institution-component.blade.php ENDPATH**/ ?>