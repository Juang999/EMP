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
        Route::get('/{emp_id}', [Api\FamilyController::class, 'index']);
        Route::post('/', [Api\FamilyController::class, 'store']);
    });

    Route::prefix('sejarahPosisiJabatan')->group( function () {
        Route::get('/', [Api\JobHistoryController::class, 'index']);
    });

    Route::prefix('pendidikanFormal')->group( function () {
        Route::get('/', [Api\EducationController::class, 'index']);
    });

    Route::prefix('organisasi')->group( function () {
        Route::get('/{emp_id}', [Api\OrganizationController::class, 'index']);
        Route::post('/', [Api\OrganizationController::class, 'store']);
    });


    Route::apiResources([
        'pangkat' => Api\PangkatController::class,
        'organisasi' => Api\OrganisasiController::class,
        'hrGol' => Api\HRGolController::class,
        'hrKotaUmk' => Api\HRKotaUmkController::class,
        'hubKel' => Api\HubunganKeluargaController::class
    ]);

    // masterRoute
    Route::get('entitas', Api\En::class);
    Route::get('area', [Api\CodeMasterController::class, 'getAreaId']);
    Route::get('status', [Api\CodeMasterController::class, 'getStatus']);
    Route::get('gender', [Api\CodeMasterController::class, 'getGender']);
    Route::get('jabatan', [Api\CodeMasterController::class, 'getJabatan']);
    Route::get('hirarki', [Api\CodeMasterController::class, 'getHirarki']);
    Route::get('hrstatus', [Api\CodeMasterController::class, 'getStatusId']);
    Route::get('golDarah', [Api\CodeMasterController::class, 'getGolDarah']);
    Route::get('keahlian', [Api\CodeMasterController::class, 'getKeahlian']);
    Route::get('workGroup', [Api\CodeMasterController::class, 'getWorkGroup']);
    Route::get('karyawan', [Api\CodeMasterController::class, 'getAllKaryawan']);
    Route::get('pendidikan', [Api\CodeMasterController::class, 'getPendidikan']);
    Route::get('statusMarital', [Api\CodeMasterController::class, 'getStatusMarital']);

    // singleRoute
    // POST EMPLOYEE
    Route::post('daftarkanKaryawan', Api\PersonalInformationManagement::class);

});
