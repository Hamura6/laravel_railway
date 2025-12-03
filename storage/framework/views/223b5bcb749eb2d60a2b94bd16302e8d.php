<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => 'rol',
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'title' => 'rol',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<div wire:ignore.self class="modal fade" id="myModal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center py-2">
                <h5 class="modal-title font-weight-bolder mb-0 text-dark" id="exampleModalLabel">
                    <?php echo e($this->form->id ?? $this->id ? 'Actualizar' : 'Registrar'); ?> | <?php echo e($title); ?>

                </h5>
                <div class="spinner-border ms-auto" wire:loading role="status" style="width: 1.5rem; height: 1.5rem;">
                    <span class="visually-hidden">Cargando...</span>
                </div>
            </div>
            <div class="modal-body">
                <form action="">

                    <div class="row g-1">
                        <?php echo e($slot); ?>


                    </div>
                </form>
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-secondary" wire:loading.attr="disabled" wire:click="clear()"
                    data-bs-dismiss="modal"> <span wire:loading.remove>
                        <i class='fas fa-ban fs-6'></i>
                    </span>
                    <span wire:loading>
                        <i class="fas fa-spinner fa-spin"></i>
                    </span> Cancelar</button>
                <!--[if BLOCK]><![endif]--><?php if($this->form->id ?? $this->id): ?>
                    <button type="button" wire:loading.attr="disabled" class="btn btn-primary" wire:click="update()">
                        <span wire:loading.remove>
                            <i class="fas fa-paste fs-6"></i>
                        </span>
                        <span wire:loading>
                            <i class="fas fa-spinner fa-spin"></i>
                        </span> Actualizar</button>
                <?php else: ?>
                    <button type="button" wire:loading.attr="disabled" class="btn btn-dark" wire:click="store()">
                        <span wire:loading.remove>
                            <i class="fas fa-save fs-6"></i>
                        </span>
                        <span wire:loading>
                            <i class="fas fa-spinner fa-spin"></i>
                        </span> Guardar</button>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>
    </div>
</div>
<?php /**PATH D:\ICAPV4\ICAP\resources\views/components/modal.blade.php ENDPATH**/ ?>