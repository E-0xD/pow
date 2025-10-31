<?php

namespace App\Http\Controllers\Portfolio;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioClick;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PortfolioAnalyticsController extends Controller
{
    public function trackClick(Request $request, $portfolio_slug)
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

        // Validate and store click data
        $validated = $request->validate([
            'element_type' => 'required|string|max:50',
            'element_id' => 'nullable|string|max:255',
            'page_url' => 'required|string|max:2048',
            'clicked_url' => 'nullable|string|max:2048'
        ]);

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
