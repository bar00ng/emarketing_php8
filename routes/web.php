<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\OrderController;

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

    Route::get('/report-user', [ReportController::class, 'index'])->name('generate.report');

    Route::get('/report-barang', [ReportController::class, 'reportBarang'])->name('admin.barang.report');

    Route::get('/list-order', [AdminController::class, 'daftarOrder'])->name('admin.list.order');

    Route::get('/list-payment', [AdminController::class, 'daftarPayment'])->name('admin.list.payment');

    Route::patch('/update-order-state/{kd_pesanan}/{value}', [AdminController::class, 'updateOrder'])->name('order.update');

    Route::get('/report-order-admin', [ReportController::class, 'reportOrderAdmin'])->name('admin.order.report');

    Route::get('/report-payment', [ReportController::class, 'reportPayment'])->name('admin.payment.report');
});

// Route USER
Route::prefix('user')->group(function() {
    Route::get('/', [DashboardController::class, 'userDashboard'])->name('user.dashboard');

    Route::get('/detail-product/{barang_id}', [BarangController::class, 'detailBarang'])->name('user.detail.barang');

    Route::post('/add-to-cart/{barang_id}', [OrderController::class, 'addToCart'])->name('add.to.cart');

    Route::post('/order', [OrderController::class, 'orderAction'])->name('order.action');

    Route::get('/order', [OrderController::class, 'daftarOrder'])->name('order.list');

    Route::get('/form-order', [OrderController::class, 'formOrder'])->name('order.form');

    Route::delete('/delete-order/{order_id}', [OrderController::class, 'deleteOrder'])->name('order.delete');

    Route::post('/remove-from-cart/{barang_id}', [OrderController::class, 'removeFromCart'])->name('remove.from.cart');

    Route::get('/report-order', [ReportController::class, 'reportOrder'])->name('order.report');
});
