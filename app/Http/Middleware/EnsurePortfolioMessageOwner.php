<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;

class EnsurePortfolioMessageOwner
{
    public function handle(Request $request, Closure $next)
    {
        $message = $request->route('message') ?? $request->route('portfolioMessage') ?? $request->get('message');

        if (!$message) {
            return $next($request);
        }

        $user = Auth::user();
        if (!$user) {
            abort(403);
        }

        // Allow admin
        if ($user->role == UserRole::ADMIN) {
            return $next($request);
        }

        // Ensure the message belongs to a portfolio owned by the user
        if (!$message->portfolio || $message->portfolio->user_id !== $user->id) {
            abort(403, 'You do not have permission to view or edit this message.');
        }

        return $next($request);
    }
}
