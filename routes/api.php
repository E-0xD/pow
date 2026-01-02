<?php

use App\Http\Controllers\Api\PartnerController;
use App\Http\Controllers\Api\SandboxController;
use Illuminate\Support\Facades\Route;

// Partner API endpoints
Route::post('/partners/users', [PartnerController::class, 'createUser']);


Route::prefix('sandbox')->group(function () {
    // Sandbox endpoints
    Route::get('endpoints', [SandboxController::class, 'getEndpoints']);
    Route::post('test-create-user', [SandboxController::class, 'testCreateUser']);

    // API Sandbox
    Route::view('/', 'api-sandbox')->name('api.sandbox');
});

Route::view('documentation', 'api-documentation')->name('api.documentation');
