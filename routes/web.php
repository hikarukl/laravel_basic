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
Route::get('/', 'HomeController@index')->name('home');
Route::get('/rssfeeds/instant-articles', 'RssController@instantArticles')->name('instant-articles');
Route::get('share/{id}', 'PostController@share')->name('post-share');
Route::get('/{category}', 'PostController@index')->name('post-list');
Route::get('/{category}/{id}', 'PostController@detail')->name('post-detail');
