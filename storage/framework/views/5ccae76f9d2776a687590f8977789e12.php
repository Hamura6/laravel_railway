    <div wire:ignore.self class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
        aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title text-dark " id="offcanvasRightLabel">Filtros de Busqueda</h5>
            <button type="button" class="btn-close text-dark" data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="fas fa-times"></i></button>
        </div>
        <div class="offcanvas-body">
            <div class="row g-3">
                <?php echo e($slot); ?>

                <div class="d-flex justify-content-between">
                    <u class="cursor-pointer fs-6 text-dark  font-weight-bolder" wire:click="refreshData()"> <i class="fas fa-sync"></i> Filtros de busquea</u>
                    <button class="btn btn-dark" wire:click="update()"> Buscar  <i class="fas fa-question "></i></button>
                </div>
            </div>
        </div>
    </div>
<?php /**PATH D:\ICAPV4\ICAP\resources\views/components/question-offcanvas.blade.php ENDPATH**/ ?>