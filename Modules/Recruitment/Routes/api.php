<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('recruitment')->group(function () {
    Route::controller(Api\Admin\SubmissionController::class)->prefix('admin')->middleware('jwt.verify')->group(function () {
        Route::get('submission/', 'index');
        Route::post('submission/', 'store');
        Route::get('submission/{rekrutPengajuan}', 'show');
        Route::put('submission/{rekrutPengajuan}', 'update');
    });

    Route::prefix('client')->group(function () {
        Route::get('/submission', 'Api\Client\SubmissionController@index');

        Route::prefix('master')->group(function () {
            Route::get('getRank', 'Api\Client\GetRankController@index');
            Route::get('getDept', 'Api\Client\GetDepartementController@index');
            Route::get('getLoc', 'Api\Client\GetLocationController@index');
        });
    });
});

