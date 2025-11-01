<?php

use App\Http\Controllers\Payment\PaymentValidationController;
use App\Livewire\Payment\PaymentRouter;
use Illuminate\Support\Facades\Route;

Route::get('checkout/{portfolio}', PaymentRouter::class)->name('payment.checkout');

// Route::get('checkout/validate', PaymentValidationController::class);