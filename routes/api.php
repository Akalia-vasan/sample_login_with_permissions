<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PassportAuthController;
use App\Http\Controllers\API\RoleController;
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



Route::post('register', [PassportAuthController::class, 'register'])->name('api.register');
Route::post('login', [PassportAuthController::class, 'login'])->name('api.login');
Route::post('logout', [PassportAuthController::class, 'logout'])->name('api.logout');

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('logout', [PassportAuthController::class, 'logout'])->name('api.logout');

    // Role
    Route::group(['prefix' => 'role'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('api.role.index');
    });
});
