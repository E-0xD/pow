<?php

use App\Http\Controllers\Admin\PortfolioController;
use Illuminate\Support\Facades\Route;
// 
Route::domain('admin.localhost')->name('admin.')->group(function () {
    Route::resource('portfolio', PortfolioController::class);
});
