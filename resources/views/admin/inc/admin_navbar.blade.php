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
            {{ (request()->is('admin/calendar*')) ? 'Calendar' : '' }}
        </span>
        <div class="container"></div>
    </div>
</nav>