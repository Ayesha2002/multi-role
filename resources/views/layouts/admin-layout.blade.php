<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>

    <div>
        <h2>Admin Panel</h2>

        <nav>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a> |
            <a href="{{ route('admin.profile') }}">Profile</a> |
            <a href="{{ route('admin.change-password') }}">Change Password</a>
        </nav>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>

        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
    </div>

    <hr>

    <div>
        @yield('content')
    </div>

</body>
</html>
