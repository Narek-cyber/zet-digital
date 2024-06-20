<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\SubscriberController;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::post('posts/{id}', [PostController::class, 'store'])->name('posts.store');
Route::post('subscribes', [SubscriberController::class, 'store'])->name('subscribes.store');
