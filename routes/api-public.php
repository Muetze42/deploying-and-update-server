<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UpdateController;
use NormanHuth\HelpersLaravel\App\Http\Middleware\SanctumOptional;
use NormanHuth\LaravelApiController\Controller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(SanctumOptional::class)->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('activities', [Controller::class, 'index'])
        ->name('activities.index');
});

Route::get('update/{slug}/{platform}/download', [UpdateController::class, 'download'])
    ->name('update.download');
Route::get('update/{slug}/{platform}/{version}', [UpdateController::class, 'check'])
    ->name('update.check');
