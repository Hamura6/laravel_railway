<aside class="app-sidebar" id="appSidebar">

    <a class="sidebar-header" href="<?php echo e(route('home')); ?>">
        <img alt="Logo Sistema" class="sidebar-logo" src="<?php echo e($institution->image); ?>">
        <div class="sidebar-title">
            <?php echo e($institution->initials); ?>

            <div class="slogan"><?php echo e($institution->name); ?></div>
        </div>
    </a>

    <nav class="sidebar-menu">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Acceso al panel administrativo')): ?>
            <a class="menu-item <?php echo e(Route::is('dashboard.index') ? '' : ''); ?>" href="<?php echo e(route('dashboard.index')); ?>">
                <div class="menu-label">
                    <i class="fa fa-home"></i> Inicio
                </div>
            </a>
        <?php endif; ?>
        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Afiliado')): ?>
            <a class="menu-item <?php echo e(Route::is('affiliate.statement.account') ? 'active' : ''); ?>"
                href="<?php echo e(route('affiliate.statement.account')); ?>">
                <div class="menu-label">
                    <i class="fa fa-home"></i> Saldo
                </div>
            </a>
        <?php endif; ?>

        <!-- Usuarios + Submenú -->
        <?php if(auth()->user()->can('Ver usuarios') || auth()->user()->can('Ver roles') || auth()->user()->can('Asignación de permisos')): ?>
            <div
                class="menu-item has-submenu toggle-submenu <?php echo e(Route::is(['users', 'roles', 'permissions']) ? 'active' : ''); ?>">
                <div class="menu-label">
                    <i class="fa fa-users"></i> Usuarios
                </div>
                <i class="fa fa-chevron-right arrow"></i>
            </div>
        <?php endif; ?>

        <div class="sidebar-submenu <?php echo e(Route::is(['users', 'roles', 'permissions']) ? 'show' : ''); ?>">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Ver usuarios')): ?>
                <a class="<?php echo e(Route::is('users') ? 'active' : ''); ?>" href="<?php echo e(route('users')); ?>" wire:navigate>
                    <i class="fa fa-list"></i> Gestión de usuarios
                </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Ver roles')): ?>
                <a class="<?php echo e(Route::is('roles') ? 'active' : ''); ?>" href="<?php echo e(route('roles')); ?>" wire:navigate>
                    <i class="fa fa-user-plus"></i> Gestión de roles
                </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Asignación de permisos')): ?>
                <a class="<?php echo e(Route::is('permissions') ? 'active' : ''); ?>" href="<?php echo e(route('permissions')); ?>" wire:navigate>
                    <i class="fa fa-user-shield"></i> Gestión de permisos
                </a>
            <?php endif; ?>
        </div>

        <?php if(auth()->user()->can('Ver afiliados') ||
                auth()->user()->can('Ver licencias') ||
                auth()->user()->can('Ver directorio') ||
                auth()->user()->can('Ver fallecidos')): ?>
            <div
                class="menu-item has-submenu toggle-submenu <?php echo e(Route::is(['view.affiliate', 'license.affiliate', 'deceased.affiliate', 'directories.list']) ? 'active' : ''); ?>">
                <div class="menu-label">
                    <i class="fas fa-user-tie"></i> Gestión de Afiliados
                </div>
                <i class="fa fa-chevron-right arrow"></i>
            </div>
        <?php endif; ?>
        <div
            class="sidebar-submenu <?php echo e(Route::is(['view.affiliate', 'license.affiliate', 'deceased.affiliate', 'directories.list']) ? 'show' : ''); ?>">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Ver afiliados')): ?>
                <a class="<?php echo e(Route::is('view.affiliate') ? 'active' : ''); ?>" href="<?php echo e(route('view.affiliate')); ?>"
                    wire:navigate>
                    <i class="fa fa-list"></i> Afiliados
                </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Ver licencias')): ?>
                <a class="<?php echo e(Route::is('license.affiliate') ? 'active' : ''); ?>" href="<?php echo e(route('license.affiliate')); ?>"
                    wire:navigate>
                    <i class="fas fa-street-view"></i> Licencias
                </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Ver fallecidos')): ?>
                <a class="<?php echo e(Route::is('deceased.affiliate') ? 'active' : ''); ?>" href="<?php echo e(route('deceased.affiliate')); ?>"
                    wire:navigate>
                    <i class="fas fa-user-slash"></i> Fallecidos
                </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Ver directorio')): ?>
                <a class="<?php echo e(Route::is('directories.list') ? 'active' : ''); ?>" href="<?php echo e(route('directories.list')); ?>"
                    wire:navigate>
                    <i class="fas fa-list"></i> Directorio
                </a>
            <?php endif; ?>
        </div>


        <?php if(auth()->user()->can('Ver universidades') || auth()->user()->can('Ver especialidades')): ?>
            <div
                class="menu-item has-submenu toggle-submenu <?php echo e(Route::is(['universities', 'specialties']) ? 'active' : ''); ?>">
                <div class="menu-label">
                    <i class="fas fa-book"></i> Referencias Académicas
                </div>
                <i class="fa fa-chevron-right arrow"></i>
            </div>
        <?php endif; ?>
        <div class="sidebar-submenu <?php echo e(Route::is(['universities', 'specialties']) ? 'show' : ''); ?>">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Ver universidades')): ?>
                <a class=" <?php echo e(Route::is('universities') ? 'active' : ''); ?>" href="<?php echo e(route('universities')); ?>"
                    wire:navigate>
                    <i class="fas fa-university"></i> Universidades
                </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Ver especialidades')): ?>
                <a class=" <?php echo e(Route::is('specialties') ? 'active' : ''); ?>" href="<?php echo e(route('specialties')); ?>"
                    wire:navigate>
                    <i class="fas fa-microscope"></i> Especialidades
                </a>
            <?php endif; ?>
        </div>


        <?php if(auth()->user()->can('Ver pagos') ||
                auth()->user()->can('Ver procedimientos') ||
                auth()->user()->can('Ver tarifas') ||
                auth()->user()->can('Ver descuentos')): ?>
            <div
                class="menu-item has-submenu toggle-submenu <?php echo e(Route::is(['finances.debts', 'procedures', 'fees', 'discounts']) ? 'active' : ''); ?>">
                <div class="menu-label">
                    <i class="fas fa-folder-open"></i> Gestión Económica de Trámites
                </div>
                <i class="fa fa-chevron-right arrow"></i>
            </div>
        <?php endif; ?>
        <div
            class="sidebar-submenu <?php echo e(Route::is(['finances.debts', 'procedures', 'fees', 'discounts']) ? 'show' : ''); ?>">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Ver pagos')): ?>
                <a class="<?php echo e(Route::is('finances.debts') ? 'active' : ''); ?>" href="<?php echo e(route('finances.debts')); ?>"
                    wire:navigate>
                    <i class="fas fa-file-invoice-dollar"></i> Gestión de Pagos
                </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Ver procedimientos')): ?>
                <a class="<?php echo e(Route::is('procedures') ? 'active' : ''); ?>" href="<?php echo e(route('procedures')); ?>" wire:navigate>
                    <i class="fas fa-calculator"></i> Gestión de Trámites
                </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Ver tarifas')): ?>
                <a class="<?php echo e(Route::is('fees') ? 'active' : ''); ?>" href="<?php echo e(route('fees')); ?>" wire:navigate>
                    <i class="fas fa-tags"></i> Costos de Trámites
                </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Ver descuentos')): ?>
                <a class="<?php echo e(Route::is('discounts') ? 'active' : ''); ?>" href="<?php echo e(route('discounts')); ?>" wire:navigate>
                    <i class="fas fa-percent"></i> Descuentos Aplicables
                </a>
            <?php endif; ?>
        </div>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ver reconocimientos')): ?>
            <a class="menu-item <?php echo e(Route::is('recognitions') ? 'active' : ''); ?>" href="<?php echo e(route('recognitions')); ?>"
                wire:navigate>
                <div class="menu-label">
                    <i class="fas fa-award"></i> Méritos y Distinciones
                </div>
            </a>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Ver denuncias')): ?>
            <a class="menu-item <?php echo e(Route::is('demands') ? 'active' : ''); ?>" href="<?php echo e(route('demands')); ?>" wire:navigate>
                <div class="menu-label">
                    <i class="fas fa-list-alt"></i> Historial Disciplinario
                </div>
            </a>
        <?php endif; ?>


        <?php if(auth()->user()->can('Ver noticias') ||
                auth()->user()->can('Ver cursos') ||
                auth()->user()->can('Ver artículos') ||
                auth()->user()->can('Ver directorio actual de la organización') ||
                auth()->user()->can('Ver eventos') ||
                auth()->user()->can('Ver convenios')): ?>
            <div
                class="menu-item has-submenu toggle-submenu <?php echo e(Route::is(['news', 'courses', 'articles', 'agreements', 'directories', 'events']) ? 'active' : ''); ?>">
                <div class="menu-label">
                    <i class="fas fa-globe"></i> Gestión de Contenido Web
                </div>
                <i class="fa fa-chevron-right arrow"></i>
            </div>
        <?php endif; ?>
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
            <a class="<?php echo e(Route::is('directories') ? 'active' : ''); ?>" href="<?php echo e(route('directories')); ?>"
                wire:navigate>
                <i class="fas fa-user-tie"></i> Directorio
            </a>
            <a class="<?php echo e(Route::is('events') ? 'active' : ''); ?>" href="<?php echo e(route('events')); ?>" wire:navigate>
                <i class="fas fa-calendar-alt"></i> Eventos
            </a>
        </div>








        <?php if(auth()->user()->can('Ver reportes')): ?>
            <div
                class="menu-item has-submenu toggle-submenu <?php echo e(Route::is(['report.affiliate', 'report.contribution']) ? 'active' : ''); ?>">
                <div class="menu-label">
                    <i class="fas fa-chart-line"></i> Reportes
                </div>
                <i class="fa fa-chevron-right arrow"></i>
            </div>
        <?php endif; ?>
        <div class="sidebar-submenu <?php echo e(Route::is(['report.affiliate', 'report.contribution']) ? 'show' : ''); ?>">

            <a class="<?php echo e(Route::is('report.affiliate') ? 'active' : ''); ?>" href="<?php echo e(route('report.affiliate')); ?>"
                wire:navigate>
                <i class="fas fa-user-check "></i> Afiliados
            </a>
            <a class="<?php echo e(Route::is('report.contribution') ? 'active' : ''); ?>"
                href="<?php echo e(route('report.contribution')); ?>" wire:navigate>
                <i class="fas fa-dollar-sign"></i> Aportes
            </a>
        </div>




        












        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Configuración de la institución')): ?>
            <a class="menu-item <?php echo e(Route::is('institution.configuration') ? 'active' : ''); ?>"
                href="<?php echo e(route('institution.configuration')); ?>">
                <div class="menu-label">
                    <i class="fas fa-chart-bar"></i> Configuración
                </div>
            </a>
        <?php endif; ?>
        
    </nav>

</aside>
<?php /**PATH /var/www/icapProject/resources/views/pages/layouts/app/sidebar.blade.php ENDPATH**/ ?>