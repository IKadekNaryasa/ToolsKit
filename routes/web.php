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
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('login');
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/auth', [AuthController::class, 'auth'])->name('auth.auth');

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
