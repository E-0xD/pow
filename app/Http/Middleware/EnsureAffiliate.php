<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Affiliate;

class EnsureAffiliate
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            abort(403);
        }

        // User must have an affiliate record
        if (!Affiliate::where('user_id', $user->id)->exists()) {
            abort(403, 'Affiliate access required.');
        }

        return $next($request);
    }
}
