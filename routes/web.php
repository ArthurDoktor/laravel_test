<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $posts = [];
    if (auth()->check()){
        $posts = auth()->user()->posts()->latest()->get();
    }
    return view('home', ['posts' => $posts]);
});

Route::post('/register', [UserController::class, 'registering']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

// Blog related routes
Route::post('/create-post', [PostController::class, 'CreatePost']);
Route::get('/edit-post/{post}', [PostController::class, 'EditPost']);
Route::put('/edit-post/{post}', [PostController::class, 'UpdatePost']);
Route::delete('/delete-post/{post}', [PostController::class, 'DeletePost']);
