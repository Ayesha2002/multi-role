@extends('layouts.admin-layout')

@section('content')
    <h2>Update Profile</h2>

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

    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label>Name:</label>
            <input type="text" name="name" value="{{ $user->name }}">
        </div>
<br>
        <div>
            <label>Email:</label>
            <input type="email" name="email" value="{{ $user->email }}">
        </div>
<br>
        <div>
            <label>Profile Photo:</label>
            <input type="file" name="photo">
        </div>
        <br>

        @if($user->photo)
            <img src="{{ asset('storage/' . $user->photo) }}" alt="Profile Photo" width="100" height="100">
        @endif
<br>
        <div>
            <button type="submit">Save Changes</button>
        </div>
    </form>
@endsection
