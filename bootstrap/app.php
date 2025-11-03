<?php

use App\Http\Middleware\CaptureAffiliate;
use App\Http\Middleware\EnsureAdmin;
use App\Http\Middleware\EnsureAffiliate;
use App\Http\Middleware\EnsurePortfolioMessageOwner;
use App\Http\Middleware\EnsurePortfolioOwner;
use App\Http\Middleware\EnsureUserIsActive;
use App\Http\Middleware\PreventEditingUnpaidOrExpiredPortfolio;
use App\Http\Middleware\PreventViewingExpiredPortfolio;
use App\Http\Middleware\TrackPortfolioAnalytics;
use App\Http\Middleware\ValidatePortfolioSubdomain;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'validate.portfolio.subdomain' => ValidatePortfolioSubdomain::class,
            'track.portfolio.analytics' => TrackPortfolioAnalytics::class,
            'capture.affiliate' => CaptureAffiliate::class,
            'ensure.admin' => EnsureAdmin::class,
            'ensure.active' => EnsureUserIsActive::class,
            'portfolio.owner' => EnsurePortfolioOwner::class,
            'portfolio.editable' => PreventEditingUnpaidOrExpiredPortfolio::class,
            'portfolio.view_not_expired' => PreventViewingExpiredPortfolio::class,
            'message.owner' => EnsurePortfolioMessageOwner::class,
            'ensure.affiliate' => EnsureAffiliate::class,
        ]);
        $middleware->validateCsrfTokens(except: [
            'webhook/*',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
