<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\TopicCommentController;
use Illuminate\Support\Facades\Route;

Route::resource('topics.comments', CommentController::class)->except(['index']);

Route::post('/topics/{topic}/comments/validate', [CommentController::class, 'xhrValidate'])->name('topics.comments.validate');
