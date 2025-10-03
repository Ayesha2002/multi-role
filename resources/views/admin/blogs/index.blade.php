@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>All Blogs</h2>
    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Title</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($blogs as $blog)
            <tr>
                <td>{{ $blog->user->name }}</td>
                <td>{{ $blog->title }}</td>
                <td>
                    @if($blog->status == 0)
                        Awaiting
                    @elseif($blog->status == 1)
                        Accepted
                    @else
                        Rejected
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.blogs.updateStatus', [$blog->id, 1]) }}">Approve</a> |
                    <a href="{{ route('admin.blogs.updateStatus', [$blog->id, 2]) }}">Reject</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
