<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserStatus;

class EnsureUserIsActive
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->status != UserStatus::ACTIVE) {
            abort(403, 'Your account is disabled.');
        }

        return $next($request);
    }
}
