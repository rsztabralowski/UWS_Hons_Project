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

    @include('admin.inc.admin_links')

</head>
<body>

    @include('admin.inc.admin_navbar')

    <div class="wrapper">
        
       @include('admin.inc.admin_sidebar')

        <!-- Page Content -->
        <div id="content">

            @include('admin.inc.messages') 

            @yield('content')

            <br /><br /><br />
        </div>
    </div>

    @include('admin.inc.admin_scripts')
    
</body>
</html>
