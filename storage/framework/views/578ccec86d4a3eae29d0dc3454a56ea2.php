<div class="form-group position-relative">

    <label class="form-control-label">Seleccione a un afiliado</label>

    <input type="text" class="form-control <?php $__errorArgs = ['value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Buscar afiliado..."
        wire:model.live="searchTerm" wire:focus="showDropdown" wire:blur="hideDropdown">

    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="text-danger"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

    <!--[if BLOCK]><![endif]--><?php if($showList && !empty($filteredAffiliates)): ?>
        <ul class="list-group mt-1 position-absolute w-100 p-0 overflow-scroll"
            style="max-height: 225px;  z-index: 1050;">

            <!-- 🔁 Resultados -->
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $filteredAffiliates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $affiliate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item list-group-item-action" style="cursor: pointer"
                    wire:click="selectUniversity(<?php echo e($affiliate->id); ?>)">
                    <?php echo e($affiliate->user->full_name); ?>

                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        </ul>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</div>
<?php /**PATH D:\ICAPV4\ICAP\resources\views/livewire/affiliate-selected.blade.php ENDPATH**/ ?>