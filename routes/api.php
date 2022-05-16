<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PassportAuthController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\EmployeeController;
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
        Route::post('/create', [RoleController::class, 'store'])->name('api.role.store');
        Route::group(['prefix' => '{role}'], function () {
            Route::post('/edit', [RoleController::class, 'update'])->name('api.role.update');
            Route::delete('/delete', [RoleController::class, 'destory'])->name('api.role.destory');
        });
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index'])->name('api.user.index');
        Route::post('/create', [UserController::class, 'store'])->name('api.user.store');
        Route::group(['prefix' => '{user}'], function () {
            Route::get('/show', [UserController::class, 'show'])->name('api.user.show');
            Route::post('/edit', [UserController::class, 'update'])->name('api.user.update');
            Route::delete('/delete', [UserController::class, 'destory'])->name('api.user.destory');
        });
    });

    Route::group(['prefix' => 'company'], function () {
        Route::get('/', [CompanyController::class, 'index'])->name('api.company.index');
        Route::post('/create', [CompanyController::class, 'store'])->name('api.company.store');
        Route::group(['prefix' => '{company}'], function () {
            Route::get('/show', [CompanyController::class, 'show'])->name('api.company.show');
            Route::post('/edit', [CompanyController::class, 'update'])->name('api.company.update');
            Route::delete('/delete', [CompanyController::class, 'destroy'])->name('api.company.destory');
        });
    });
    Route::group(['prefix' => 'employee'], function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('api.employee.index');
        Route::post('/create', [EmployeeController::class, 'store'])->name('api.employee.store');
        Route::group(['prefix' => '{employee}'], function () {
            Route::get('/show', [EmployeeController::class, 'show'])->name('api.employee.show');
            Route::post('/edit', [EmployeeController::class, 'update'])->name('api.employee.update');
            Route::delete('/delete', [EmployeeController::class, 'destroy'])->name('api.employee.destory');
        });
    });

});
