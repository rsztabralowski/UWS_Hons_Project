 <!-- Sidebar -->
 <nav id="sidebar">
    <div class="sidebar-header"></div>
    <ul class="list-unstyled components">
        
        <li>
            <div>
                {{ __('Language') }}
            </div>
            <div class="languages-admin">
                <a href="{{ url('/lang/en') }}">
                    EN
                </a> 
                <a href="{{ url('/lang/pl') }}">
                    PL
                </a> 
            </div>
        </li>


        <li class="{{ (request()->is('admin/dashboard*')) ? 'active' : '' }}">
            <a href="{{url('/admin/dashboard')}}"><i class="fas fa-tachometer-alt"></i> {{ __('Dashboard') }}</a>
        </li>
        <li class="{{ (request()->is('admin/bookings*')) ? 'active' : '' }}">
            <a href="{{url('/admin/bookings')}}"><i class="fas fa-book-open"></i> {{ __('Bookings') }}</a>
        </li>
        <li class="{{ (request()->is('admin/users*')) ? 'active' : '' }}">
            <a href="{{url('/admin/users')}}"><i class="fas fa-users"></i> {{ __('Users') }}</a>
        </li>
        <li class="{{ (request()->is('admin/rooms*')) ? 'active' : '' }}">
            <a href="{{url('/admin/rooms')}}"><i class="fas fa-door-open"></i> {{ __('Rooms') }}</a>
        </li>
        <li class="{{ (request()->is('admin/calendar*')) ? 'active' : '' }}">
            <a href="{{url('/admin/calendar')}}"><i class="fas fa-calendar-alt"></i> {{ __('Calendar') }}</a>
        </li>
        <li class="nav-item dropdown">
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>