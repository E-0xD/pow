<?php

use App\Http\Controllers\Api\PartnerController;
use Illuminate\Support\Facades\Route;

Route::post('/partners/users', [PartnerController::class, 'createUser']);
