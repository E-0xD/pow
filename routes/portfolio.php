<?php


use App\Http\Controllers\Portfolio\PortfolioController;
use App\Http\Controllers\Portfolio\PortfolioAnalyticsController;
use Illuminate\Support\Facades\Route;

Route::domain('{portfolio_slug}.' . parse_url(config('app.url'), PHP_URL_HOST))
    ->middleware(['validate.portfolio.subdomain', 'track.portfolio.analytics'])
    ->group(function(){
        Route::get('/', [PortfolioController::class, 'index']);
        Route::post('/messages', [PortfolioController::class, 'storeMessage'])->name('portfolio.message.store');
        Route::post('/portfolio-analytics/track-click', [PortfolioAnalyticsController::class, 'trackClick']);
    });