<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'name' => 'required',
            'content' => 'required',
        ]);

        $post->comments()->create([
            'name' => $request->input('name'),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('posts.show', $post);
    }

}
