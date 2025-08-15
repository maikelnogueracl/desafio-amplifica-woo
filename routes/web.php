<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WooController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('web')->group(function () {
    Route::middleware('auth.session')->group(function () {
        Route::get('/', [WooController::class, 'dashboard']);
        Route::get('/products', [WooController::class, 'products']);
        Route::get('/orders', [WooController::class, 'orders']);
        Route::get('/export/products', [WooController::class, 'exportProducts']);
        Route::get('/export/orders', [WooController::class, 'exportOrders']);
    });
});
