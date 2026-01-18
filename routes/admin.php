<?php

use App\Http\Controllers\Admin\AffiliateController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\MetricsController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\PortfolioSubscriptionController;
use App\Http\Controllers\Admin\TemplateController;
use App\Http\Controllers\Admin\TierController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::domain('admin.' . parse_url(config('app.url'), PHP_URL_HOST))->name('admin.')->middleware(['auth', 'ensure.admin', 'ensure.active'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/metrics', [MetricsController::class, 'index'])->name('metrics.index');


    Route::resource('template', TemplateController::class);
    Route::resource('user', UserController::class)->except(['edit']);
    Route::resource('coupon', CouponController::class);
    Route::resource('partner', PartnerController::class);
    Route::get('transaction', [TransactionController::class, 'index'])->name('transaction.index');
    Route::patch('transaction/{transaction}/status', [TransactionController::class, 'updateStatus'])->name('transaction.updateStatus');
    
    // Tier, Feature & Plan Management
    Route::resource('feature', FeatureController::class);
    Route::resource('tier', TierController::class);
    Route::resource('plan', PlanController::class);

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
