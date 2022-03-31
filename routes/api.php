<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\InformationController;

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

Route::post('auth/register', [UserController::class, 'register']);
Route::post('auth/login', [UserController::class, 'login']);

Route::group(['middleware' => ['jwt.verify']], function() {

    Route::post('auth/user',[UserController::class, 'getUser']);

    Route::apiResource('billings', BillingController::class);

    Route::apiResource('domains', DomainController::class);

    Route::apiResource('identities', \App\Http\Controllers\IdentityController::class);

    Route::apiResource('information', InformationController::class);
});
