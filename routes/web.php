<?php

use App\Http\Controllers\ClapController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicProfileController;


Route::get('/', [PostController::class, 'index'])->name('dashboard');
Route::get('/@{user:username}', [PublicProfileController::class, 'show'])->name('profile.show');
Route::get('/@{username}/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/c/{category}', [PostController::class, 'category'])->name('posts.ByCategory');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class,'store'])->name('posts.store');
    Route::post('/follow/{user:username}', [FollowerController::class, 'followUnfollow'])->name('follow');
    Route::post('/clap/{post}', [ClapController::class, 'clap'])->name('clap');

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
