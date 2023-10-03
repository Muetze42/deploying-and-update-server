<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReleaseController;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IpMiddleware;
use Illuminate\Support\Facades\Route;
use NormanHuth\HelpersLaravel\App\Http\Middleware\SanctumOptional;
use NormanHuth\LaravelApiController\Controller;
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


Route::middleware(SanctumOptional::class)->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('activities', [Controller::class, 'index'])
        ->name('activities.index');
});

Route::get('update/{slug}/{platform}/download', [UpdateController::class, 'download'])
    ->name('update.download');
Route::get('update/{slug}/{platform}/{version}', [UpdateController::class, 'check'])
    ->name('update.check');

Route::middleware(['auth:sanctum', IpMiddleware::class])->group(function () {
    /**
     * The authenticated User routes.
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
     * The authenticated App routes.
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
     * The authenticated Release routes.
     */
    Route::resource('apps.releases', NestedController::class);
    Route::post('apps/{app}/releases', [ReleaseController::class, 'draftRelease']);

    /**
     * The Authorization routes.
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
});
