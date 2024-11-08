<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\PostImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/create-post', [PostController::class, 'create'])->name('post.create');
    Route::post('/create-post', [PostController::class, 'store'])->name('post.store');
    Route::post('/create-post-image', [PostImageController::class, 'store'])->name('postImage.store');

    Route::get('/posts', [PostController::class, 'index'])->name('post.index');
    Route::patch('/posts/{post}/like', [PostController::class, 'like'])->name('post.like');

    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/users/feed', [UserController::class, 'feed'])->name('user.feed');
    Route::get('/users/{user}/posts', [UserController::class, 'posts'])->name('user.posts.index');
    Route::patch('/users/{user}/follow', [UserController::class, 'follow'])->name('user.follow');
});

require __DIR__.'/auth.php';
