<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Panel</title>
</head>
<body>

    <div>
        <h2>User Panel</h2>

        <nav>
            <a href="{{ route('user.dashboard') }}">Dashboard</a> |
            <a href="{{ route('profile.show') }}">Profile</a> |
            <a href="{{ route('profile.change-password') }}">Change Password</a>
        </nav>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
