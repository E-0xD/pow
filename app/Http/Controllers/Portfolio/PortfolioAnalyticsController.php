<?php

namespace App\Http\Controllers\Portfolio;

use App\Http\Controllers\Controller;
use App\Http\Requests\PortfolioAnalyticsRequest;
use App\Models\Portfolio;
use App\Models\PortfolioClick;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PortfolioAnalyticsController extends Controller
{
    public function trackClick(PortfolioAnalyticsRequest $request, $portfolio_slug)
    {
        $portfolio = Portfolio::where('slug', $portfolio_slug)->firstOrFail();

        // Rate limiting for clicks (1 click per second per IP per URL)
        $ip = $request->ip();
        $url = $request->input('clicked_url', '');
        $key = "click_{$portfolio->id}_{$ip}_{$url}";

        if (Cache::has($key)) {
            return response()->json(['status' => 'rate-limited']);
        }

        Cache::put($key, true, now()->addSecond());


        $validated = $request->validated();

        PortfolioClick::create([
            'portfolio_id' => $portfolio->id,
            'ip_address' => $ip,
            'element_type' => $validated['element_type'],
            'element_id' => $validated['element_id'],
            'page_url' => $validated['page_url'],
            'clicked_url' => $validated['clicked_url']
        ]);

        return response()->json(['status' => 'success']);
    }
}
