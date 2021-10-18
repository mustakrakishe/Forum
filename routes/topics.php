<?php

use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Route;

Route::resource('topics', TopicController::class);

Route::post('/topics/validate', [TopicController::class, 'xhrValidate'])->name('topics.validate');