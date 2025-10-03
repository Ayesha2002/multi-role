@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Blog</h2>
    <form method="POST" action="{{ route('blog.store') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <label>Title</label>
            <input type="text" name="title" required>
        </div>

        <div>
            <label>Content</label>
            <textarea name="content" rows="5" required></textarea>
        </div>

        <div>
            <label>Image (optional)</label>
            <input type="file" name="image">
        </div>

        <button type="submit">Submit for Review</button>
    </form>
</div>
@endsection
