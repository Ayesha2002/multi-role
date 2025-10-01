@extends('layouts.admin-layout')

@section('content')
    <h1>Admin Dashboard</h1>

    @if(Auth::user()->photo)
        <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Admin Photo" width="100" height="100">
    @else
        <img src="{{ asset('images/default.png') }}" alt="Default Photo" width="100" height="100">
    @endif

    <p>Welcome, <strong>{{ Auth::user()->name }}</strong>!</p>
    <p>You are logged in as <strong>Admin</strong>.</p>
@endsection
