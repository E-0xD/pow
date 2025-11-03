<?php

namespace App\Http\Middleware;

use App\Models\Portfolio;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreventViewingExpiredPortfolio
{
  public function handle(Request $request, Closure $next)
{

    // Fetch portfolio by subdomain
    $portfolio = Portfolio::where('slug', $request->portfolio_slug)->first();

    if (!$portfolio) {
        abort(404, 'Portfolio not found');
    }

    if (!$portfolio->activeSubscription) {
        abort(404);
    }


    return $next($request);
}

}
