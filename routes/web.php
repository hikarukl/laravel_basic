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
Route::get('/', '\App\Http\Controllers\HomeController@index')->name('home');

Route::resource('home', \App\Http\Controllers\HomeController::class);
Route::resource('category', \App\Http\Controllers\CategoryController::class);
Route::resource('post', \App\Http\Controllers\PostController::class);

Route::post('/ckfinder/upload', '\App\Http\Controllers\CkFinderController@index')->name('ckfinder.upload');


