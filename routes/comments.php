<?php

use App\Http\Controllers\TopicCommentController;
use Illuminate\Support\Facades\Route;

Route::post('/topics/{topic}/comments/validate', [TopicCommentController::class, 'xhrValidate'])
    ->name('topics.comments.validate');

Route::resource('topics.comments', TopicCommentController::class)->except(['index', 'show']);


