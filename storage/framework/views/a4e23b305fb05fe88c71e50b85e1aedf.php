<div class="card border-2 shadow-sm rounded-3 overflow-hidden border-dark">
    <div class="table-responsive p-0">
        <table
            class="table table-light justify-content-center mb-0 table-bordered ">
            <!--[if BLOCK]><![endif]--><?php if(isset($header)): ?>
                <thead align="center" class="table-dark font-weight-semibold">
                    <tr>
                        <?php echo e($header); ?>

                    </tr>
                </thead>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

            <tbody class="table-group-divider" wire:loading.remove wire:target="search">
                <?php echo e($slot); ?>

            </tbody>
        </table>
    </div>
</div>
<div class="text-center py-4 color-dark justify-content-center w-100" wire:loading wire:target="search">
    <div class="spinner-border " style="width: 4rem; height: 4rem;" role="status">
        <span class="visually-hidden ">Loading...</span>
    </div>
</div>
<?php /**PATH D:\ICAPV4\ICAP\resources\views/components/table-registers.blade.php ENDPATH**/ ?>