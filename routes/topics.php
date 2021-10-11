<?php

use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Route;

Route::resource('topics', TopicController::class)->except(['create', 'edit'])
    ->middleware('auth');

Route::resource('topics', TopicController::class)->only(['index', 'show']);

Route::post('/topics/validate', [TopicController::class, 'xhrValidate'])->middleware('auth')
    ->name('topics.validate');