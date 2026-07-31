<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Attributes\Controllers\Middleware;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    public function index(): Response
    {
        $posts = Post::published()->latest('published_at')->paginate(10);

        return Inertia::render('Posts/Index', compact('posts'));
    }

    public function show(Post $post): Response
    {
        $post->load(['user', 'comments.user']);

        return Inertia::render('Posts/Show', compact('post'));
    }

    #[Middleware('permission:create posts')]
    public function create(): Response
    {
        return Inertia::render('Posts/Create');
    }

    #[Middleware('permission:create posts')]
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug',
            'body' => 'required|string',
            'excerpt' => 'nullable|string',
            'published_at' => 'nullable|date',
        ]);

        $post = Post::create([
            'title' => $data['title'],
            'slug' => $data['slug'] ?: Str::slug($data['title']),
            'body' => $data['body'],
            'excerpt' => $data['excerpt'] ?? null,
            'published_at' => $data['published_at'] ?? null,
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('posts.edit', $post)->with('message', 'Post created.');
    }

    #[Middleware('permission:edit posts')]
    public function edit(Post $post): Response
    {
        return Inertia::render('Posts/Edit', compact('post'));
    }

    #[Middleware('permission:edit posts')]
    public function update(Request $request, Post $post): RedirectResponse
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug,'.$post->id,
            'body' => 'required|string',
            'excerpt' => 'nullable|string',
            'published_at' => 'nullable|date',
        ]);

        $post->update([
            'title' => $data['title'],
            'slug' => $data['slug'] ?: Str::slug($data['title']),
            'body' => $data['body'],
            'excerpt' => $data['excerpt'] ?? null,
            'published_at' => $data['published_at'] ?? null,
        ]);

        return redirect()->route('posts.edit', $post)->with('message', 'Post updated.');
    }

    #[Middleware('permission:delete posts')]
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('blog')->with('message', 'Post deleted.');
    }
}
