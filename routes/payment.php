<?php

use App\Http\Controllers\Payment\Processors\PaystackController;
use App\Http\Controllers\Payment\Validation\NowPaymentValidationController;
use App\Livewire\Payment\PaymentRouter;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('checkout/{portfolio}', PaymentRouter::class)->name('payment.checkout');

    Route::get('nowpayment/validate', NowPaymentValidationController::class)->name('nowpayment.validate');

    // Route::post('/paystack/process', [PaystackSubscriptionController::class, 'process']);
    Route::get('paystack/validate', [PaystackController::class, 'validate'])->name('paystack.validate');
});
