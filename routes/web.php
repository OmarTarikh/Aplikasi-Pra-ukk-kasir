<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\DetailPenjualanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;


// ✅ Correct Export Routes
Route::get('penjualan/export-pdf', [PenjualanController::class, 'exportPDF'])->name('penjualan.exportPDF');
Route::get('detailpenjualan/export-pdf', [DetailPenjualanController::class, 'exportPDF'])->name('detailpenjualan.exportPDF');

// ✅ Redirect root to login or dashboard
Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});

// ✅ Guest Routes (Only for users who are NOT logged in)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// ✅ Protected Routes (Only accessible when logged in)
Route::middleware(['auth'])->group(function () {
    // ✅ Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ✅ User Management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    // ✅ Resource Controllers
    Route::resource('detailpenjualan', DetailPenjualanController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('penjualan', PenjualanController::class);
    Route::resource('pelanggan', PelangganController::class);


    // ✅ API Route: Get Total Harga (Moved to Controller)
    Route::get('/get-total-harga/{penjualanID}', [DetailPenjualanController::class, 'getTotalHarga'])
        ->name('detailpenjualan.getTotalHarga');

    // ✅ Logout Route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
