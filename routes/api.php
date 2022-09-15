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

    // firstScreen
    Route::post('daftarkanKaryawan', Api\PersonalInformationManagement::class);

    // secondScreen
    Route::prefix('anggotaKeluarga')->group( function () {
        Route::get('/{emp_id}', [Api\FamilyController::class, 'index']);
        Route::post('/', [Api\FamilyController::class, 'store']);
    });
    Route::prefix('organisasi')->group( function () {
        Route::get('/{emp_id}', [Api\OrganizationController::class, 'index']);
        Route::post('/', [Api\OrganizationController::class, 'store']);
    });
    Route::prefix('prestasi')->group( function () {
        Route::get('/{emp_id}', [Api\AchievmentController::class, 'index']);
        Route::post('/', [Api\AchievmentController::class, 'store']);
    });
    Route::prefix('disease')->group( function () {
        Route::get('/{emp_id}', [Api\DiseaseController::class, 'index']);
        Route::post('/', [Api\DiseaseController::class, 'store']);
    });

    // thirdScreen
    Route::prefix('pengalamanKerja')->group( function () {
        Route::get('/{emp_id}', [Api\ExperienceController::class, 'index']);
        Route::post('/', [Api\ExperienceController::class, 'store']);
    });
    Route::prefix('pendidikanFormal')->group( function () {
        Route::get('/{emp_id}', [Api\FormalEducationController::class, 'index']);
        Route::post('/', [Api\FormalEducationController::class, 'store']);
    });
    Route::prefix('pendidikanNonFormal')->group( function () {
        Route::get('/{emp_id}', [Api\NonFormalEducationController::class, 'index']);
        Route::post('/', [Api\NonFormalEducationController::class, 'store']);
    });
    Route::prefix('keahlian')->group( function () {
        Route::get('/{emp_id}', [Api\SkillController::class, 'index']);
        Route::post('/', [Api\SkillController::class, 'store']);
    });

    // fourthScreen
    Route::prefix('pangkat')->group( function () {
        Route::get('/{emp_id}', [Api\PangkatController::class, 'index']);
        Route::post('/', [Api\PangkatController::class, 'store']);
    });
    Route::prefix('sejarahKontrak')->group( function () {
        Route::get('/{emp_id}', [Api\MasterHistoricalContractController::class, 'index']);
        Route::post('/', [Api\MasterHistoricalContractController::class, 'store']);
    });
    Route::prefix('posisi')->group( function () {
        Route::get('/{emp_id}', [Api\JobHistoryController::class, 'index']);
        Route::post('/', [Api\JobHistoryController::class, 'store']);
    });
    Route::prefix('suratPeringatan')->group( function () {
        Route::get('/{emp_id}', [Api\WarningLetterController::class, 'index']);
        Route::post('/', [Api\WarningLetterController::class, 'store']);
    });


    // otther
    Route::prefix('periode')->group( function () {
        Route::get('/', [Api\PeriodeController::class, 'index']);
        Route::post('/', [Api\PeriodeController::class, 'store']);
    });

    // masterRoute
    Route::get('entitas', Api\En::class);
    Route::get('hrGol', [Api\CodeMasterController::class, 'getHrGol']);
    Route::get('/sp', [Api\CodeMasterController::class, 'getPeriode']);
    Route::get('area', [Api\CodeMasterController::class, 'getAreaId']);
    Route::get('hubKel', [Api\CodeMasterController::class, 'getHubKel']);
    Route::get('status', [Api\CodeMasterController::class, 'getStatus']);
    Route::get('gender', [Api\CodeMasterController::class, 'getGender']);
    Route::get('getMonth', [Api\CodeMasterController::class, 'getMonth']);
    Route::get('jabatan', [Api\CodeMasterController::class, 'getJabatan']);
    Route::get('hirarki', [Api\CodeMasterController::class, 'getHirarki']);
    Route::get('hrstatus', [Api\CodeMasterController::class, 'getStatusId']);
    Route::get('golDarah', [Api\CodeMasterController::class, 'getGolDarah']);
    Route::get('keahlian', [Api\CodeMasterController::class, 'getKeahlian']);
    Route::get('getPangkat', [Api\CodeMasterController::class, 'getPangkat']);
    Route::get('hrKotaUmk', [Api\CodeMasterController::class, 'getHrKotaUmk']);
    Route::get('workGroup', [Api\CodeMasterController::class, 'getWorkGroup']);
    Route::get('karyawan', [Api\CodeMasterController::class, 'getAllKaryawan']);
    Route::get('pendidikan', [Api\CodeMasterController::class, 'getPendidikan']);
    Route::get('statusMarital', [Api\CodeMasterController::class, 'getStatusMarital']);
});
