<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReleaseController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IpMiddleware;
use Illuminate\Support\Facades\Route;
use NormanHuth\LaravelApiController\NestedController;

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

Route::apiResources([
    'users' => UserController::class,
]);
Route::controller(UserController::class)
    ->name('users.')
    ->group(function () {
        Route::post('users/{user}/restore', 'restore')
            ->name('restore');
        Route::delete('users/{user}/force-delete', 'forceDelete')
            ->name('force-delete');
    });

/**
 * App.
 */
Route::apiResources([
    'apps' => AppController::class,
]);
Route::controller(AppController::class)
    ->name('apps.')
    ->group(function () {
        Route::post('apps/{app}/restore', 'restore')
            ->name('restore');
        Route::delete('apps/{app}/force-delete', 'forceDelete')
            ->name('force-delete');
    });

/**
 * Release.
 */
Route::resource('apps.releases', NestedController::class);
Route::post('apps/{app}/releases', [ReleaseController::class, 'draftRelease']);

/**
 * TAuthorization.
 */
Route::controller(AuthController::class)
    ->name('auth.')
    ->group(function () {
        Route::any('/logout', 'logout')
            ->name('logout');
        Route::post('login', [AuthController::class, 'login'])
            ->withoutMiddleware('auth:sanctum')
            ->name('login');
    });
