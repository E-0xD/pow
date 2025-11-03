<?php

use App\Http\Controllers\Admin\MetricsController;
use App\Http\Controllers\Admin\PortfolioSubscriptionController;
use App\Http\Controllers\Admin\TemplateController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::domain('admin.' . parse_url(config('app.url'), PHP_URL_HOST))->name('admin.')->group(function () {
    Route::resource('template', TemplateController::class);
    Route::resource('user', UserController::class)->except(['edit']);
    Route::get('metrics', [MetricsController::class, 'index'])->name('metrics.index');
    
    // Portfolio Subscription Management
    Route::get('portfolio/{portfolio}/subscription/edit', [PortfolioSubscriptionController::class, 'edit'])
        ->name('portfolio.subscription.edit');
    Route::put('portfolio/{portfolio}/subscription', [PortfolioSubscriptionController::class, 'update'])
        ->name('portfolio.subscription.update');
});