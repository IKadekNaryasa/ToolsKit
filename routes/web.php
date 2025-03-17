<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\Dashboard;
use App\Http\Controllers\admin\InventoryController;
use App\Http\Controllers\admin\PeminjamanController;
use App\Http\Controllers\admin\PengembalianController;
use App\Http\Controllers\admin\PerawatanController;
use App\Http\Controllers\admin\PerbaikanController;
use App\Http\Controllers\admin\RequestController;
use App\Http\Controllers\admin\ToolController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
});

Route::get('/tes', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [Dashboard::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard.index');

    Route::resource('category', CategoryController::class)->except('show');
    Route::resource('inventory', InventoryController::class)->except('show');
    Route::resource('tool', ToolController::class)->except('show');
    Route::resource('request', RequestController::class)->except('show');
    Route::resource('peminjaman', PeminjamanController::class)->except('show');
    Route::resource('pengembalian', PengembalianController::class)->except('show');
    Route::resource('perbaikan', PerbaikanController::class)->except('show');
    Route::resource('perawatan', PerawatanController::class)->except('show');
});
