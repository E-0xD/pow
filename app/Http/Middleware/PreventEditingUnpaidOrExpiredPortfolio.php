<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;

class PreventEditingUnpaidOrExpiredPortfolio
{
    public function handle(Request $request, Closure $next)
    {
        $portfolio = $request->route('portfolio') ?? $request->get('portfolio');

        if (!$portfolio) {
            return $next($request);
        }

        $user = Auth::user();
        // Admins may bypass
        if ($user && $user->role === UserRole::ADMIN) {
            return $next($request);
        }

        // Block editing if there is no active (paid & not expired) subscription
        $active = $portfolio->activeSubscription ?? null;

        if (!$active) {
            abort(403, 'Portfolio cannot be edited while unpaid or expired.');
        }

        return $next($request);
    }
}
