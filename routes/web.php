<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SysUserController;

// Route::get('/login', [SysUserController::class, 'login'])->name('login');
Route::post('/authenticate', [SysUserController::class, 'authenticate'])->name('authenticate');
Route::get('/register', [SysUserController::class, 'register'])->name('register');
Route::post('/store', [SysUserController::class, 'store'])->name('store');

Route::middleware('auth')->group(function() {
    Route::get('/', function () {
        return redirect(route('authors.index')); 
    });

    Route::resource('authors', AuthorController::class);
    Route::resource('books', BookController::class);
    Route::resource('genres', GenreController::class);
    Route::resource('reviews', ReviewController::class);

    Route::match(['POST', 'GET'], '/logout', [SysUserController::class, 'logout'])->name('logout');
});
