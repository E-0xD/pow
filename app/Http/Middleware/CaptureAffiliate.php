<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Affiliate;
use Illuminate\Support\Facades\Log;

class CaptureAffiliate
{
    public function handle(Request $request, Closure $next)
    {
        $uid = $request->query('data');
       
        if ($uid) {
            // try to resolve affiliate by uid
            $affiliate = Affiliate::where('uid', $uid)->first();
            if ($affiliate) {
                // store in session and cookie for 30 days
                session(['affiliate_referrer' => $affiliate->uid]);
                cookie()->queue('affiliate_referrer', $affiliate->uid, 60 * 24 * 30);
            }
        }

        return $next($request);
    }
}
