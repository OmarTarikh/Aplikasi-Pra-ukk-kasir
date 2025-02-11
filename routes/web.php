<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\DetailPenjualanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('auth');

// Redirect root to login or dashboard
Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});

// Guest Routes (Only for users who are NOT logged in)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Protected Routes (Only accessible when logged in)
Route::middleware(['auth'])->group(function () {
    Route::get('/pelanggan', function () {
        return view('pelanggan');
    })->name('dashboard');

    Route::resource('detailpenjualan', DetailPenjualanController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('penjualan', PenjualanController::class);
    Route::resource('pelanggan', PelangganController::class);

    Route::get('/detailpenjualan/export-pdf', [DetailPenjualanController::class, 'exportPdf'])->name('detailpenjualan.export-pdf');
    
    Route::get('/get-total-harga/{penjualanID}', function ($penjualanID) {
        $totalHarga = \App\Models\DetailPenjualan::where('PenjualanID', $penjualanID)->sum('Subtotal');
        return response()->json(['total_harga' => $totalHarga]);
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
});
