<?php

use App\Http\Controllers\User\CafeController;
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

// Route::get('/cafes', [CafeController::class, 'index'])->name('cafes.index');
// Route::get('/{cafe:slug}', [CafeController::class, 'detail'])->name('detail');

Route::prefix('cafe')->name('cafe.')->group(function () {
    // /cafe
    Route::get('/', [CafeController::class, 'index'])->name('index');

    // /cafe/{slug}
    Route::get('{cafe:slug}', [CafeController::class, 'detail'])->name('detail');
});