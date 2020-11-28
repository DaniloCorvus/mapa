<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            @auth

            <ul class="navbar-nav mr-auto">

                <li class="nav-item">
                    <a class=" font-italic navbar-brand" title="ir a Inicio" href="{{ url('/home') }}">
                        <i class="fa fa-home "></i>
                        Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a class=" font-italic nav-link" title="videos institucionales" href="{{ route('video.index') }}">
                        <i class="fa fa-play text-dark" aria-hidden="true"></i>
                        Videografia
                    </a>
                </li>
                <li class="nav-item">
                    <a class=" font-italic nav-link" title="Configuracion" href="{{route('administrativo.index')}}">
                        <i class="fa fa-wrench text-dark" aria-hidden="true"></i>
                        Administración
                    </a>
                </li>
            </ul>
        @endauth
            <!-- Right Side Of Navbar
                            -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest

                {{-- <li class="nav-item">
                <a class="nav-link"  href="{{ url('/home') }}">
                <i class="fa fa-cog fa-spin fa-lg fa-fw" aria-hidden="true"></i>
                </a>

                </li> --}}

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>

                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else


                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle font-italic " href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="fa fa-user-circle text-dark" aria-hidden="true"></i>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>