<?php

use App\Http\Controllers\TopicCommentController;
use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    return redirect()->route('topics.index');
})->name('home');

Auth::routes();

Route::resource('topics', TopicController::class);

Route::resource('topics.comments', TopicCommentController::class)->except(['index', 'show']);
