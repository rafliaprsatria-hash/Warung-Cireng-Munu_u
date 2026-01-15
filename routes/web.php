<?php

use App\Http\Controllers\CirengController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
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

// Public Order Route (for customers to order from menu)
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

// Halaman Dashboard Admin (Backend) - Protected
Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/', [CirengController::class, 'dashboard'])->name('dashboard');
    Route::get('/kelola', [CirengController::class, 'index'])->name('cireng.index');
    Route::post('/pembeli', [CirengController::class, 'store'])->name('pembeli.store');
    Route::put('/update/{id}', [CirengController::class, 'update'])->name('cireng.update');
    Route::delete('/hapus/{id}', [CirengController::class, 'destroy'])->name('cireng.destroy');
    
    // Order Routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
});