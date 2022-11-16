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

Route::prefix('pim')->middleware('jwt.verify')->group( function () {
    // firstScreen
    Route::controller(Api\EmployeeController::class)->prefix('daftarkanKaryawan')->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{emp_id}', 'show');
        Route::put('/{emp_id}', 'update');
    });

    // secondScreen
    Route::controller(Api\FamilyController::class)->prefix('anggotaKeluarga')->group(function () {
        Route::get('/{emp_id}', 'show');
        Route::post('/', 'store');
        Route::put('/{hrkel_oid}', 'update');
    });
    Route::controller(Api\OrganizationController::class)->prefix('organisasi')->group(function () {
        Route::get('/{emp_id}', 'show');
        Route::post('/', 'store');
        Route::put('/{hrorg_oid}', 'update');
    });
    Route::controller(Api\AchievmentController::class)->prefix('prestasi')->group(function () {
        Route::get('/{emp_id}', 'show');
        Route::post('/', 'store');
        Route::put('/{hrpres_oid}', 'update');
    });
    

});
