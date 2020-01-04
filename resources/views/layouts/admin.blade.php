<!DOCTYPE html>
<html>
<head>
    <noscript>
        <div style="text-align: center; background-color: red; color:white; padding:40px">
            <h1>JavaScript is turned off or your browser does not support it</h1>
            <br>
            <h4>This site will not work properly</h4>
        </div>
    </noscript>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel</title>
    <!-- JQuery CSS -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Data Tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
    <!--Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-laravel">
        <div class="navbar_flex">
            <div id="content">
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">

                        <button type="button" id="sidebarCollapse" class="btn">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </nav>
            </div>
            <span class="navbar-brand">
                {{ (request()->is('admin/dashboard*')) ? 'Dashboard' : '' }}
                {{ (request()->is('admin/bookings*')) ? 'Bookings' : '' }}
                {{ (request()->is('admin/users*')) ? 'Users' : '' }}
                {{ (request()->is('admin/rooms*')) ? 'Rooms' : '' }}
            </span>
            <div class="container"></div>
        </div>
    </nav>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header"></div>
            <ul class="list-unstyled components">
                <li class="{{ (request()->is('admin/dashboard*')) ? 'active' : '' }}">
                    <a href="{{url('/admin/dashboard')}}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li class="{{ (request()->is('admin/bookings*')) ? 'active' : '' }}">
                    <a href="{{url('/admin/bookings')}}"><i class="fas fa-book-open"></i> Bookings</a>
                </li>
                <li class="{{ (request()->is('admin/users*')) ? 'active' : '' }}">
                    <a href="{{url('/admin/users')}}"><i class="fas fa-users"></i> Users</a>
                </li>
                <li class="{{ (request()->is('admin/rooms*')) ? 'active' : '' }}">
                    <a href="{{url('/admin/rooms')}}"><i class="fas fa-door-open"></i> Rooms</a>
                </li>
                <li class="{{ (request()->is('admin/calendar*')) ? 'active' : '' }}">
                    <a href="{{url('/admin/calendar')}}"><i class="fas fa-calendar-alt"></i> Calendar</a>
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
        <!-- Page Content -->
        <div id="content">
            @include('admin.inc.messages') 
            @yield('content')
            <br /><br /><br />
        </div>
    </div>
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- Font Awesome JS -->
    <script src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>

    @if (Route::is('bookings.create'))
    <script src="{{ asset('js/checkRooms.js') }}"></script>
    @endif
    @if (Route::is('bookings.edit'))
    <script src="{{ asset('js/edit_checkRooms.js') }}"></script>
    @endif
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <!-- DataTables script -->
    @if (Route::current()->getName() == 'bookings.index')
    <script src="{{ asset('js/bookings_datatables.js') }}"></script>
    @endif
    @if (Route::current()->getName() == 'users.index')
    <script src="{{ asset('js/users_datatables.js') }}"></script>
    @endif
    @if (Route::current()->getName() == 'rooms.index')
    <script src="{{ asset('js/rooms_datatables.js') }}"></script>
    @endif
    @if (Route::current()->getName() == 'calendar')
    <script src="{{ asset('js/calendar.js') }}"></script>
    @endif
</body>
</html>
