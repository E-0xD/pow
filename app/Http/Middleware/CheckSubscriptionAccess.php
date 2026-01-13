<?php

namespace App\Http\Middleware;

use App\Services\SubscriptionService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscriptionAccess
{
    protected $subscriptionService;

    public function __construct()
    {
        $this->subscriptionService = new SubscriptionService();
    }

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ?string $requiredFeature = null): Response
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        // If a specific feature is required, check access
        if ($requiredFeature) {
            if (!$this->subscriptionService->userHasFeature(Auth::user(), $requiredFeature)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Your current plan does not have access to this feature',
                    'feature' => $requiredFeature,
                    'current_tier' => $this->subscriptionService->getUserTierName(Auth::user()),
                ], 403);
            }
        }

        return $next($request);
    }
}
