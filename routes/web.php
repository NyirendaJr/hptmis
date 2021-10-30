<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PatientSearchController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminiDashboardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::group(['middleware' => 'auth:sanctum'], function() {

    /* Patient Management */
    Route::group(['prefix' => 'patients'], function() {
        Route::get('patients', [PatientController::class, 'index'])
            ->name('patients.index');
        Route::get('register', [PatientController::class, 'create'])
            ->name('patients.create');
        Route::get('patients-search', [PatientSearchController::class, 'index'])
            ->name('patients-search.index');
    });


    /* Admin */
    Route::group(['prefix' => 'admin'], function() {
        Route::get('page-permissions', [PermissionController::class, 'index'])
            ->name('page-permissions.index');
        Route::get('admin-dashboard', [AdminiDashboardController::class, 'index'])
            ->name('admin-dashboard.index');
        Route::get('role-permissions', [RoleController::class, 'index'])
            ->name('role-permissions.index');
        Route::get('users', [UserController::class, 'index'])
            ->name('users.index');
        Route::get('users/{user}', [UserController::class, 'show'])
            ->name('users.show');
    });
});

