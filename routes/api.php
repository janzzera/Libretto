<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\GenreController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('books', BookController::class);
    Route::apiResource('authors', AuthorController::class);
    Route::apiResource('genres', GenreController::class);

    Route::prefix('books/{book}')->group(function() {
        Route::get('/reviews', [ReviewController::class, 'index']);
        Route::post('/reviews', [ReviewController::class, 'store']);
        Route::get('/reviews/{review}', [ReviewController::class, 'show']);
        Route::put('/reviews/{review}', [ReviewController::class, 'update']);
        Route::delete('/reviews/{review}', [ReviewController::class, 'destroy']);
    });
});
