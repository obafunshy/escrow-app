<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(8);
        return view('admin.index', compact('posts'));
    }

    public function showPosts() {
        $posts = Post::paginate(8);
        return view('admin.posts.index', compact('posts'));
    }
}
