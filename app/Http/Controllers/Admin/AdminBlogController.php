<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class AdminBlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function updateStatus($id, $status)
    {
        $blog = Blog::findOrFail($id);
        $blog->status = $status;
        $blog->save();

        return redirect()->back()->with('success', 'Blog status updated successfully.');
    }
}
