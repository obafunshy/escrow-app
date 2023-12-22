<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 1)->paginate(4);

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->load('category', 'tags');
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostRequest $request)
    {
        $imagePath = $request->file('image')->store('public/images');
        $imageUrl = Storage::url($imagePath);

        $post = new Post([
            'title' => $request->title,
            'user_id' => auth()->id(),
            'image' => $imageUrl,
            'content' => $request->content,
            'likes' => 0,
        ]);

        $post->save();

        if ($request->has('tags')) {
            $tagIds = $request->input('tags');
            $post->tags()->attach($tagIds);
        }

        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }
}
