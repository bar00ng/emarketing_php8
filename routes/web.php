<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('admin.master');
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
});

// Route USER
Route::prefix('user')->group(function() {
    Route::get('/', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
});
