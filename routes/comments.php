<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::resource('comments', CommentController::class)->only(['index', 'show']);

Route::resource('comments', CommentController::class)->except(['index', 'show'])
    ->middleware('auth');

Route::post('/comments/validate', [CommentController::class, 'xhrValidate'])->middleware('auth')
    ->name('comments.validate');