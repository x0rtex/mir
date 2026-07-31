<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Home')->name('home');

Route::get('/register', [RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisterController::class, 'store'])
    ->middleware('guest');

Route::get('/login', [LoginController::class, 'create'])
    ->middleware('guest')
    ->name('login');
Route::post('/login', [LoginController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [LogoutController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::inertia('/about', 'About')->name('about');

Route::get('/blog', [PostController::class, 'index'])
    ->name('blog');
Route::get('/blog/{post:slug}', [PostController::class, 'show'])
    ->name('posts.show');

Route::get('/posts/create', [PostController::class, 'create'])
    ->middleware('permission:create posts')
    ->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])
    ->middleware('permission:create posts')
    ->name('posts.store');
Route::get('/posts/{post:slug}/edit', [PostController::class, 'edit'])
    ->middleware('permission:edit posts')
    ->name('posts.edit');
Route::put('/posts/{post:slug}', [PostController::class, 'update'])
    ->middleware('permission:edit posts')
    ->name('posts.update');
Route::delete('/posts/{post:slug}', [PostController::class, 'destroy'])
    ->middleware('permission:delete posts')
    ->name('posts.destroy');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'show'])->name('show');
    Route::post('/', [ProfileController::class, 'update'])->name('update');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
});
