<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Routing\Attributes\Controllers\Middleware;
use Inertia\Inertia;

#[Middleware('auth')]
#[Middleware('permission:access dashboard')]
class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'posts' => Post::count(),
            'comments' => Comment::count(),
            'users' => User::count(),
        ];

        return Inertia::render('Admin/Dashboard', compact('stats'));
    }
}
