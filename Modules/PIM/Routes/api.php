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
    Route::apiResource('daftarkanKaryawan', Api\EmployeeController::class)
        ->parameters(['daftarkanKaryawan' => 'emp_id'])
        ->except('destroy');

    Route::apiResources([
        'anggotaKeluarga' => Api\FamilyController::class
    ]);

});
