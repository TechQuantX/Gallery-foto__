<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\CustomLoginController;
use App\Http\Controllers\Auth\CustomRegisterController;

// Rute untuk halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Rute untuk album dan foto (perlu middleware 'auth')
Route::middleware(['auth'])->group(function () {
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/user/profile/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/user/profile/update', [UserController::class, 'update'])->name('user.update');
    Route::get('/account', [AccountController::class, 'showAccount'])->name('account.index');


    Route::get('/account', [AccountController::class, 'showAccount'])->name('account.index');

    Route::get('/albums/{album}/edit', [AlbumController::class, 'edit'])->name('albums.edit');
    Route::put('/albums/{album}', [AlbumController::class, 'update'])->name('albums.update');

    // Album routes
    Route::get('/albums', [AlbumController::class, 'index'])->name('albums.index');
    Route::get('/albums/create', [AlbumController::class, 'create'])->name('albums.create');
    Route::post('/albums', [AlbumController::class, 'store'])->name('albums.store');
    Route::get('/albums/{album}', [AlbumController::class, 'show'])->name('albums.show');
    Route::delete('/albums/{album}', [AlbumController::class, 'destroy'])->name('albums.destroy');


    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');

    // Foto routes
    Route::get('/photos/create', [FotoController::class, 'create'])->name('photos.create');
    Route::post('/photos', [FotoController::class, 'store'])->name('photos.store');
    Route::get('photos/{id}', [FotoController::class, 'show'])->name('photos.show');
    Route::get('/photos', [FotoController::class, 'index'])->name('photos.index');
    Route::get('/photos/{photo}/edit', [FotoController::class, 'edit'])->name('photos.edit');
    Route::put('/photos/{photo}', [FotoController::class, 'update'])->name('photos.update');
    Route::delete('/photos/{photo}', [FotoController::class, 'destroy'])->name('photos.destroy');
    Route::post('/photos/{id}/comment', [FotoController::class, 'addComment'])->name('photos.comment');
    Route::post('/photos/{id}/like', [FotoController::class, 'addLike'])->name('photos.like');
    Route::delete('/photos/{id}/unlike', [FotoController::class, 'unlikePhoto'])->name('photos.unlike');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::delete('photos/comment/{commentId}', [FotoController::class, 'deleteComment'])->name('photos.comment.delete');
});

Auth::routes();
Route::post('/register', [CustomRegisterController::class, 'register']);
