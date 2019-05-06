<nav class="navbar navbar-expand-md navbar-laravel p-1 shadow fixed-top">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ url('/') }}">
        {{ config('app.name', 'Laravel') }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav px-5 mx-5">
            <li class="nav-item px-5 mx-5">
                {{--<span class="px-5 mx-5" id="currentDatetime" style="color:white;"></span>--}}
            </li>
        </ul>
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
                <li class="nav-item dropdown px-2">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="px-1 caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" style="color:#505050 !important;" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
        <div class="container col-md-2" style="margin:0; padding:0;">
            <nav class="d-none d-md-block sidebar">
                <ul class="nav flex-column nav-list">
                    <li class="nav-item">
                        <a class="nav-link" href="/pos-dashboard">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <button class="dropdown-btn nav-link-drop" id="restoTransactionsTab">
                            <i class="fa fa-book" aria-hidden="true"></i>
                            <span> Transactions </span>
                            <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-container" id="dropdownRestoTransactions">
                            <a class="dropdown-item" href="#">
                                <i class="fa fa-file-invoice" aria-hidden="true"></i>
                                <span> Orders </span>
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fa fa-receipt" aria-hidden="true"></i>
                                <span> Payments </span>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/cashier-shift-report" id="cashierShiftReports">
                            <i class="fa fa-cash-register" aria-hidden="true"></i>
                            Shift Reports
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="restoReports">
                            <i class="fa fa-balance-scale" aria-hidden="true"></i>
                            Sales Reports
                        </a>
                    </li>
                </ul>
            </nav>
        </div>