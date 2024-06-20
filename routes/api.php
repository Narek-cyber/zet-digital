<?php

use App\Jobs\PostNotification;
use App\Models\Post;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\SubscriberController;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::post('posts/{id}', [PostController::class, 'store'])->name('posts.store');
Route::post('subscribes', [SubscriberController::class, 'store'])->name('subscribes.store');

Route::get('test', function () {
    $emails = \App\Models\Subscriber::all()->pluck('email')->toArray();
    $posts = Post::query()->where('email_sent', false)->get()->toArray();

    PostNotification::dispatch($emails, $posts)->onQueue('emails');
});
