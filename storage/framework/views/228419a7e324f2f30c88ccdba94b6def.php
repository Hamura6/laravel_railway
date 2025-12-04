<div class="col-12">
    <?php if (isset($component)) { $__componentOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card-header','data' => ['title' => ''.e($this->id <= 0 ? 'Crear' : 'Actualizar').' | Convenio','name' => 'Convenio']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e($this->id <= 0 ? 'Crear' : 'Actualizar').' | Convenio','name' => 'Convenio']); ?>
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
            <h4 class="py-0">Datos de convenio</h4>
         <?php $__env->endSlot(); ?>
        <form role="form text-left" wire:ignore.self>
            <div class="row g-1">
                <div class="col-md-4">
                    <div class="row g-1">
                        <div class="col-md-12">
                            <div class="card align-center shadow-none justify-content-center h-100" align="center">
                                <div class="container">
                                    <div
                                        class="card-header p-0 mx-3 mt-3 position-relative z-index-1 d-flex justify-content-center align-items-center flex-column">
                                        <!--[if BLOCK]><![endif]--><?php if($photo): ?>
                                            <img class="border-radius-lg rounded-circle" width="200" height="200"
                                                src="<?php echo e($photo->temporaryUrl()); ?>" alt="Image placeholder"
                                                wire:loading.remove wire:target="photo">
                                        <?php else: ?>
                                            <img class="border-radius-lg rounded-circle" width="200" height="200"
                                                src="<?php echo e($this->image ? $this->image : 'https://i.pinimg.com/originals/bd/2e/0d/bd2e0d56cc9b061d694979158bda4d0b.jpg'); ?>"
                                                alt="Image placeholder" wire:loading.remove wire:target="photo">
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                        <span class="spinner-grow text-dark" style="width: 3rem; height: 3rem;"
                                            wire:loading wire:target="photo" role="status">
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
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text"
                                    class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    wire:model="name" id="floatingInput" placeholder="Titulo">
                                <label for="floatingInput">Institucion</label>
                            </div>
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['name'];
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
                </div>
                <div class="col-md-8" x-data="{ social: <?php if ((object) ('social') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('social'->value()); ?>')<?php echo e('social'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('social'); ?>')<?php endif; ?> }">
                    <!-- Botón Agregar -->
                    <div class="d-flex justify-content-end mb-2">
                        <button type="button" @click="social.push({ type: '', url: '' })"
                            class="btn btn-sm btn-success d-flex align-items-center gap-1">
                            <i class="fas fa-plus-circle fs-6"></i> Agregar
                        </button>
                    </div>

                    <!-- Lista de sociales -->
                    <template x-for="(item, index) in social" :key="index">
                        <div class="row g-1 mb-2">
                            <div class="col-md-5">
                                <div class="form-floating mb-2">
                                    <select x-model="item.type" class="form-select">
                                        <option value="" disabled>Seleccione</option>
                                        <option value="facebook">Facebook</option>
                                        <option value="twitter">Twitter</option>
                                        <option value="instagram">Instagram</option>
                                        <option value="linkedin">LinkedIn</option>
                                        <option value="web">Sitio Web</option>
                                        <option value="whatsapp">WhatsApp</option>
                                    </select>
                                    <label>Plataforma digital</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" x-model="item.url" class="form-control" placeholder="URL">
                                    <label>URL o usuario</label>
                                </div>
                            </div>
                            <div class="col-md-1 d-flex align-items-center">
                                <button type="button" @click="social.splice(index, 1)"
                                    class="btn btn-sm btn-danger rounded-circle p-2 m-0">
                                    <i class="fas fa-trash-alt fs-6"></i>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>

                <div class="d-grid gap-1 d-md-flex justify-content-md-end">
                    <a href="<?php echo e(route('agreements')); ?>" wire:target="add,update,store"
                        wire:loading.class="disabled pointer-events-none opacity-50" class="btn btn-sm btn-danger m-0">
                        <i class="fas fa-ban fs-6"></i> Cancel</a>
                    <!--[if BLOCK]><![endif]--><?php if($this->id): ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('articles.edit')): ?>
                            <button wire:click.prevent="update()" wire:target="add,update,store,photo"
                                wire:loading.attr="disabled" class="btn btn-sm btn-info m-0"> <i
                                    class="fas fa-paste fs-6"></i>
                                Actualizar</button>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('articles.create')): ?>
                            <button class="btn btn-sm btn-dark m-0" wire:target="add,update,store,photo"
                                wire:loading.attr="disabled" wire:click.prevent="store()"> <i class="fas fa-save fs-6"></i>
                                Guardar</button>
                        <?php endif; ?>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>
        </form>
        <!--[if BLOCK]><![endif]--><?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                </ul>
            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
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
<?php /**PATH D:\ICAPV4\ICAP\resources\views/livewire/agreements/form-agreement.blade.php ENDPATH**/ ?>