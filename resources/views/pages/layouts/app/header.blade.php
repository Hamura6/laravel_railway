<header class="topbar">
    <div class="topbar-left text-dark">
        <i class="fa fa-bars btn-menu-mobile" id="sidebar-toggle"></i>
    </div>

    <div class="topbar-actions">

        {{-- <div class="topbar-action-dropdown">
            <button aria-expanded="false" aria-haspopup="true" aria-label="Notificaciones" class="topbar-action-toggle"
                id="btnNotifyToggle">
                <i class="fa fa-bell"></i>
                <span class="topbar-action-badge">5</span>
            </button>

            <div aria-labelledby="btnNotifyToggle" class="topbar-action-menu" id="menuNotifyToggle" role="menu">
                <div class="topbar-action-menu-head">
                    Notificaciones
                    <span class="topbar-action-new-count">5 nuevas</span>
                </div>

                <a class="topbar-action-item" href="#" role="menuitem">
                    <i class="fa fa-user-plus"></i>
                    <div class="topbar-action-item-content">
                        <strong>Juan Pérez</strong> se registró
                        <br>
                        <small>Hace 2 min</small>
                    </div>
                </a>

                <a class="topbar-action-item" href="#" role="menuitem">
                    <i class="fa fa-shopping-cart"></i>
                    <div class="topbar-action-item-content">
                        Nueva venta de <strong>$1,250</strong>
                        <br>
                        <small>Hace 15 min</small>
                    </div>
                </a>

                <a class="topbar-action-item topbar-action-view-all" href="#" role="menuitem">
                    Ver todas
                </a>
            </div>
        </div> --}}

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
                        <img src="{{ auth()->user()->image }}"
                            alt="Uchiha Madara" class="rounded-circle flex-shrink-0" width="30" height="30"
                            style="object-fit: cover;">

                        <!-- Texto a la derecha -->
                        <div class="d-flex flex-column gap-0 ">
                            <strong class="text-dark ">{{ auth()->user()->getRoleNames()->first() }}:</strong>
                            <small class="text-primary mb-0">{{ auth()->user()->full_name }}</small>
                        </div>
                    </div>
                </div>
            </div>
            <div aria-labelledby="btnProfileToggle" class="topbar-action-menu" id="menuProfileToggle" role="menu">

                <div class="topbar-action-menu-head">
                    Mi Cuenta
                </div>

                <a class="topbar-action-item" href="{{ route('settings.profile') }}" role="menuitem" wire:navigate>
                    <i class="fa fa-user"></i>
                    <span>Mi Perfil</span>
                </a>

                <a class="topbar-action-item topbar-action-logout" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();" role="menuitem">
                    <i class="fa fa-sign-out-alt"></i>
                    <span>{{ __('Logout') }}</span>
                </a>

                <form action="{{ route('logout') }}" class="d-none" id="logout-form" method="POST">
                    @csrf
                </form>

            </div>
        </div>


        {{-- <div class="topbar-action-dropdown">
            <div class="card border-1">
                <img class="border-radius-lg rounded-circle" height="30" width="30"
                    src="https://i.pinimg.com/originals/bd/2e/0d/bd2e0d56cc9b061d694979158bda4d0b.jpg" alt="">
                <strong>role</strong>
                Uchiha Madara
            </div>
        </div> --}}
        {{--  <div class="topbar-action-dropdown">


            <button aria-expanded="false" aria-haspopup="true" aria-label="Notificaciones" class="topbar-action-toggle"
                id="btnNotifyToggle">
                <i class="fa fa-user-circle"></i>
            </button>

            <div aria-labelledby="btnProfileToggle" class="topbar-action-menu" id="menuProfileToggle" role="menu">

                <div class="topbar-action-menu-head">
                    Mi Cuenta
                </div>

                <a class="topbar-action-item" href="{{ route('settings.profile') }}" role="menuitem" wire:navigate>
                    <i class="fa fa-user"></i>
                    <span>Mi Perfil</span>
                </a>

                 <a class="topbar-action-item" href="#" role="menuitem">
                    <i class="fa fa-cog"></i>
                    <span>Configuración</span>
                </a>

                <a class="topbar-action-item" href="#" role="menuitem">
                    <i class="fa fa-moon"></i>
                    <span>Modo Oscuro</span>
                </a> 

                <a class="topbar-action-item topbar-action-logout" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();" role="menuitem">
                    <i class="fa fa-sign-out-alt"></i>
                    <span>{{ __('Logout') }}</span>
                </a>

                <form action="{{ route('logout') }}" class="d-none" id="logout-form" method="POST">
                    @csrf
                </form>

            </div>
        </div>
 --}}
    </div>

</header>
