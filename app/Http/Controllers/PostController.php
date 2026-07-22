<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    public function index(): Response
    {
        $posts = Post::all();

        return Inertia::render('Posts/Index', compact('posts'));
    }

    public function show(Post $post): Response
    {
        $post->load(['user', 'comments.user']);

        return Inertia::render('Posts/Show', compact('post'));
    }
}
