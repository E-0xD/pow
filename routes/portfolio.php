<?php


use App\Http\Controllers\Portfolio\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::domain('{portfolio}.' . parse_url(config('app.url'), PHP_URL_HOST))
    ->middleware(['validate.portfolio.subdomain'])
    ->group(function(){
        Route::get('/', [PortfolioController::class, 'index']);
    });