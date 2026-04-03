<header class="topbar">
    <div class="topbar-left text-dark">
        <i class="fa fa-bars btn-menu-mobile" id="sidebar-toggle"></i>
    </div>

    <div class="topbar-actions">

        

        <style>
            .hover-shadow {
                transition: box-shadow 0.25s ease, transform 0.15s ease;
            }

            .card {
                border-radius: 0.7rem !important;
                position: relative;
            }
        </style>
        <div class="topbar-action-dropdown" aria-expanded="false" aria-haspopup="true" aria-label="Mi Perfil"
            class="topbar-action-toggle" id="btnProfileToggle">
            <div class="card border  border-dark ">
                <div class="card-body p-0 px-1 pe-3">
                    <div class="d-flex align-items-center gap-1">
                        <!-- Imagen a la izquierda -->
                        <img src="<?php echo e(auth()->user()->image); ?>"
                            alt="Uchiha Madara" class="rounded-circle flex-shrink-0" width="30" height="30"
                            style="object-fit: cover;">

                        <!-- Texto a la derecha -->
                        <div class="d-flex flex-column gap-0 ">
                            <strong class="text-dark "><?php echo e(auth()->user()->getRoleNames()->first()); ?>:</strong>
                            <small class="text-primary mb-0"><?php echo e(auth()->user()->full_name); ?></small>
                        </div>
                    </div>
                </div>
            </div>
            <div aria-labelledby="btnProfileToggle" class="topbar-action-menu" id="menuProfileToggle" role="menu">

                <div class="topbar-action-menu-head">
                    Mi Cuenta
                </div>

                <a class="topbar-action-item" href="<?php echo e(route('settings.profile')); ?>" role="menuitem" wire:navigate>
                    <i class="fa fa-user"></i>
                    <span>Mi Perfil</span>
                </a>

                <a class="topbar-action-item topbar-action-logout" href="<?php echo e(route('logout')); ?>"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();" role="menuitem">
                    <i class="fa fa-sign-out-alt"></i>
                    <span><?php echo e(__('Logout')); ?></span>
                </a>

                <form action="<?php echo e(route('logout')); ?>" class="d-none" id="logout-form" method="POST">
                    <?php echo csrf_field(); ?>
                </form>

            </div>
        </div>


        
        
    </div>

</header>
<?php /**PATH D:\ICAPV4\ICAP\resources\views/pages/layouts/app/header.blade.php ENDPATH**/ ?>