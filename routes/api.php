<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api as Api;
use App\Http\Controllers\Temporary as Temporary;

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
    Route::prefix('daftarkanKaryawan')->group( function () {
        Route::get('/', [Api\EmployeeController::class, 'index']);
        Route::post('/', [Api\EmployeeController::class, 'store']);
        Route::get('/{emp_id}', [Api\EmployeeController::class, 'show']);
        Route::put('/{emp_id}', [Api\EmployeeController::class, 'update']);
    } );

    // secondScreen
    Route::prefix('anggotaKeluarga')->group( function () {
        Route::get('/{emp_id}', [Api\FamilyController::class, 'show']);
        Route::post('/', [Api\FamilyController::class, 'store']);
        Route::put('/{hrkel_oid}', [Api\FamilyController::class, 'update']);
    });
    Route::prefix('organisasi')->group( function () {
        Route::get('/{emp_id}', [Api\OrganizationController::class, 'show']);
        Route::post('/', [Api\OrganizationController::class, 'store']);
        Route::put('/{hrorg_iod}', [Api\OrganizationController::class, 'update']);
    });
    Route::prefix('prestasi')->group( function () {
        Route::get('/{emp_id}', [Api\AchievmentController::class, 'show']);
        Route::post('/', [Api\AchievmentController::class, 'store']);
        Route::put('/{hrpres_oid}', [Api\AchievmentController::class, 'update']);
    });
    Route::prefix('disease')->group( function () {
        Route::get('/{emp_id}', [Api\DiseaseController::class, 'show']);
        Route::post('/', [Api\DiseaseController::class, 'store']);
        Route::put('/{hrsakit_oid}', [Api\DiseaseController::class, 'update']);
    });
    Route::prefix('personality')->group( function () {
        Route::get('/{emp_id}', [Api\PersonalityController::class, 'show']);
        Route::post('/', [Api\PersonalityController::class, 'store']);
        Route::put('/{hr_presnlt_oid}', [Api\PersonalityController::class, 'update']);
    });
    Route::prefix('hobbies')->group( function () {
        Route::get('/{emp_id}', [Api\HobbiesController::class, 'show']);
        Route::post('/', [Api\HobbiesController::class, 'store']);
        Route::put('/{hr_hobbies_oid}', [Api\HobbiesController::class, 'update']);
    });

    // thirdScreen
    Route::prefix('pengalamanKerja')->group( function () {
        Route::get('/{emp_id}', [Api\ExperienceController::class, 'show']);
        Route::post('/', [Api\ExperienceController::class, 'store']);
        Route::put('/{oid}', [Api\ExperienceController::class, 'update']);
    });
    Route::prefix('pendidikanFormal')->group( function () {
        Route::get('/{emp_id}', [Api\FormalEducationController::class, 'show']);
        Route::post('/', [Api\FormalEducationController::class, 'store']);
        Route::put('/{oid}', [Api\FormalEducationController::class, 'update']);
    });
    Route::prefix('pendidikanNonFormal')->group( function () {
        Route::get('/{emp_id}', [Api\NonFormalEducationController::class, 'show']);
        Route::post('/', [Api\NonFormalEducationController::class, 'store']);
        Route::put('/{oid}', [Api\NonFormalEducationController::class, 'update']);
    });
    Route::prefix('keahlian')->group( function () {
        Route::get('/{emp_id}', [Api\SkillController::class, 'show']);
        Route::post('/', [Api\SkillController::class, 'store']);
        Route::put('/{oid}', [Api\SkillController::class, 'update']);
    });

    // fourthScreen
    Route::prefix('pangkat')->group( function () {
        Route::post('/', [Api\PangkatController::class, 'store']);
        Route::get('/{emp_id}', [Api\PangkatController::class, 'show']);
    });
    Route::prefix('sejarahKontrak')->group( function () {
        Route::get('/{emp_id}', [Api\MasterHistoricalContractController::class, 'show']);
        Route::post('/', [Api\MasterHistoricalContractController::class, 'store']);
        Route::put('/{oid}', [Api\MasterHistoricalContractController::class, 'update']);
    });
    Route::prefix('posisi')->group( function () {
        Route::get('/{emp_id}', [Api\JobHistoryController::class, 'show']);
        Route::post('/', [Api\JobHistoryController::class, 'store']);
        Route::put('/{oid}', [Api\JobHistoryController::class, 'update']);
    });
    Route::prefix('suratPeringatan')->group( function () {
        Route::get('/{emp_id}', [Api\WarningLetterController::class, 'show']);
        Route::post('/', [Api\WarningLetterController::class, 'store']);
        Route::put('/{oid}', [Api\WarningLetterController::class, 'update']);
    });


    // other
    Route::prefix('periode')->group( function () {
        Route::get('/', [Api\PeriodeController::class, 'index']);
        Route::post('/', [Api\PeriodeController::class, 'store']);
    });

    // masterRoute
    Route::get('hobby', [Api\CodeMasterController::class, 'getHobby']);
    Route::get('hrGol', [Api\CodeMasterController::class, 'getHrGol']);
    Route::get('/sp', [Api\CodeMasterController::class, 'getPeriode']);
    Route::get('area', [Api\CodeMasterController::class, 'getAreaId']);
    Route::get('tipeSP', [Api\CodeMasterController::class, 'getTypeSP']);
    Route::get('hubKel', [Api\CodeMasterController::class, 'getHubKel']);
    Route::get('status', [Api\CodeMasterController::class, 'getStatus']);
    Route::get('gender', [Api\CodeMasterController::class, 'getGender']);
    Route::get('entitas', [Api\CodeMasterController::class, 'getEntity']);
    Route::get('getMonth', [Api\CodeMasterController::class, 'getMonth']);
    Route::get('jabatan', [Api\CodeMasterController::class, 'getJabatan']);
    Route::get('hirarki', [Api\CodeMasterController::class, 'getHirarki']);
    Route::get('hrstatus', [Api\CodeMasterController::class, 'getStatusId']);
    Route::get('golDarah', [Api\CodeMasterController::class, 'getGolDarah']);
    Route::get('keahlian', [Api\CodeMasterController::class, 'getKeahlian']);
    Route::get('tipePosisi', [Api\CodeMasterController::class, 'getPosType']);
    Route::get('tkahli', [APi\CodeMasterController::class, 'getTingkatAhli']);
    Route::get('getPangkat', [Api\CodeMasterController::class, 'getPangkat']);
    Route::get('tipeSakit', [Api\CodeMasterController::class, 'getTipeSakit']);
    Route::get('hrKotaUmk', [Api\CodeMasterController::class, 'getHrKotaUmk']);
    Route::get('workGroup', [Api\CodeMasterController::class, 'getWorkGroup']);
    Route::get('karyawan', [Api\CodeMasterController::class, 'getAllKaryawan']);
    Route::get('pendidikan', [Api\CodeMasterController::class, 'getPendidikan']);
    Route::get('personality', [Api\CodeMasterController::class, 'getPersonality']);
    route::get('tipeKontrak', [Api\CodeMasterController::class, 'getTypeContract']);
    Route::get('statusMarital', [Api\CodeMasterController::class, 'getStatusMarital']);
    Route::get('tipePerusahaan', [Api\CodeMasterController::class, 'getStatusPerusahaan']);

    // updateCenterAPI
    Route::put('/{mode}/{emp_id}', Api\UpdateCenter::class);

    // codeMasterInput
    Route::post('inputCode', [Temporary\TemporaryInputController::class, 'inputCodeMaster']);
});
