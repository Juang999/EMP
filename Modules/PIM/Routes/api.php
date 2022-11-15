<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Module\PIM\Http\Controllers\Api as Api;

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

});
