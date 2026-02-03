<?php

use App\Http\Controllers\ConfigController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Корневой маршрут с перенаправлением
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Группируем всё, что требует авторизации
Route::middleware(['auth', 'verified'])->group(function () {

    // Главная страница админки
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Ресурсы
    Route::resource('configs', ConfigController::class);
    Route::resource('subscriptions', \App\Http\Controllers\SubscriptionController::class);

    // Профиль
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/s/{token}', [App\Http\Controllers\ClientController::class, 'show'])->name('client.subscription');

require __DIR__.'/auth.php';
