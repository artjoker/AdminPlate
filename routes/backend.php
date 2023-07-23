<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\Users\ClientsController;
use App\Http\Controllers\Backend\Users\PermissionsController;
use App\Http\Controllers\Backend\Users\RolesController;
use App\Http\Controllers\Backend\Users\UsersController;
use Illuminate\Support\Facades\Route;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/

Route::as('backend.')
    ->prefix(config('app.backend'))
    ->middleware(['setLocale'])
    ->group(function () {
        Route::get('/', [AuthController::class, 'showLoginForm'])->name('home');

        // Authentication routes...
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AuthController::class, 'login']);

        Route::middleware(['auth:admin'])->group(function () {
            Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::get('clearCache', [DashboardController::class, 'clearCache'])->name('clearCache');
            Route::any('logout', [AuthController::class, 'logout'])->name('logout');
            //switch language
            Route::get('locale/{locale}', [DashboardController::class, 'setLocale'])->name('setLanguage');
            // admin users
            Route::put('/users/restore/{user}', [UsersController::class, 'restore'])->name('users.restore');
            Route::resource('users', UsersController::class)
                ->parameter('', 'id')
                ->except('show');
            // admin clients
            Route::put('/clients/restore/{client}', [ClientsController::class, 'restore'])->name('clients.restore');
            Route::resource('clients', ClientsController::class);
            // admin roles
            Route::resource('roles', RolesController::class)->parameter('', 'role')->except('show');
            // admin permissions
            Route::get('permissions', [PermissionsController::class, 'index'])->name('permissions.index');
            // admin logs
            Route::get('logs', [LogViewerController::class, 'index']);
        });
    });
