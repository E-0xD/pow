<?php

namespace App\Http\Middleware;

use App\Models\Portfolio;
use App\Models\PortfolioTrafficSource;
use App\Models\PortfolioVisit;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class TrackPortfolioAnalytics
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $portfolio = $this->getPortfolioFromRequest($request);

        if ($portfolio && !$this->isRateLimited($request, $portfolio)) {
            $this->trackVisit($request, $portfolio);
        }

        return $next($request);
    }

    protected function getPortfolioFromRequest(Request $request): ?Portfolio
    {
        $slug = explode('.', $request->getHost())[0];
        return Portfolio::where('slug', $slug)->first();
    }

    protected function isRateLimited(Request $request, Portfolio $portfolio): bool
    {
        $ip = $request->ip();
        $key = "visit_{$portfolio->id}_{$ip}";

        if (Cache::has($key)) {
            return true;
        }

        Cache::put($key, true, now()->addMinutes(5));
        return false;
    }

    protected function trackVisit(Request $request, Portfolio $portfolio): void
    {
        $trafficSource = $this->determineTrafficSource($request);

        // Record visit
        PortfolioVisit::create([
            'portfolio_id' => $portfolio->id,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'referer_url' => $request->headers->get('referer'),
            'page_url' => $request->path(),
            'traffic_source' => $trafficSource
        ]);

        // Update traffic source stats
        $trafficSource = PortfolioTrafficSource::firstOrCreate(
            [
                'portfolio_id' => $portfolio->id,
                'source' => $trafficSource,
                'date' => now()->toDateString()
            ],
            [
                'visits_count' => 0
            ]
        );

        $trafficSource->increment('visits_count');
    }

    protected function determineTrafficSource(Request $request): string
    {
        $referer = $request->headers->get('referer');

        if (!$referer) {
            return 'direct';
        }

        $host = parse_url($referer, PHP_URL_HOST);

        if (str_contains($host, 'google')) {
            return 'google';
        } elseif (str_contains($host, 'facebook')) {
            return 'facebook';
        } elseif (str_contains($host, 'twitter') || str_contains($host, 'x.com')) {
            return 'twitter';
        } elseif (str_contains($host, 'linkedin')) {
            return 'linkedin';
        }

        return 'other';
    }
}
