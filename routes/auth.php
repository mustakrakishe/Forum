<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::post('/register/validate', [RegisterController::class, 'xhrValidate'])
                ->middleware('guest')
                ->name('register.validate');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');

Route::post('/login/validate', [AuthenticatedSessionController::class, 'isValid'])
                ->middleware('guest')
                ->name('login.validate');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest');
