<aside class="app-sidebar" id="appSidebar">

    <a class="sidebar-header" href="<?php echo e(route('home')); ?>">
        <img alt="Logo Sistema" class="sidebar-logo" src="<?php echo e($institution->image); ?>">
        <div class="sidebar-title">
            <?php echo e($institution->initials); ?>

            <div class="slogan"><?php echo e($institution->name); ?></div>
        </div>
    </a>

    <nav class="sidebar-menu">

        <a class="menu-item <?php echo e(Route::is('dashboard.index') ? '' : ''); ?>" href="<?php echo e(route('dashboard.index')); ?>">
            <div class="menu-label">
                <i class="fa fa-home"></i> Inicio
            </div>
        </a>

        <!-- Usuarios + Submenú -->
        <?php if(auth()->user()->can('user()s.view') ||
                auth()->user()->can('roles.view') ||
                auth()->user()->can('permissions.assign')): ?>
            <div
                class="menu-item has-submenu toggle-submenu <?php echo e(Route::is(['users', 'roles', 'permissions']) ? 'active' : ''); ?>">
                <div class="menu-label">
                    <i class="fa fa-users"></i> Usuarios
                </div>
                <i class="fa fa-chevron-right arrow"></i>
            </div>
        <?php endif; ?>

        <div class="sidebar-submenu <?php echo e(Route::is(['users', 'roles', 'permissions']) ? 'show' : ''); ?>">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users.view')): ?>
                <a class="<?php echo e(Route::is('users') ? 'active' : ''); ?>" href="<?php echo e(route('users')); ?>" wire:navigate>
                    <i class="fa fa-list"></i> Gestión de usuarios
                </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('roles.view')): ?>
                <a class="<?php echo e(Route::is('roles') ? 'active' : ''); ?>" href="<?php echo e(route('roles')); ?>" wire:navigate>
                    <i class="fa fa-user-plus"></i> Gestión de roles
                </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permissions.assign')): ?>
                <a class="<?php echo e(Route::is('permissions') ? 'active' : ''); ?>" href="<?php echo e(route('permissions')); ?>" wire:navigate>
                    <i class="fa fa-user-shield"></i> Gestión de permisos
                </a>
            <?php endif; ?>
        </div>


        <div
            class="menu-item has-submenu toggle-submenu <?php echo e(Route::is(['view.affiliate', 'license.affiliate', 'deceased.affiliate']) ? 'active' : ''); ?>">
            <div class="menu-label">
                <i class="fas fa-user-tie"></i> Gestión de Afiliados
            </div>
            <i class="fa fa-chevron-right arrow"></i>
        </div>

        <div
            class="sidebar-submenu <?php echo e(Route::is(['view.affiliate', 'license.affiliate', 'deceased.affiliate', 'directories.list']) ? 'show' : ''); ?>">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('affiliates.view')): ?>
                <a class="<?php echo e(Route::is('view.affiliate') ? 'active' : ''); ?>" href="<?php echo e(route('view.affiliate')); ?>"
                    wire:navigate>
                    <i class="fa fa-list"></i> Afiliados
                </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('licenses.view')): ?>
                <a class="<?php echo e(Route::is('license.affiliate') ? 'active' : ''); ?>" href="<?php echo e(route('license.affiliate')); ?>"
                    wire:navigate>
                    <i class="fas fa-street-view"></i> Licencias
                </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('deceaseds.view')): ?>
                <a class="<?php echo e(Route::is('deceased.affiliate') ? 'active' : ''); ?>" href="<?php echo e(route('deceased.affiliate')); ?>"
                    wire:navigate>
                    <i class="fas fa-user-slash"></i> Fallecidos
                </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('directories.view')): ?>
                <a class="<?php echo e(Route::is('directories.list') ? 'active' : ''); ?>" href="<?php echo e(route('directories.list')); ?>"
                    wire:navigate>
                    <i class="fas fa-list"></i> Directorio
                </a>
            <?php endif; ?>
        </div>


        <div
            class="menu-item has-submenu toggle-submenu <?php echo e(Route::is(['universities', 'specialties']) ? 'active' : ''); ?>">
            <div class="menu-label">
                <i class="fas fa-book"></i> Referencias Académicas
            </div>
            <i class="fa fa-chevron-right arrow"></i>
        </div>

        <div class="sidebar-submenu <?php echo e(Route::is(['universities', 'specialties']) ? 'show' : ''); ?>">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('universities.view')): ?>
                <a class=" <?php echo e(Route::is('universities') ? 'active' : ''); ?>" href="<?php echo e(route('universities')); ?>"
                    wire:navigate>
                    <i class="fas fa-university"></i> Universidades
                </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('specialties.view')): ?>
                <a class=" <?php echo e(Route::is('specialties') ? 'active' : ''); ?>" href="<?php echo e(route('specialties')); ?>"
                    wire:navigate>
                    <i class="fas fa-microscope"></i> Especialidades
                </a>
            <?php endif; ?>
        </div>



        <div
            class="menu-item has-submenu toggle-submenu <?php echo e(Route::is(['finances.debts', 'procedures', 'fees', 'discounts']) ? 'active' : ''); ?>">
            <div class="menu-label">
                <i class="fas fa-folder-open"></i> Gestión Económica de Trámites
            </div>
            <i class="fa fa-chevron-right arrow"></i>
        </div>

        <div class="sidebar-submenu <?php echo e(Route::is(['finances.debts', 'procedures', 'fees', 'discounts']) ? 'show' : ''); ?>">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('payments.view')): ?>
                <a class="<?php echo e(Route::is('finances.debts') ? 'active' : ''); ?>" href="<?php echo e(route('finances.debts')); ?>"
                    wire:navigate>
                    <i class="fas fa-file-invoice-dollar"></i> Gestión de Pagos
                </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('procedures.view')): ?>
                <a class="<?php echo e(Route::is('procedures') ? 'active' : ''); ?>" href="<?php echo e(route('procedures')); ?>" wire:navigate>
                    <i class="fas fa-calculator"></i> Gestión de Trámites
                </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('fees.view')): ?>
                <a class="<?php echo e(Route::is('fees') ? 'active' : ''); ?>" href="<?php echo e(route('fees')); ?>" wire:navigate>
                    <i class="fas fa-tags"></i> Costos de Trámites
                </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('discount.view')): ?>
                <a class="<?php echo e(Route::is('discounts') ? 'active' : ''); ?>" href="<?php echo e(route('discounts')); ?>" wire:navigate>
                    <i class="fas fa-percent"></i> Descuentos Aplicables
                </a>
            <?php endif; ?>
        </div>
        <a class="menu-item <?php echo e(Route::is('recognitions') ? 'active' : ''); ?>" href="<?php echo e(route('recognitions')); ?>"
            wire:navigate>
            <div class="menu-label">
                <i class="fas fa-award"></i> Méritos y Distinciones
            </div>
        </a>
        <a class="menu-item <?php echo e(Route::is('demands') ? 'active' : ''); ?>" href="<?php echo e(route('demands')); ?>" wire:navigate>
            <div class="menu-label">
                <i class="fas fa-list-alt"></i> Historial Disciplinario
            </div>
        </a>



        <div
            class="menu-item has-submenu toggle-submenu <?php echo e(Route::is(['news', 'courses', 'articles', 'agreements', 'directories', 'events']) ? 'active' : ''); ?>">
            <div class="menu-label">
                <i class="fas fa-globe"></i> Gestión de Contenido Web
            </div>
            <i class="fa fa-chevron-right arrow"></i>
        </div>

        <div
            class="sidebar-submenu <?php echo e(Route::is(['news', 'courses', 'articles', 'agreements', 'directories', 'events']) ? 'show' : ''); ?>">
            <a class="<?php echo e(Route::is('news') ? 'active' : ''); ?>" href="<?php echo e(route('news')); ?>" wire:navigate>
                <i class="fas fa-bullhorn"></i> Comunicados / Noticias
            </a>
            <a class="<?php echo e(Route::is('courses') ? 'active' : ''); ?>" href="<?php echo e(route('courses')); ?>" wire:navigate>
                <i class="fas fa-graduation-cap"></i> Oferta Académica
            </a>
            <a class="<?php echo e(Route::is('articles') ? 'active' : ''); ?>" href="<?php echo e(route('articles')); ?>" wire:navigate>
                <i class="fas fa-pen-nib"></i> Colaboraciones Académicas
            </a>
            <a class="<?php echo e(Route::is('agreements') ? 'active' : ''); ?>" href="<?php echo e(route('agreements')); ?>" wire:navigate>
                <i class="fas fa-handshake"></i> Convenios Institucionales
            </a>
            <a class="<?php echo e(Route::is('directories') ? 'active' : ''); ?>" href="<?php echo e(route('directories')); ?>" wire:navigate>
                <i class="fas fa-user-tie"></i> Directorio
            </a>
            <a class="<?php echo e(Route::is('events') ? 'active' : ''); ?>" href="<?php echo e(route('events')); ?>" wire:navigate>
                <i class="fas fa-calendar-alt"></i> Eventos
            </a>
        </div>














        <a class="menu-item <?php echo e(Route::is('report.affiliate') ? 'active' : ''); ?>"
            href="<?php echo e(route('report.affiliate')); ?>" wire:navigate>
            <div class="menu-label">
                <i class="fa fa-home"></i> Reportes
            </div>
        </a>
        <a class="menu-item <?php echo e(Route::is('report.contribution') ? 'active' : ''); ?>"
            href="<?php echo e(route('report.contribution')); ?>" wire:navigate>
            <div class="menu-label">
                <i class="fa fa-home"></i> Reporte de aportes
            </div>
        </a>












        

        <a class="menu-item <?php echo e(Route::is('institution.configuration') ? 'active' : ''); ?>"
            href="<?php echo e(route('institution.configuration')); ?>">
            <div class="menu-label">
                <i class="fas fa-chart-bar"></i> Configuración
            </div>
        </a>
        
    </nav>

</aside>
<?php /**PATH D:\ICAPV4\ICAP\resources\views/pages/layouts/app/sidebar.blade.php ENDPATH**/ ?>