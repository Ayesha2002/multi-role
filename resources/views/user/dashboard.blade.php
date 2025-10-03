@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Welcome, {{ Auth::user()->name }}</h2>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    <div style="margin-top: 20px;">
        <a href="{{ route('blog.create') }}" class="btn btn-primary">📝 Create Blog</a>
    </div>

</div>
@endsection
