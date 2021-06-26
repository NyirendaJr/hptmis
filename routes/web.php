<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/calendar', function () {
    return Inertia::render('Calendar');
})->name('calendar');

Route::middleware(['auth:sanctum', 'verified'])->get('/kanboard', function () {
    return Inertia::render('task/KanBoard');
})->name('kanboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/element/cascader', function () {
    return Inertia::render('element/Cascader');
})->name('element.cascader');

Route::middleware(['auth:sanctum', 'verified'])->get('/task/list', function () {
    return Inertia::render('task/TaskList');
})->name('task');

Route::middleware(['auth:sanctum', 'verified'])->get('/widgets/social', function () {
    return Inertia::render('widgets/Social');
})->name('widgets.social');

Route::middleware(['auth:sanctum', 'verified'])->get('/widgets/statistic', function () {
    return Inertia::render('widgets/Statistic');
})->name('widgets.statistic');

Route::middleware(['auth:sanctum', 'verified'])->get('/forms/basic', function () {
    return Inertia::render('form/BasicForm');
})->name('forms.basic');

Route::middleware(['auth:sanctum', 'verified'])->get('/forms/stepper', function () {
    return Inertia::render('form/Steppers');
})->name('forms.stepper');

// Route::middleware(['auth:sanctum', 'verified'])->get('/chart/echart', function () {
//     return Inertia::render('form/Steppers');
// })->name('echart');
//
// Route::middleware(['auth:sanctum', 'verified'])->get('/chart/g2', function () {
//     return Inertia::render('form/Steppers');
// })->name('g2');
