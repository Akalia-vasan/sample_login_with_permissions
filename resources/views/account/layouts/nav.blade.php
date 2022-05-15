<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <a href="{{ Route::is('/task') }}" class="navbar-brand">My Task</a>

    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="@lang('labels.general.toggle_navigation')">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav">

            

            @guest
                <li class="nav-item"><a href="{{route('login')}}" class="nav-link {{ active_class(Route::is('login')) }}">Login</a></li>
                <li class="nav-item"><a href="{{route('register')}}" class="nav-link {{ active_class(Route::is('register')) }}">Register</a></li>
            @else
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuUser" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">{{ auth()->user()->name }}</a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuUser">
                        <a href="{{ route('home') }}" class="dropdown-item">Administration</a>

                        <a href="{{ route('admin.auth.account.index') }}" class="dropdown-item {{ active_class(Route::is('frontend.user.account')) }}">My Account</a>
                        <a href="{{ route('logout') }}" class="dropdown-item">Logout</a>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>
