<?php

use App\Http\Controllers\Payment\Validation\NowPaymentValidationController;
use App\Http\Controllers\Payment\Webhooks\PaystackWebhookController;
use App\Livewire\Payment\PaymentRouter;
use App\Livewire\Subscription\SubscriptionPaymentRouter;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    // Account subscription payment routes
    Route::get('subscription', SubscriptionPaymentRouter::class)->name('subscription.checkout');

    Route::get('nowpayment/validate', NowPaymentValidationController::class)->name('nowpayment.validate');

});

// Webhook routes (no auth required)
Route::post('webhook/paystack', PaystackWebhookController::class)->name('paystack.webhook');
