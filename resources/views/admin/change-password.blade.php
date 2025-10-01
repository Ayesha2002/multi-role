@extends('layouts.admin-layout')

@section('content')
    <h2>Change Password</h2>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('admin.change-password.post') }}" method="POST">
        @csrf

        <div>
            <label>Current Password:</label>
            <input type="password" name="current_password">
        </div>
<br>
        <div>
            <label>New Password:</label>
            <input type="password" name="new_password">
        </div>
<br>
        <div>
            <label>Confirm New Password:</label>
            <input type="password" name="new_password_confirmation">
        </div>
<br>
        <div>
            <button type="submit">Update Password</button>
        </div>
    </form>
@endsection
