<?php

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\PortfolioController;
use App\Livewire\Portfolio\Builder\PortfolioBuilder;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::resource('portfolio', PortfolioController::class);
    Route::get('portfolio/{portfolio}/customize', PortfolioBuilder::class)->name('portfolio.customize');
});