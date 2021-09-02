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

$commonShare = function () {
    Route::get('/', 'HomeShareController@index')->name('share-home');
    Route::get('share/{id}', 'PostController@shareArticle')->name('post-share');
    Route::get('video/{id}', 'PostController@shareVideo')->name('video-share');
};

Route::domain(env('DOMAIN_SHARE'))->group($commonShare);
Route::domain(env('DOMAIN_HUMOR_SHARE'))->group($commonShare);

Route::domain(env('DOMAIN_WEB'))->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/rssfeeds/instant-articles', 'RssController@instantArticles')->name('instant-articles');
    Route::get('/{category}', 'PostController@index')->name('post-list');
    Route::get('/{category}/{id}', 'PostController@detail')->name('post-detail');
});