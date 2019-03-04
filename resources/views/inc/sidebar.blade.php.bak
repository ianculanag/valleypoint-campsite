<nav id="sidebar">
    <div class="sidebar-header">
      <h5> Hi, {{ Auth::user()->name }}!</h5>
      {{--<h4>Hi, Jhaypee!</h4>--}}
    </div>
    <ul class="list-unstyled components">
      <li class="active">
        <a href="dashboard.html">
          <i class="glyphicon glyphicon-dashboard"></i> Dashboard </a>
      </li>
      <li>
        <a href="reservations.html">
          <i class="glyphicon glyphicon-file"></i> Reservations</a>

        <a href="guests.html">
          <i class="glyphicon glyphicon-user"></i> Guests </a>
      </li>
      <li>
        <a href="reports.html">
          <i class="glyphicon glyphicon-print"></i> Reports</a>
      </li>
      <li>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="glyphicon glyphicon-log-out"></i> Logout </a>
          {{--<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>--}}

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
      </li>
    </ul>
  </nav>