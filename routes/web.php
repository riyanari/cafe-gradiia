<?php

use App\Http\Controllers\AdminCafe\AdminCafeController;
use App\Http\Controllers\AdminCafe\CashierCafeController;
use App\Http\Controllers\AdminCafe\OwnerCafeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Myu\OwnerMyuController;
use App\Http\Controllers\User\CafeController;
use App\Http\Controllers\User\MenuController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('User/Pages/Home/home');
});

Route::get('/superadmin', function () {
    return view('Admin/Pages/CafeMyU/dashboard');
});

Route::middleware('guest')->group(function () {
    Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');         // tampilkan form login
    Route::post('/login-proses', [AuthController::class, 'login'])->name('login-proses');     // proses login
});

/* ---------- Dashboards per-role ---------- */
Route::middleware(['auth', 'role:superadmin'])
    ->prefix('owner')->name('owner.')->group(function () {
        Route::get('/dashboard', [OwnerMyuController::class, 'index'])->name('dashboard');
    });




Route::middleware(['auth', 'role:owner_cafe'])->prefix('cafe-owner')->name('cafe-owner.')->group(function () {
    Route::get('/dashboard', [OwnerCafeController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'role:admin_cafe'])->prefix('cafe-admin')->name('cafe-admin.')->group(function () {
    Route::get('/dashboard', [AdminCafeController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'role:cashier_cafe'])->prefix('cashier')->name('cashier.')->group(function () {
    Route::get('/dashboard', [CashierCafeController::class, 'index'])->name('dashboard');
});

// Logout (auth only)
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Route::get('/cafes', [CafeController::class, 'index'])->name('cafes.index');
// Route::get('/{cafe:slug}', [CafeController::class, 'detail'])->name('detail');

Route::prefix('cafe')->name('cafe.')->group(function () {
    // /cafe
    Route::get('/', [CafeController::class, 'index'])->name('index');

    // /cafe/menu/...
    Route::prefix('menu')->name('menu.')->group(function () {
        Route::get('{menu}/customize', [MenuController::class, 'customize'])->name('customize');
        Route::post('{menu}/add-to-cart', [MenuController::class, 'addToCart'])->name('add-to-cart');
    });

    // /cafe/keranjang (HALAMAN BARU)
    Route::get('keranjang', function () {
        // --> buat file: resources/views/User/Pages/Cafes/Detail/cart.blade.php
        return view('User.Pages.Cafes.Detail.cart');
    })->name('cart');

    // (opsional) /cafe/checkout
    Route::get('checkout', function () {
        // --> buat file kalau butuh: resources/views/User/Pages/Cafes/Detail/checkout.blade.php
        return view('User.Pages.Cafes.Detail.checkout');
    })->name('checkout');

    // Paling akhir agar tidak "memakan" path lain
    Route::get('{cafe:slug}', [CafeController::class, 'detail'])->name('detail');
});
