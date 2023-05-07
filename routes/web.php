<?php

use App\Http\Controllers\Dashboard\IndexController;
use App\Http\Controllers\Dashboard\CommentController;
use App\Http\Controllers\Dashboard\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Auth::routes();

Route::controller(IndexController::class)->middleware('auth')->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/post_store', 'postStore')->name('postStore');
    Route::post('/comment_store', 'commentStore')->name('commentStore');
    Route::get('logout', 'logout')->name('logout');
});

Route::controller(CommentController::class)->middleware('auth')->name('comments.')->prefix('comments')->group(function () {
    Route::get('{id}/show', 'show')->name('show');
    Route::get('{id}/destroy', 'destroy')->name('destroy');
    Route::post('update', 'update')->name('update');
    Route::get('softDelete', 'softDelete')->name('softDelete');
    Route::get('restore/{id}', 'restore')->name('restore');
    Route::get('delete/{id}', 'delete')->name('delete');
});

Route::controller(PostController::class)->middleware('auth')->prefix('posts')->name('posts.')->group(function () {
    Route::get('{id}/destroy', 'destroy')->name('destroy');
    Route::post('update', 'update')->name('update');
    Route::get('softDelete', 'softDelete')->name('softDelete');
    Route::get('restore/{id}', 'restore')->name('restore');
    Route::get('delete/{id}', 'delete')->name('delete');
});

