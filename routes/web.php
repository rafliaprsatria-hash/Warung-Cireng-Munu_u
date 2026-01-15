<?php

use App\Http\Controllers\CirengController;
use App\Http\Controllers\AuthController;
use App\Models\Cireng;

// AUTH ROUTES
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Halaman utama (Landing Page)
Route::get('/', function () {
    $cirengs = Cireng::all();
    return view('landing', compact('cirengs'));
});

// Halaman Menu
Route::get('/menu', [CirengController::class, 'menu'])->name('menu');

// Halaman Dashboard Admin (Backend) - Protected
Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/', [CirengController::class, 'index'])->name('cireng.index');
    Route::post('/pembeli', [CirengController::class, 'store'])->name('pembeli.store');
    Route::put('/update/{id}', [CirengController::class, 'update'])->name('cireng.update');
    Route::delete('/hapus/{id}', [CirengController::class, 'destroy'])->name('cireng.destroy');
});