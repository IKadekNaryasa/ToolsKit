<?php

use App\Http\Controllers\admin\BorrowingController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\Dashboard;
use App\Http\Controllers\admin\InventoryController;
use App\Http\Controllers\admin\MaintenanceController;
use App\Http\Controllers\admin\RepairController;
use App\Http\Controllers\admin\RequestController;
use App\Http\Controllers\admin\ReturnController;
use App\Http\Controllers\admin\ToolController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\HeadDivision;
use App\Http\Middleware\IknAuth;
use App\Http\Middleware\Technician;
use Illuminate\Support\Facades\Route;

// guest
Route::get('/', function () {
    return view('auth.login');
})->name('login');
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/auth', [AuthController::class, 'auth'])->name('auth.auth');

// default auth
Route::middleware(['auth'])->group(function () {});

// custom auth (iknAuth)
Route::middleware([IknAuth::class])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');


    // admin
    Route::middleware([Admin::class])->group(function () {
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/', [Dashboard::class, 'index'])->name('dashboard.index');
            Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard.index');

            Route::resource('category', CategoryController::class)->except('show');
            Route::resource('inventory', InventoryController::class)->except('show');
            Route::resource('tool', ToolController::class)->except('show');
            Route::resource('request', RequestController::class)->except('show');
            Route::resource('borrowing', BorrowingController::class)->except('show');
            Route::resource('return', ReturnController::class)->except('show');
            Route::resource('repair', RepairController::class)->except('show');
            Route::resource('maintenance', MaintenanceController::class)->except('show');
            Route::resource('user', UserController::class)->except('show');
        });
    });

    // technician
    Route::middleware([Technician::class])->group(function () {
        //
    });


    // head division
    Route::middleware([HeadDivision::class])->group(function () {
        //
    });
});
