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

Route::group(['prefix' => 'otp'], function () {
    Route::get('/', [\App\Http\Controllers\Auth\LoginOtpController::class, 'index'])->name('otp.get');
    Route::post('/resend', [\App\Http\Controllers\Auth\LoginOtpController::class, 'resend'])->name('otp.resend');
    Route::post('/send', [\App\Http\Controllers\Auth\LoginOtpController::class, 'process'])->name('otp.send');
});

Route::group(['middleware' => ['auth:web']], function () {
    Route::group(['middleware' => 'verified_otp'], function () {
        $enableViews = config('fortify.views', true);

        Route::get('/', ['as' => 'home', 'uses' => '\App\Http\Controllers\Admin\DashboardController@index']);
        Route::get('/dashboard', ['as' => 'home', 'uses' => '\App\Http\Controllers\Admin\DashboardController@index']);

        // Authentication...
        if ($enableViews) {
            Route::get('/logout', [\App\Http\Controllers\Auth\AuthenticatedSessionControllerCustom::class, 'destroy'])
                ->name('logout');
        }

        Route::resource('coin', \App\Http\Controllers\Admin\CoinController::class);
        Route::resource('my-profile', \App\Http\Controllers\Admin\MyProfileController::class);
    });

});
