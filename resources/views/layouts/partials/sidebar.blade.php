<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center w-100">
                <a href="{{ route('notices.home') }}" class="text-nowrap logo-img">
                    <img src="{{ asset('assets/images/logos/logo.png') }}" width="50" alt="" />
                </a>
                <div class="d-flex align-items-center justify-content-between ms-3 w-100">
                    <div class="box">
                        <small class="mb-0">Bienvenido</small>
                        <h5 class="mb-0">{{ Auth::user()->name }}</h5>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="sidebar-link text-dark">
                        <i class="ti ti-logout h3"></i>
                    </a>
                </div>
            </div>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->

        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Noticias</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Route::currentRouteName() == 'notices.home' ? 'active' : '' }}" href="{{ route('notices.home') }}">
                        <span>
                            <i class="ti ti-eye"></i>
                        </span>
                        <span class="hide-menu">Inicio</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Route::currentRouteName() == 'notices.index' ? 'active' : '' }}" href="{{ route('notices.index') }}">
                        <span>
                            <i class="ti ti-list-details"></i>
                        </span>
                        <span class="hide-menu">Administrador</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Route::currentRouteName() == 'notices.create' ? 'active' : '' }}" href="{{ route('notices.create') }}">
                        <span>
                            <i class="ti ti-circle-plus"></i>
                        </span>
                        <span class="hide-menu">Crear noticia</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Institucion</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Route::currentRouteName() == 'members.index' ? 'active' : '' }}" href="{{ route('members.index') }}">
                        <span>
                            <i class="ti ti-list-details"></i>
                        </span>
                        <span class="hide-menu">Listado de Miembros</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Route::currentRouteName() == 'members.create' ? 'active' : '' }}" href="{{ route('members.create') }}">
                        <span>
                            <i class="ti ti-circle-plus"></i>
                        </span>
                        <span class="hide-menu">Registrar Miembros</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Route::currentRouteName() == 'members.uploads' ? 'active' : '' }}" href="{{ route('members.uploads') }}">
                        <span>
                            <i class="ti ti-file-plus"></i>
                        </span>
                        <span class="hide-menu">Carga Masiva</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Comite Local</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Route::currentRouteName() == 'committe-local.index' ? 'active' : '' }}" href="{{ route('committe-local.index') }}">
                        <span>
                            <i class="ti ti-list-details"></i>
                        </span>
                        <span class="hide-menu">Listado</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link {{ Route::currentRouteName() == 'committe-local.create' ? 'active' : '' }}" href="{{ route('committe-local.create') }}">
                        <span>
                            <i class="ti ti-circle-plus"></i>
                        </span>
                        <span class="hide-menu">Registrar</span>
                    </a>
                </li>

                {{-- <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Cargo de Elección Popular</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="#">
                        <span>
                            <i class="ti ti-list-details"></i>
                        </span>
                        <span class="hide-menu">Listado</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="#">
                        <span>
                            <i class="ti ti-circle-plus"></i>
                        </span>
                        <span class="hide-menu">Registrar</span>
                    </a>
                </li> --}}

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Usuarios</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Route::currentRouteName() == 'users.index' ? 'active' : '' }}" href="{{ route('users.index') }}">
                        <span>
                            <i class="ti ti-list-details"></i>
                        </span>
                        <span class="hide-menu">Listado</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Route::currentRouteName() == 'users.create' ? 'active' : '' }}" href="{{ route('users.create') }}">
                        <span>
                            <i class="ti ti-circle-plus"></i>
                        </span>
                        <span class="hide-menu">Registrar</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
