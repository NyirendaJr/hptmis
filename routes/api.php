<?php

use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\RolePermissionController;
use App\Http\Controllers\API\SyncPermissionController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\UserPermissionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportHealthFacilityController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\RegionDistrictsController;
use App\Http\Controllers\API\PatientController;
use App\Http\Controllers\API\PermissionController;


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

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
    return $request->user();
});

//Route::post('import-health-facilities', ImportHealthFacilityController::class);

Route::group(['middleware' => 'auth:sanctum'], function() {

    Route::get('regions', [RegionController::class, 'index']);
    Route::get('districts', [DistrictController::class, 'index']);
    Route::get('region-districts/{regionId}', [RegionDistrictsController::class, 'index']);

    Route::group(['prefix' => 'patients'], function() {
        Route::post('register', [PatientController::class, 'store']);
        Route::get('all', [PatientController::class, 'index']);
    });

    Route::group(['prefix' => 'admin'], function() {
        Route::get('permissions', [PermissionController::class, 'index']);
        Route::get('sync-permissions', [SyncPermissionController::class, 'update']);
        Route::get('roles', [RoleController::class, 'index']);
        Route::get('roles/{role}/permissions', [RolePermissionController::class, 'index']);
        Route::put('roles/{role}', [RolePermissionController::class, 'update']);
        Route::post('users', [UserController::class, 'index']);
        Route::post('users', [UserController::class, 'store']);
        Route::get('users/{user}/permissions', [UserPermissionsController::class, 'index']);
        Route::put('users/{user}/permissions', [UserPermissionsController::class, 'update']);
    });
});
