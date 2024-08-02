<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LocationController;

// Authentication Route
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::get('articles', [ArticleController::class, 'index']);
Route::get('articles/{id}', [ArticleController::class, 'show']);
Route::get('events', [EventController::class, 'index']);
Route::get('events/{id}', [EventController::class, 'show']);
// User Routes
Route::middleware('auth:api')->group(function () {
    Route::get('users', [UserController::class, 'index']);
    Route::get('users/{id}', [UserController::class, 'show']);
    Route::put('users/{id}', [UserController::class, 'update']);
    Route::delete('users/{id}', [UserController::class, 'destroy']);

    // Article Routes

    Route::post('articles', [ArticleController::class, 'store']);
    Route::put('articles/{id}', [ArticleController::class, 'update']);
    Route::delete('articles/{id}', [ArticleController::class, 'destroy']);

    // Event Routes

    Route::post('events', [EventController::class, 'store']);
    Route::put('events/{id}', [EventController::class, 'update']);
    Route::delete('events/{id}', [EventController::class, 'destroy']);

    // Location Routes
    Route::get('locations', [LocationController::class, 'index']);
    Route::get('locations/{id}', [LocationController::class, 'show']);
    Route::post('locations', [LocationController::class, 'store']);
    Route::put('locations/{id}', [LocationController::class, 'update']);
    Route::delete('locations/{id}', [LocationController::class, 'destroy']);

    // Review Routes
    Route::get('reviews', [ReviewController::class, 'index']);
    Route::get('reviews/{id}', [ReviewController::class, 'show']);
    Route::post('reviews', [ReviewController::class, 'store']);
    Route::put('reviews/{id}', [ReviewController::class, 'update']);
    Route::delete('reviews/{id}', [ReviewController::class, 'destroy']);

    // Comment Routes
    Route::get('comments', [CommentController::class, 'index']);
    Route::get('comments/{id}', [CommentController::class, 'show']);
    Route::post('comments', [CommentController::class, 'store']);
    Route::put('comments/{id}', [CommentController::class, 'update']);
    Route::delete('comments/{id}', [CommentController::class, 'destroy']);
});
