<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangController;

Route::get('/', function () {
    return redirect()->route('user.dashboard');
});

// Route AUTH
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'loginAction'])->name('login.action');
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'registerAction'])->name('register.action');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route Dashboard
Route::get('/dashboard', [DashboardController::class, 'dashboardRedirect'])->name('dashboard');

// Route ADMIN
Route::prefix('admin')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');

    Route::get('/list-user', [AdminController::class, 'listUser'])->name('user.list');

    Route::get('/form-user/{user_id?}', [AdminController::class, 'formUser'])->name('form.user');

    Route::post('/form-user/{user_id?}', [AdminController::class, 'formUserAction'])->name('form.user.action');

    Route::delete('/delete-user/{user_id}', [AdminController::class, 'deleteUser'])->name('user.delete');

    Route::get('/list-barang', [BarangController::class, 'daftarBarang'])->name('barang.list');

    Route::get('/form-barang/{barang_id?}', [BarangController::class, 'formBarang'])->name('form.barang');

    Route::post('/form-barang/{barang_id?}', [BarangController::class, 'formBarangAction'])->name('form.barang.action');

    Route::delete('/delete-barang/{user_id}', [BarangController::class, 'deleteBarang'])->name('barang.delete');

    Route::patch('/update-status-barang/{barang_id}/{isActive}', [BarangController::class, 'updateStatusBarang'])->name('barang.update.status');

    Route::get('/generate-report', [ReportController::class, 'index'])->name('generate.report');
});

// Route USER
Route::prefix('user')->group(function() {
    Route::get('/', [DashboardController::class, 'userDashboard'])->name('user.dashboard');

    Route::get('/detail-product/{barang_id}', [BarangController::class, 'detailBarang'])->name('user.detail.barang');
});
