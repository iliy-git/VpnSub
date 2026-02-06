<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientManagerController;
use App\Http\Controllers\ClientSubscriptionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

// --- Публичные маршруты ---
Route::get('/', fn () => redirect()->route('dashboard'));

// Публичная ссылка на подписку (доступ по токену)
Route::get('/s/{token}', [ClientController::class, 'show'])->name('client.subscription');

// --- Маршруты с защитой (Auth) ---
Route::middleware(['auth'])->group(function () {
    Route::resource('clients', ClientManagerController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::post('clients/{client}/subscriptions/create', [ClientSubscriptionController::class, 'storeNew'])->name('clients.subscriptions.storeNew');
    Route::put('clients/{client}/subscriptions/{subscription}', [ClientSubscriptionController::class, 'update'])->name('clients.subscriptions.update');
    Route::delete('clients/{client}/subscriptions/{subscription}', [ClientSubscriptionController::class, 'destroy'])->name('clients.subscriptions.destroy');

    Route::post('subscriptions/{subscription}/configs', [SubscriptionController::class, 'addConfig'])->name('subscriptions.configs.store');
    Route::put('subscriptions/{subscription}/configs/{config}', [SubscriptionController::class, 'updateConfig'])->name('subscriptions.configs.update');
    Route::delete('subscriptions/{subscription}/configs/{config}', [SubscriptionController::class, 'removeConfig'])->name('subscriptions.configs.destroy');
});

require __DIR__.'/auth.php';
