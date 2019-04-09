<nav class="navbar navbar-expand-md navbar-laravel p-1 shadow fixed-top">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ url('/') }}">
        {{ config('app.name', 'Laravel') }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto"></ul>
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
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
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" style="color: rgb(30,30,30);" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
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
</nav>
<div class="container-fluid">
    <div class="row sidebarMainContent">
        <div class="container col md-2" style="margin:0; padding:0;">
            <nav class="d-none d-md-block sidebar">
                <ul class="nav flex-column nav-list">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <button class="dropdown-btn nav-link" href="/view-users">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            User management
                            <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-container">
                            <a class="dropdown-item" href="/view-users">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                Users
                            </a>
                            <a class="dropdown-item" href="/view-roles">
                                <i class="fa fa-briefcase" aria-hidden="true"></i>
                                Roles
                            </a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <button class="dropdown-btn nav-link" href="#">
                            <i class="fa fa-hotel" aria-hidden="true"></i>
                            Lodging
                            <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-container">
                            <a class="dropdown-item" href="/view-units">
                                <i class="fa fa-door-closed" aria-hidden="true"></i>
                                Units
                            </a>
                            <a class="dropdown-item" href="/view-services">
                                <i class="fa fa-archive" aria-hidden="true"></i>
                                Services
                            </a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <button class="dropdown-btn nav-link" href="#">
                            <i class="fa fa-concierge-bell" aria-hidden="true"></i>
                            Bar and Restaurant
                            <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-container">
                            <a class="dropdown-item" href="/view-menu">
                                <i class="fa fa-utensils" aria-hidden="true"></i>
                                Menu
                            </a>
                            <a class="dropdown-item" href="view-recipes">
                                <i class="fa fa-book" aria-hidden="true"></i>
                                Recipes
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>