<?php

namespace App\Http\Controllers\User;

use App\Enums\TemplateStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\PortfolioCreateRequest;
use App\Http\Requests\PortfolioUpdateRequest;
use App\Models\Portfolio;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Auth::user()
            ->portfolios()
            ->with('about')
            ->latest()
            ->paginate(10);

        return view('user.portfolio.index', compact('portfolios'));
    }

    public function create()
    {

        $templates = Template::where('status', TemplateStatus::PUBLISHED)->get();

        return view('user.portfolio.create', compact('templates'));
    }

    public function store(PortfolioCreateRequest $request)
    {
        $data = $request->validated();

        $portfolio = Auth::user()->portfolios()->create($data);

        return redirect()->route('payment.checkout', $portfolio->uid)
            ->with([
                'type' => 'info',
                'message' => 'Select a Plan and start proving your work'
            ]);
    }

    public function show(Portfolio $portfolio)
    {
        return view('user.portfolio.show', compact('portfolio'));
    }

    public function edit(Portfolio $portfolio)
    {
        return view('user.portfolio.edit', compact('portfolio'));
    }

    public function update(PortfolioUpdateRequest $request, Portfolio $portfolio)
    {
        try {
            $data = $request->validated();

            // Handle favicon upload
            if ($request->hasFile('favicon')) {

                if ($portfolio->favicon) {
                    Storage::disk('public')->delete($portfolio->favicon);
                }
                $data['favicon'] = $request->file('favicon')->store('favicons', 'public');
            }

            $portfolio->update($data);

            return redirect()->route('user.portfolio.edit', $portfolio)
                ->with(
                    [
                        'type' => 'success',
                        'message' => 'Portfolio updated successfully!'
                    ]
                );
        } catch (\Exception $e) {
            Log::error($e);
            return back()
                ->withInput()
                ->with([
                    'type' => 'error',
                    'message' => 'Could not update portfolio, try again later!'
                ]);
        }
    }

    public function destroy(Portfolio $portfolio)
    {
        try {

            if ($portfolio->favicon) {
                Storage::disk('public')->delete($portfolio->favicon);
            }

            $portfolio->delete();

            return redirect()->route('user.portfolio.index')
                ->with(
                    [
                        'type' => 'success',
                        'message' => 'Portfolio deleted successfully.'
                    ]
                );
        } catch (\Throwable $th) {
            Log::error($th);
            return back()->with([
                'type' => 'error',
                'message' => 'Could not delete portfolio, try again later!'
            ]);
        }
    }

    public function customize(Portfolio $portfolio)
    {
        return view('user.portfolio.customize', compact('portfolio'));
    }

    public function analytics(Portfolio $portfolio)
    {
        $thirtyDaysAgo = now()->subDays(30);
        $sixtyDaysAgo = now()->subDays(60);

        // Current period stats
        $totalVisits = $portfolio->visits()
            ->where('created_at', '>=', $thirtyDaysAgo)
            ->count();

        $totalClicks = $portfolio->clicks()
            ->where('created_at', '>=', $thirtyDaysAgo)
            ->count();

        $totalMessages = $portfolio->messages()
            ->where('created_at', '>=', $thirtyDaysAgo)
            ->count();

        // Previous period stats for growth calculation
        $previousVisits = $portfolio->visits()
            ->whereBetween('created_at', [$sixtyDaysAgo, $thirtyDaysAgo])
            ->count();

        $previousClicks = $portfolio->clicks()
            ->whereBetween('created_at', [$sixtyDaysAgo, $thirtyDaysAgo])
            ->count();

        // Calculate growth rates for each metric
        $calculateGrowthRate = function ($current, $previous) {
            if ($previous === 0) {
                return $current > 0 ? 100 : 0;
            }
            return (($current - $previous) / $previous) * 100;
        };

        $visitsGrowthRate = $calculateGrowthRate($totalVisits, $previousVisits);
        $clicksGrowthRate = $calculateGrowthRate($totalClicks, $previousClicks);

        // Get previous period messages
        $previousMessages = $portfolio->messages()
            ->whereBetween('created_at', [$sixtyDaysAgo, $thirtyDaysAgo])
            ->count();
        $messagesGrowthRate = $calculateGrowthRate($totalMessages, $previousMessages);

        // Calculate total engagement and growth rate
        $currentEngagement = $totalVisits + $totalClicks;
        $previousEngagement = $previousVisits + $previousClicks;
        $engagementGrowthRate = $calculateGrowthRate($currentEngagement, $previousEngagement);

        // Get traffic sources with color mapping
        $trafficSources = $portfolio->trafficSources()
            ->where('date', '>=', $thirtyDaysAgo)
            ->selectRaw('source, SUM(visits_count) as total')
            ->groupBy('source')
            ->get();

        $colors = [
            'direct' => '#50E3C2',
            'google' => '#4A90E2',
            'facebook' => '#BD10E0',
            'twitter' => '#1DA1F2',
            'linkedin' => '#0077B5',
            'other' => '#FFC700'
        ];

        $stats = [
            'total_visits' => $totalVisits,
            'total_clicks' => $totalClicks,
            'total_messages' => $totalMessages,
            'visits_growth_rate' => $visitsGrowthRate,
            'clicks_growth_rate' => $clicksGrowthRate,
            'messages_growth_rate' => $messagesGrowthRate,
            'total_engagement' => $currentEngagement,
            'engagement_growth_rate' => $engagementGrowthRate,
            'traffic_sources' => $trafficSources->map(function ($source) use ($colors) {
                return [
                    'source' => $source->source,
                    'total' => $source->total,
                    'color' => $colors[$source->source] ?? $colors['other']
                ];
            }),
            'top_pages' => $portfolio->visits()
                ->where('created_at', '>=', $thirtyDaysAgo)
                ->selectRaw('page_url, COUNT(*) as views')
                ->groupBy('page_url')
                ->orderByDesc('views')
                ->limit(5)
                ->get(),
            'daily_engagement' => $portfolio->visits()
                ->where('created_at', '>=', $thirtyDaysAgo)
                ->selectRaw('DATE(created_at) as date, COUNT(*) as visits')
                ->groupBy('date')
                ->orderBy('date')
                ->get()
        ];

        return view('user.portfolio.analytics', [
            'stats' => $stats,
            'portfolio' => $portfolio,
            'colors' => $colors
        ]);
    }
}
