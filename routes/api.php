<?php

use App\Http\Controllers\Payment\Webhooks\PolarWebhookController;
use Illuminate\Support\Facades\Route;


Route::prefix('webhook')->group(function () {
    Route::post('polar', PolarWebhookController::class);
});
