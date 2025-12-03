<aside class="app-sidebar" id="appSidebar">

    <a class="sidebar-header" href="{{ route('home') }}">
        <img alt="Logo Sistema" class="sidebar-logo" src="{{ $institution->image }}">
        <div class="sidebar-title">
            {{ $institution->initials }}
            <div class="slogan">{{ $institution->name }}</div>
        </div>
    </a>

    <nav class="sidebar-menu">
        @can('manager')
            <a class="menu-item {{ Route::is('dashboard.index') ? '' : '' }}" href="{{ route('dashboard.index') }}">
                <div class="menu-label">
                    <i class="fa fa-home"></i> Inicio
                </div>
            </a>
        @endcan
        @role('Afiliado')
            <a class="menu-item {{ Route::is('affiliate.statement.account') ? 'active' : '' }}"
                href="{{ route('affiliate.statement.account') }}">
                <div class="menu-label">
                    <i class="fa fa-home"></i> Saldo
                </div>
            </a>
        @endrole

        <!-- Usuarios + Submenú -->
        @if (auth()->user()->can('users.view') || auth()->user()->can('roles.view') || auth()->user()->can('permissions.assign'))
            <div
                class="menu-item has-submenu toggle-submenu {{ Route::is(['users', 'roles', 'permissions']) ? 'active' : '' }}">
                <div class="menu-label">
                    <i class="fa fa-users"></i> Usuarios
                </div>
                <i class="fa fa-chevron-right arrow"></i>
            </div>
        @endif

        <div class="sidebar-submenu {{ Route::is(['users', 'roles', 'permissions']) ? 'show' : '' }}">
            @can('users.view')
                <a class="{{ Route::is('users') ? 'active' : '' }}" href="{{ route('users') }}" wire:navigate>
                    <i class="fa fa-list"></i> Gestión de usuarios
                </a>
            @endcan
            @can('roles.view')
                <a class="{{ Route::is('roles') ? 'active' : '' }}" href="{{ route('roles') }}" wire:navigate>
                    <i class="fa fa-user-plus"></i> Gestión de roles
                </a>
            @endcan
            @can('permissions.assign')
                <a class="{{ Route::is('permissions') ? 'active' : '' }}" href="{{ route('permissions') }}" wire:navigate>
                    <i class="fa fa-user-shield"></i> Gestión de permisos
                </a>
            @endcan
        </div>

        @if (auth()->user()->can('affiliates.view') ||
                auth()->user()->can('licenses.view') ||
                auth()->user()->can('directories.view') ||
                auth()->user()->can('deceaseds.view'))
            <div
                class="menu-item has-submenu toggle-submenu {{ Route::is(['view.affiliate', 'license.affiliate', 'deceased.affiliate', 'directories.list']) ? 'active' : '' }}">
                <div class="menu-label">
                    <i class="fas fa-user-tie"></i> Gestión de Afiliados
                </div>
                <i class="fa fa-chevron-right arrow"></i>
            </div>
        @endif
        <div
            class="sidebar-submenu {{ Route::is(['view.affiliate', 'license.affiliate', 'deceased.affiliate', 'directories.list']) ? 'show' : '' }}">
            @can('affiliates.view')
                <a class="{{ Route::is('view.affiliate') ? 'active' : '' }}" href="{{ route('view.affiliate') }}"
                    wire:navigate>
                    <i class="fa fa-list"></i> Afiliados
                </a>
            @endcan
            @can('licenses.view')
                <a class="{{ Route::is('license.affiliate') ? 'active' : '' }}" href="{{ route('license.affiliate') }}"
                    wire:navigate>
                    <i class="fas fa-street-view"></i> Licencias
                </a>
            @endcan
            @can('deceaseds.view')
                <a class="{{ Route::is('deceased.affiliate') ? 'active' : '' }}" href="{{ route('deceased.affiliate') }}"
                    wire:navigate>
                    <i class="fas fa-user-slash"></i> Fallecidos
                </a>
            @endcan
            @can('directories.view')
                <a class="{{ Route::is('directories.list') ? 'active' : '' }}" href="{{ route('directories.list') }}"
                    wire:navigate>
                    <i class="fas fa-list"></i> Directorio
                </a>
            @endcan
        </div>


        @if (auth()->user()->can('universities.view') || auth()->user()->can('specialties.view'))
            <div
                class="menu-item has-submenu toggle-submenu {{ Route::is(['universities', 'specialties']) ? 'active' : '' }}">
                <div class="menu-label">
                    <i class="fas fa-book"></i> Referencias Académicas
                </div>
                <i class="fa fa-chevron-right arrow"></i>
            </div>
        @endif
        <div class="sidebar-submenu {{ Route::is(['universities', 'specialties']) ? 'show' : '' }}">
            @can('universities.view')
                <a class=" {{ Route::is('universities') ? 'active' : '' }}" href="{{ route('universities') }}"
                    wire:navigate>
                    <i class="fas fa-university"></i> Universidades
                </a>
            @endcan
            @can('specialties.view')
                <a class=" {{ Route::is('specialties') ? 'active' : '' }}" href="{{ route('specialties') }}"
                    wire:navigate>
                    <i class="fas fa-microscope"></i> Especialidades
                </a>
            @endcan
        </div>


        @if (auth()->user()->can('payments.view') ||
                auth()->user()->can('procedures.view') ||
                auth()->user()->can('fees.view') ||
                auth()->user()->can('discount.view'))
            <div
                class="menu-item has-submenu toggle-submenu {{ Route::is(['finances.debts', 'procedures', 'fees', 'discounts']) ? 'active' : '' }}">
                <div class="menu-label">
                    <i class="fas fa-folder-open"></i> Gestión Económica de Trámites
                </div>
                <i class="fa fa-chevron-right arrow"></i>
            </div>
        @endif
        <div
            class="sidebar-submenu {{ Route::is(['finances.debts', 'procedures', 'fees', 'discounts']) ? 'show' : '' }}">
            @can('payments.view')
                <a class="{{ Route::is('finances.debts') ? 'active' : '' }}" href="{{ route('finances.debts') }}"
                    wire:navigate>
                    <i class="fas fa-file-invoice-dollar"></i> Gestión de Pagos
                </a>
            @endcan
            @can('procedures.view')
                <a class="{{ Route::is('procedures') ? 'active' : '' }}" href="{{ route('procedures') }}" wire:navigate>
                    <i class="fas fa-calculator"></i> Gestión de Trámites
                </a>
            @endcan
            @can('fees.view')
                <a class="{{ Route::is('fees') ? 'active' : '' }}" href="{{ route('fees') }}" wire:navigate>
                    <i class="fas fa-tags"></i> Costos de Trámites
                </a>
            @endcan
            @can('discount.view')
                <a class="{{ Route::is('discounts') ? 'active' : '' }}" href="{{ route('discounts') }}" wire:navigate>
                    <i class="fas fa-percent"></i> Descuentos Aplicables
                </a>
            @endcan
        </div>

        @can('recognitions.view')
            <a class="menu-item {{ Route::is('recognitions') ? 'active' : '' }}" href="{{ route('recognitions') }}"
                wire:navigate>
                <div class="menu-label">
                    <i class="fas fa-award"></i> Méritos y Distinciones
                </div>
            </a>
        @endcan
        @can('demands.view')
            <a class="menu-item {{ Route::is('demands') ? 'active' : '' }}" href="{{ route('demands') }}" wire:navigate>
                <div class="menu-label">
                    <i class="fas fa-list-alt"></i> Historial Disciplinario
                </div>
            </a>
        @endcan


        @if (auth()->user()->can('notice.view') ||
                auth()->user()->can('courses.view') ||
                auth()->user()->can('articles.view') ||
                auth()->user()->can('directories.view.organization') ||
                auth()->user()->can('events.view') ||
                auth()->user()->can('agreements.view'))
            <div
                class="menu-item has-submenu toggle-submenu {{ Route::is(['news', 'courses', 'articles', 'agreements', 'directories', 'events']) ? 'active' : '' }}">
                <div class="menu-label">
                    <i class="fas fa-globe"></i> Gestión de Contenido Web
                </div>
                <i class="fa fa-chevron-right arrow"></i>
            </div>
        @endif
        <div
            class="sidebar-submenu {{ Route::is(['news', 'courses', 'articles', 'agreements', 'directories', 'events']) ? 'show' : '' }}">
            <a class="{{ Route::is('news') ? 'active' : '' }}" href="{{ route('news') }}" wire:navigate>
                <i class="fas fa-bullhorn"></i> Comunicados / Noticias
            </a>
            <a class="{{ Route::is('courses') ? 'active' : '' }}" href="{{ route('courses') }}" wire:navigate>
                <i class="fas fa-graduation-cap"></i> Oferta Académica
            </a>
            <a class="{{ Route::is('articles') ? 'active' : '' }}" href="{{ route('articles') }}" wire:navigate>
                <i class="fas fa-pen-nib"></i> Colaboraciones Académicas
            </a>
            <a class="{{ Route::is('agreements') ? 'active' : '' }}" href="{{ route('agreements') }}" wire:navigate>
                <i class="fas fa-handshake"></i> Convenios Institucionales
            </a>
            <a class="{{ Route::is('directories') ? 'active' : '' }}" href="{{ route('directories') }}"
                wire:navigate>
                <i class="fas fa-user-tie"></i> Directorio
            </a>
            <a class="{{ Route::is('events') ? 'active' : '' }}" href="{{ route('events') }}" wire:navigate>
                <i class="fas fa-calendar-alt"></i> Eventos
            </a>
        </div>








        @if (auth()->user()->can('reports'))
            <div
                class="menu-item has-submenu toggle-submenu {{ Route::is(['report.affiliate', 'report.contribution']) ? 'active' : '' }}">
                <div class="menu-label">
                    <i class="fas fa-globe"></i> Reportes
                </div>
                <i class="fa fa-chevron-right arrow"></i>
            </div>
        @endif
        <div class="sidebar-submenu {{ Route::is(['report.affiliate', 'report.contribution']) ? 'show' : '' }}">

            <a class="{{ Route::is('report.affiliate') ? 'active' : '' }}" href="{{ route('report.affiliate') }}"
                wire:navigate>
                <i class="fas fa-calendar-alt"></i> Afiliados
            </a>
            <a class="{{ Route::is('report.contribution') ? 'active' : '' }}"
                href="{{ route('report.contribution') }}" wire:navigate>
                <i class="fas fa-calendar-alt"></i> Aportes
            </a>
        </div>




        {{--      <a class="menu-item {{ Route::is('report.affiliate') ? 'active' : '' }}"
            href="{{ route('report.affiliate') }}" wire:navigate>
            <div class="menu-label">
                <i class="fa fa-home"></i> Reportes
            </div>
        </a>
        <a class="menu-item {{ Route::is('report.contribution') ? 'active' : '' }}"
            href="{{ route('report.contribution') }}" wire:navigate>
            <div class="menu-label">
                <i class="fa fa-home"></i> Reporte de aportes
            </div>
        </a> --}}












        {{-- 
        <div class="menu-item has-submenu toggle-submenu">
            <div class="menu-label">
                <i class="fa fa-box"></i> Productos
            </div>
            <i class="fa fa-chevron-right arrow"></i>
        </div>
        <div class="sidebar-submenu">
            <a href="#"><i class="fa fa-th-list"></i> Catálogo</a>
            <a href="#"><i class="fa fa-plus"></i> Agregar Producto</a>
            <a href="#"><i class="fa fa-tags"></i> Categorías</a>
            <a href="#"><i class="fa fa-warehouse"></i> Inventario</a>
        </div>

        <div class="menu-item has-submenu open toggle-submenu">
            <div class="menu-label">
                <i class="fa fa-chart-bar"></i> Reportes
            </div>
            <i class="fa fa-chevron-right arrow"></i>
        </div>
        <div class="sidebar-submenu">
            <a href="#"><i class="fa fa-chart-line"></i> Ventas Mensuales</a>
            <a href="#"><i class="fa fa-dollar-sign"></i> Ingresos</a>
            <a href="#"><i class="fa fa-users-cog"></i> Actividad de Usuarios</a>
        </div> --}}
        @can('configuration')
            <a class="menu-item {{ Route::is('institution.configuration') ? 'active' : '' }}"
                href="{{ route('institution.configuration') }}">
                <div class="menu-label">
                    <i class="fas fa-chart-bar"></i> Configuración
                </div>
            </a>
        @endcan
        {{--  <a class="menu-item" href="#">
            <div class="menu-label">
                <i class="fa fa-sign-out-alt"></i> Salir
            </div>
        </a> --}}
    </nav>

</aside>
