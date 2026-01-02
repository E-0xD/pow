<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Payment\Webhooks\PaystackWebhookController;
use App\Http\Controllers\Payment\Webhooks\PolarWebhookController;
use Illuminate\Support\Facades\Route;


Route::prefix('webhook')->group(function () {
    Route::post('polar', PolarWebhookController::class);
    Route::post('paystack', PaystackWebhookController::class)->name('webhooks.paystack');
});

Route::get('auth/google/redirect', [GoogleController::class, 'initialize'])->name('auth.google.initialize');

Route::get('auth/google/callback', [GoogleController::class, 'callback'])->name('auth.google.callback');
