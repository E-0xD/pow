<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;

class EnsurePortfolioOwner
{
    public function handle(Request $request, Closure $next)
    {
        $portfolio = $request->route('portfolio') ?? $request->get('portfolio');

        if (!$portfolio) {
            return $next($request);
        }

        $user = Auth::user();

        if (!$user) {
            abort(403);
        }

        // Allow owner or admin
        if ($portfolio->user_id != $user->id && $user->role != UserRole::ADMIN) {
            abort(403, 'You do not have permission to access this portfolio.');
        }

        return $next($request);
    }
}
