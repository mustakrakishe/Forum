<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::resource('topics.comments', CommentController::class)->except(['index']);

Route::resource('topics.comments.comments', CommentController::class)->only(['create', 'store']);

Route::post('/topics/{topic}/comments/validate', [CommentController::class, 'xhrValidate'])->name('topics.comments.validate');