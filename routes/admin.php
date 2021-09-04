<?php

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

Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.index');

    Route::group(['middleware' => ['can.access.menu', 'has.permission']], function () {
        // Ajax when go to screen
        Route::get('/admin-post/ajax/list', '\App\Http\Controllers\Admin\PostController@ajaxGetList')->name('admin-post.ajax.list');

        Route::resource('admin-category', \App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('admin-post', \App\Http\Controllers\Admin\PostController::class);
    });
});