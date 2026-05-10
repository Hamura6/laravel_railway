<aside class="app-sidebar" id="appSidebar">

    <a class="sidebar-header" href="{{ route('home') }}">
        <img alt="Logo Sistema" class="sidebar-logo" src="{{ $institution->image }}">
        <div class="sidebar-title">
            {{ $institution->initials }}
            <div class="slogan">{{ $institution->name }}</div>
        </div>
    </a>

    <nav class="sidebar-menu">
        @can('Acceso al panel administrativo')
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
        @if (auth()->user()->can('Ver usuarios') ||
                auth()->user()->can('Ver roles') ||
                auth()->user()->can('Asignación de permisos'))
            <div
                class="menu-item has-submenu toggle-submenu {{ Route::is(['users', 'roles', 'permissions']) ? 'active' : '' }}">
                <div class="menu-label">
                    <i class="fa fa-users"></i> Usuarios
                </div>
                <i class="fa fa-chevron-right arrow"></i>
            </div>
        @endif

        <div class="sidebar-submenu {{ Route::is(['users', 'roles', 'permissions']) ? 'show' : '' }}">
            @can('Ver usuarios')
                <a class="{{ Route::is('users') ? 'active' : '' }}" href="{{ route('users') }}" wire:navigate>
                    <i class="fa fa-list"></i> Gestión de usuarios
                </a>
            @endcan
            @can('Ver roles')
                <a class="{{ Route::is('roles') ? 'active' : '' }}" href="{{ route('roles') }}" wire:navigate>
                    <i class="fa fa-user-plus"></i> Gestión de roles
                </a>
            @endcan
            @can('Asignación de permisos')
                <a class="{{ Route::is('permissions') ? 'active' : '' }}" href="{{ route('permissions') }}" wire:navigate>
                    <i class="fa fa-user-shield"></i> Gestión de permisos
                </a>
            @endcan
        </div>

        @if (auth()->user()->can('Ver afiliados') ||
                auth()->user()->can('Ver licencias') ||
                auth()->user()->can('Ver directorio') ||
                auth()->user()->can('Ver fallecidos'))
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
            @can('Ver afiliados')
                <a class="{{ Route::is('view.affiliate') ? 'active' : '' }}" href="{{ route('view.affiliate') }}"
                    wire:navigate>
                    <i class="fa fa-list"></i> Afiliados
                </a>
            @endcan
            @can('Ver licencias')
                <a class="{{ Route::is('license.affiliate') ? 'active' : '' }}" href="{{ route('license.affiliate') }}"
                    wire:navigate>
                    <i class="fas fa-street-view"></i> Licencias
                </a>
            @endcan
            @can('Ver fallecidos')
                <a class="{{ Route::is('deceased.affiliate') ? 'active' : '' }}" href="{{ route('deceased.affiliate') }}"
                    wire:navigate>
                    <i class="fas fa-user-slash"></i> Fallecidos
                </a>
            @endcan
            @can('Ver directorio')
                <a class="{{ Route::is('directories.list') ? 'active' : '' }}" href="{{ route('directories.list') }}"
                    wire:navigate>
                    <i class="fas fa-list"></i> Directorio
                </a>
            @endcan
        </div>


        @if (auth()->user()->can('Ver universidades') || auth()->user()->can('Ver especialidades'))
            <div
                class="menu-item has-submenu toggle-submenu {{ Route::is(['universities', 'specialties']) ? 'active' : '' }}">
                <div class="menu-label">
                    <i class="fas fa-book"></i> Referencias Académicas
                </div>
                <i class="fa fa-chevron-right arrow"></i>
            </div>
        @endif
        <div class="sidebar-submenu {{ Route::is(['universities', 'specialties']) ? 'show' : '' }}">
            @can('Ver universidades')
                <a class=" {{ Route::is('universities') ? 'active' : '' }}" href="{{ route('universities') }}"
                    wire:navigate>
                    <i class="fas fa-university"></i> Universidades
                </a>
            @endcan
            @can('Ver especialidades')
                <a class=" {{ Route::is('specialties') ? 'active' : '' }}" href="{{ route('specialties') }}"
                    wire:navigate>
                    <i class="fas fa-microscope"></i> Especialidades
                </a>
            @endcan
        </div>


        @if (auth()->user()->can('Ver pagos') ||
                auth()->user()->can('Ver procedimientos') ||
                auth()->user()->can('Ver tarifas') ||
                auth()->user()->can('Ver descuentos'))
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
            @can('Ver pagos')
                <a class="{{ Route::is('finances.debts') ? 'active' : '' }}" href="{{ route('finances.debts') }}"
                    wire:navigate>
                    <i class="fas fa-file-invoice-dollar"></i> Gestión de Pagos
                </a>
            @endcan
            @can('Ver procedimientos')
                <a class="{{ Route::is('procedures') ? 'active' : '' }}" href="{{ route('procedures') }}" wire:navigate>
                    <i class="fas fa-calculator"></i> Gestión de Trámites
                </a>
            @endcan
            @can('Ver tarifas')
                <a class="{{ Route::is('fees') ? 'active' : '' }}" href="{{ route('fees') }}" wire:navigate>
                    <i class="fas fa-tags"></i> Costos de Trámites
                </a>
            @endcan
            @can('Ver descuentos')
                <a class="{{ Route::is('discounts') ? 'active' : '' }}" href="{{ route('discounts') }}" wire:navigate>
                    <i class="fas fa-percent"></i> Descuentos Aplicables
                </a>
            @endcan
        </div>

        @can('ver reconocimientos')
            <a class="menu-item {{ Route::is('recognitions') ? 'active' : '' }}" href="{{ route('recognitions') }}"
                wire:navigate>
                <div class="menu-label">
                    <i class="fas fa-award"></i> Méritos y Distinciones
                </div>
            </a>
        @endcan
        @can('Ver denuncias')
            <a class="menu-item {{ Route::is('demands') ? 'active' : '' }}" href="{{ route('demands') }}" wire:navigate>
                <div class="menu-label">
                    <i class="fas fa-list-alt"></i> Historial Disciplinario
                </div>
            </a>
        @endcan


        @if (auth()->user()->can('Ver noticias') ||
                auth()->user()->can('Ver cursos') ||
                auth()->user()->can('Ver artículos') ||
                auth()->user()->can('Ver directorio actual de la organización') ||
                auth()->user()->can('Ver eventos') ||
                auth()->user()->can('Ver convenios'))
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
            @can('Ver noticias')
                <a class="{{ Route::is('news') ? 'active' : '' }}" href="{{ route('news') }}" wire:navigate>
                    <i class="fas fa-bullhorn"></i> Comunicados / Noticias
                </a>
            @endcan
            @can('Ver cursos')
                <a class="{{ Route::is('courses') ? 'active' : '' }}" href="{{ route('courses') }}" wire:navigate>
                    <i class="fas fa-graduation-cap"></i> Oferta Académica
                </a>
            @endcan
            @can('Ver artículos')
                <a class="{{ Route::is('articles') ? 'active' : '' }}" href="{{ route('articles') }}" wire:navigate>
                    <i class="fas fa-pen-nib"></i> Colaboraciones Académicas
                </a>
            @endcan
            @can('Ver convenios')
                <a class="{{ Route::is('agreements') ? 'active' : '' }}" href="{{ route('agreements') }}" wire:navigate>
                    <i class="fas fa-handshake"></i> Convenios Institucionales
                </a>
            @endcan
            @can('Ver directorio actual de la organización')
                <a class="{{ Route::is('directories') ? 'active' : '' }}" href="{{ route('directories') }}"
                    wire:navigate>
                    <i class="fas fa-user-tie"></i> Directorio
                </a>
            @endcan
            @can('Ver eventos')
                <a class="{{ Route::is('events') ? 'active' : '' }}" href="{{ route('events') }}" wire:navigate>
                    <i class="fas fa-calendar-alt"></i> Eventos
                </a>
            @endcan
        </div>








        @if (auth()->user()->can('Ver reportes'))
            <div
                class="menu-item has-submenu toggle-submenu {{ Route::is(['report.affiliate', 'report.contribution']) ? 'active' : '' }}">
                <div class="menu-label">
                    <i class="fas fa-chart-line"></i> Reportes
                </div>
                <i class="fa fa-chevron-right arrow"></i>
            </div>
        @endif
        <div class="sidebar-submenu {{ Route::is(['report.affiliate', 'report.contribution']) ? 'show' : '' }}">

            <a class="{{ Route::is('report.affiliate') ? 'active' : '' }}" href="{{ route('report.affiliate') }}"
                wire:navigate>
                <i class="fas fa-user-check "></i> Afiliados
            </a>
            <a class="{{ Route::is('report.contribution') ? 'active' : '' }}"
                href="{{ route('report.contribution') }}" wire:navigate>
                <i class="fas fa-dollar-sign"></i> Aportes
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
        @can('Configuración de la institución')
            <a class="menu-item {{ Route::is('institution.configuration') ? 'active' : '' }}"
                href="{{ route('institution.configuration') }}">
                <div class="menu-label">
                    <i class="fas fa-cogs"></i> Configuración
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
