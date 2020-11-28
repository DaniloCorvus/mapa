<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-muted" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
            aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"> </span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{url('/')}}">
            <img src="{{asset('/img/logo.png')}}" class="navbar-brand-img" alt="Logo">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img src="{{asset('/img/logo.png')}}" class="navbar-brand-img" alt="Logo">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>Logout</span>
                    </a>

                    <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        {{-- <a href="#">
                            <img src="../assets/img/brand/blue.png" alt="...">
                        </a> --}}
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                            aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item {{!Route::is('/administrativo/categorias') ?: 'active'}}">
                    <a class=" nav-link " href=" {{url('/administrativo/categorias')}}"> <i class="ni ni-tv-2 text-primary"></i>
                        Administracions
                    </a>
                </li>

                {{-- <li class="nav-item {{!Route::is('administrativo.procesos.index') ?: 'active bg-info'}}">
                    <a class="nav-link  active " href="{{route('administrativo.procesos.index')}}">
                        <i class="ni ni-planet text-blue"></i> Procesos
                    </a>
                </li> --}}

                {{-- <li class="nav-item {{!Route::is('users.index') ?: 'active bg-info'}}">
                    <a class="nav-link " href="{{route('users.index')}}">
                        <i class="ni ni-single-02 text-success"></i> Usuarios
                    </a>
                </li>

                <li class="nav-item {{!Route::is('procesos.index') ?: 'active bg-info'}}">
                    <a class="nav-link " href="{{route('procesos.index')}}">
                        <i class="ni ni-single-02 text-yellow"></i> Procesos
                    </a>
                </li>

                <li class="nav-item {{!Route::is('subprocesos.index') ?: 'active bg-info'}}">
                    <a class="nav-link " href="{{route('subprocesos.index')}}">
                        <i class="ni ni-bullet-list-67 text-red"></i>Subprocesos
                    </a>
                </li>

                <li class="nav-item {{!Route::is('macroprocesos.index') ?: 'active bg-info'}}">
                    <a class="nav-link " href="{{route('macroprocesos.index')}}">
                        <i class="ni ni-settings-gear-65 text-dark"></i> Macroprocesos
                    </a>
                </li> --}}

            </ul>
        </div>
    </div>
</nav>