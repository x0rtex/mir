<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return Inertia::render('Posts/Index', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->load(['user', 'comments.user']);
        return Inertia::render('Posts/Show', compact('post'));
    }
}
