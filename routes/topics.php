<?php

use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Route;

Route::resource('topics', TopicController::class)->middleware('auth');
Route::post('/topics/validate', [TopicController::class, 'validate'])->middleware('auth')
    ->name('topics.validate');