<?php

use App\Http\Controllers\Admin\AffiliateController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\MetricsController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\PortfolioSubscriptionController;
use App\Http\Controllers\Admin\TemplateController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::domain('admin.' . parse_url(config('app.url'), PHP_URL_HOST))->name('admin.')->middleware(['auth', 'ensure.admin', 'ensure.active'])->group(function () {
    Route::get('/', [MetricsController::class, 'index'])->name('metrics.index');
    Route::get('/features', [\App\Http\Controllers\Admin\DashboardController::class, 'features'])->name('features.index');
    
    Route::resource('template', TemplateController::class);
    Route::resource('user', UserController::class)->except(['edit']);
    Route::resource('coupon', CouponController::class);
    Route::resource('partner', PartnerController::class);

    // Affiliate Management
    Route::resource('affiliate', AffiliateController::class)->except(['create', 'show', 'store']);
    Route::post('user/{user}/affiliate', [AffiliateController::class, 'store'])->name('affiliate.store');
    Route::post('affiliate/{affiliate}/payout', [AffiliateController::class, 'processPayout'])->name('affiliate.payout');
    
    // Portfolio Subscription Management
    Route::get('portfolio/{portfolio}/subscription/edit', [PortfolioSubscriptionController::class, 'edit'])
        ->name('portfolio.subscription.edit');
    Route::put('portfolio/{portfolio}/subscription', [PortfolioSubscriptionController::class, 'update'])
        ->name('portfolio.subscription.update');
});