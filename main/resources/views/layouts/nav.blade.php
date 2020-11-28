<div class="float-right">
    <a class="  text-dark font-italic navbar-brand" title="ir a Inicio" href="{{ url('/home') }}">
        <i class="fa fa-home "></i>
        Inicio
    </a>
</div><br>

@auth
<ul class=" float-right navbar-nav align-items-center d-none d-md-flex">

    <li class="nav-item dropdown">
        <a class="nav-link font-italic text-dark " href="{{route('users.index')}}">
            <i class="fa fa-user" aria-hidden="true"></i> Usuarios
        </a>
    </li>

    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle font-italic text-dark " href="#" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            <i class="fa fa-user-circle " aria-hidden="true"></i>
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
</ul>
@endauth