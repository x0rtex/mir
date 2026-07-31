<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Routing\Attributes\Controllers\Middleware;
use Inertia\Inertia;
use Inertia\Response;

#[Middleware('auth')]
#[Middleware('permission:access dashboard')]
class DashboardController extends Controller
{
    public function index(): Response
    {
        $stats = [
            'posts' => Post::count(),
            'users' => User::count(),
        ];

        return Inertia::render('Admin/Dashboard', compact('stats'));
    }
}
