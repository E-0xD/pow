<?php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidatePortfolioSubdomain
{
    public function handle(Request $request, Closure $next)
    {
        $subdomain = explode('.', $request->getHost())[0];
        
        // Check if subdomain is in restricted list
        if (in_array($subdomain, config('subdomains.restricted'))) {
            abort(404);
        }

        return $next($request);
    }
}