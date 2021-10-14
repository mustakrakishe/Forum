<?php

use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Route;

Route::resource('topics', TopicController::class)->only(['index', 'show']);

Route::resource('topics', TopicController::class)->except(['index', 'show'])
    ->middleware('auth');

Route::post('/topics/validate', [TopicController::class, 'xhrValidate'])->middleware('auth')
    ->name('topics.validate');