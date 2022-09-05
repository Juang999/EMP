<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api as Api;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [Api\UserController::class, 'login']);
Route::post('user/login', [Api\UserController::class, 'userLogin']);

Route::middleware('jwt.verify')->group( function () {
    Route::prefix('user')->group( function () {
        Route::get('profile', [Api\UserController::class, 'profile']);
        Route::post('logout', [Api\UserController::class, 'logout']);
    });

    Route::prefix('sejarahKontrak')->group( function () {
        Route::get('/', [Api\MasterHistoricalContractController::class, 'index']);
    });

    Route::prefix('anggotaKeluarga')->group( function () {
        Route::get('/', [Api\FamilyController::class, 'index']);
    });

    Route::prefix('sejarahPosisiJabatan')->group( function () {
        Route::get('/', [Api\JobHistoryController::class, 'index']);
    });

    Route::prefix('pendidikanFormal')->group( function () {
        Route::get('/', [Api\EducationController::class, 'index']);
    });


    Route::apiResources([
        'pangkat' => Api\PangkatController::class,
        'organisasi' => Api\OrganisasiController::class,
        'hrGol' => Api\HRGolController::class,
        'hrKotaUmk' => Api\HRKotaUmkController::class,
        'hubKel' => Api\HubunganKeluargaController::class
    ]);

    // singleRoute
    Route::get('entitas', Api\En::class);
    Route::get('area', [Api\CodeMasterController::class, 'getAreaId']);
    Route::get('gender', [Api\CodeMasterController::class, 'getGender']);
    Route::get('status', [Api\CodeMasterController::class, 'getStatusId']);
    Route::get('golDarah', [Api\CodeMasterController::class, 'getGolDarah']);
    Route::post('/daftarkanKaryawan', Api\PersonalInformationManagement::class);
});
