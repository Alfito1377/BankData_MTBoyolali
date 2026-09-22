<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FleetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BankDataController;
use App\Http\Controllers\KategoriMtController;


/*
|--------------------------------------------------------------------------
| Login
|--------------------------------------------------------------------------
*/

Route::get('/', [AuthController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login-proses', [AuthController::class, 'authenticate'])
    ->name('login.authenticate');


/*
|--------------------------------------------------------------------------
| Authenticated
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Manajemen User
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    // Logout
    Route::get('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // Bank Data
    Route::get('/bank-data', [FleetController::class, 'indexBankData'])
        ->name('bank-data.index');

    Route::post('/bank-data', [FleetController::class, 'storeBankData'])
        ->name('bank-data.store');
    Route::put('/bank-data/{id}', [FleetController::class, 'updateBankData'])->name('bank-data.update');
    Route::delete('/bank-data/{id}', [FleetController::class, 'destroyBankData'])->name('bank-data.destroy');

    // MT Afkir & Dispen
    Route::get('/mt-afkir', [FleetController::class, 'indexAfkir'])
        ->name('afkir.index');

    Route::post('/mt-afkir', [FleetController::class, 'storeAfkir'])
        ->name('afkir.store');
    Route::put('/mt-afkir/{id}', [FleetController::class, 'updateAfkir'])->name('afkir.update');
    Route::delete('/mt-afkir/{id}', [FleetController::class, 'destroyAfkir'])->name('afkir.destroy');

    // Kategori MT
    Route::get('/kategori-mt', [BankDataController::class, 'index'])->name('kategori.index');
    // Rute Master Data Transportir
    Route::get('/transportir', [FleetController::class, 'indexTransportir'])->name('transportir.index');
    Route::post('/transportir', [FleetController::class, 'storeTransportir'])->name('transportir.store');
    Route::delete('/transportir/{id}', [FleetController::class, 'destroyTransportir'])->name('transportir.destroy');
});
