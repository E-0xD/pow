<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserStatus;

class Waitlist
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (config('app.status') == 'waitlist' && $user && $user->status == UserStatus::WAITLIST) {
          return redirect(route('user.waitlist'));
        }

        return $next($request);
    }
}
