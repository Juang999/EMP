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
    Route::controller(Api\DiseaseController::class)->prefix('disease')->group(function () {
        Route::get('/{emp_id}', 'show');
        Route::post('/', 'store');
        Route::put('/{hrSakit}', 'update');
    });
    Route::controller(Api\PersonalityController::class)->prefix('personality')->group(function () {
        Route::get('/{emp_id}', 'show');
        Route::post('/', 'store');
        Route::put('{hrKepribadian}', 'update');
    });
    Route::controller(Api\HobbiesController::class)->prefix('hobbies')->group(function () {
        Route::get('/{emp_id}', 'show');
        Route::post('/', 'store');
        Route::put('/{hrHobbies}', 'update');
    });

    // thirdScreen
    Route::controller(Api\ExperienceController::class)->prefix('pengalamanKerja')->group(function () {
        Route::get('/{emp_id}', 'show');
        Route::post('/', 'store');
        Route::put('/{hrPengalaman}', 'update');
    });
    Route::controller(Api\FormalEducationController::class)->prefix('pendidikanFormal')->group(function () {
        Route::get('/{emp_id}', 'show');
        Route::post('/', 'store');
        Route::put('/{hrPendidikan}', 'update');
    });
    Route::controller(Api\NonFormalEducationController::class)->prefix('pendidikanNonFormal')->group(function () {
        Route::get('/{emp_id}', 'show');
        Route::post('/', 'store');
        Route::put('/{hrPendidikanNon}', 'update');
    });
    Route::controller(Api\SkillController::class)->prefix('keahlian')->group(function () {
        Route::get('/{emp_id}', 'show');
        Route::post('/', 'store');
        Route::put('/{hrKeahlian}', 'update');
    });

    // fourthScreeen
    Route::controller(Api\RankController::class)->prefix('pangkat')->group(function () {
        Route::post('/', 'store');
        Route::get('/{emp_id}', 'show');
    });
    Route::controller(Api\ContractHistoryController::class)->prefix('sejarahKontrak')->group(function () {
        Route::get('/{emp_id}', 'show');
        Route::post('/', 'store');
        Route::put('/{hrKontrak}', 'update');
    });
    Route::controller(Api\PositionController::class)->prefix('posisi')->group(function () {
        Route::get('/{emp_id}', 'show');
        Route::post('/', 'store');
        Route::put('/{hrPosisi}', 'update');
    });
    Route::controller(Api\WarningLetterController::class)->prefix('suratPeringatan')->group(function () {
        Route::get('/{emp_id}', 'show');
        Route::post('/', 'store');
        Route::put('/{hrMasaSP}', 'update');
    });

    // organizationCompany
    Route::controller(Api\DirectorController::class)->prefix('direktur')->group(function () {
        Route::get('/', 'index');
        Route::post('/','store');
    });
    Route::controller(Api\DivisionController::class)->prefix('divisi') ->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::put('/{divOid}', 'update');
    });
    Route::controller(Api\DepartementController::class)->prefix('departemen')->group(function () {
        Route::post('/', 'store');
        Route::get('/', 'index');
        Route::put('/{dptOid}', 'update');
        Route::patch('delete-division-hierarchy/{dptOid}', 'deleteDivision');
    });
    Route::controller(Api\SectionController::class)->prefix('section')->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::put('/{sectOid}', 'update');
    });
    Route::controller(Api\SubSectionController::class)->prefix('sub-section')->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::put('/{ssectOid}', 'update');
        Route::patch('delete-division-hierarchy/{sectOid}', 'deleteDivision');
    });
    Route::controller(Api\UnitSubSectionController::class)->prefix('unit-sub-section')->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::put('/{usectOid}', 'update');
    });

    // getOrganization
    Route::get('get-organization', 'Api\GetOrganizationController@index');
});
