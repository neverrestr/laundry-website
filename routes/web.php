<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Перенаправляем главную страницу на список заказов
Route::get('/', fn() => redirect()->route('bills.index'))->name('home');

Route::middleware(['auth'])->group(function () {
    // Маршрут дашборда (чтобы Breeze не ломался после входа)
    Route::get('/dashboard', fn() => redirect()->route('bills.index'))->name('dashboard');

    // Наши основные фичи (CRUD)
    Route::resource('customers', CustomerController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('bills', BillController::class)->except(['edit', 'update']);
    Route::post('bills/{bill}/advance', [BillController::class, 'advance'])->name('bills.advance');

    // Маршруты профиля (которые мы случайно удалили)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';