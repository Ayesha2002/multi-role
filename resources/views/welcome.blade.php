@foreach($blogs as $blog)
<div class="blog-card">
    <h3>{{ $blog->title }}</h3>
    @if($blog->image)
        <img src="{{ asset('storage/'.$blog->image) }}" width="200">
    @endif
    <p>{{ Str::limit($blog->content, 150) }}</p>
    <small>By {{ $blog->user->name }}</small>
</div>
@endforeach
