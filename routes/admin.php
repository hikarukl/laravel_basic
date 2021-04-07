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

Route::group(['middleware' => ['auth:web']], function () {
    Route::group(['prefix' => 'otp'], function () {
        Route::get('/', [\App\Http\Controllers\Auth\LoginOtpController::class, 'index'])->name('otp.get');
        Route::post('/resend', [\App\Http\Controllers\Auth\LoginOtpController::class, 'resend'])->name('otp.resend');
        Route::post('/send', [\App\Http\Controllers\Auth\LoginOtpController::class, 'process'])->name('otp.send');
    });

    Route::group(['middleware' => 'verified_otp'], function () {
        Route::get('/', function () {
            return view('dashboard');
        })->name('home');
       Route::get('/dashboard', function () {
           return view('dashboard');
       })->name('dashboard');

        Route::post('coin/calculate', ['as' => 'coin.calculate', 'use' => '\App\Http\Controllers\Admin\CoinController@calculate']);
        Route::resource('coin', \App\Http\Controllers\Admin\CoinController::class);
    });

});
