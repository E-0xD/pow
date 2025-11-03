<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Portfolio;
use App\Models\Transaction;
use App\Models\PortfolioVisit;
use App\Models\PortfolioMessage;
use App\Models\PortfolioSubscription;
use Carbon\Carbon;

class MetricsController extends Controller
{
    /**
     * Display metrics for the selected period.
     */
    public function index(Request $request)
    {
        $period = $request->query('period', 'monthly');

        $periodMap = [
            'daily' => 1,
            'weekly' => 7,
            'monthly' => 30,
            'quarterly' => 90,
            'biannual' => 182,
            'annually' => 365,
        ];

        $days = $periodMap[$period] ?? 30;

        // Consistent time boundaries for current period
        $now = Carbon::now();
        $start = Carbon::now()->subDays($days)->startOfDay();
        $end = $now->copy()->endOfDay();

        // Historical comparison window (previous period)
        $prevStart = Carbon::now()->subDays($days * 2)->startOfDay();
        $prevEnd = Carbon::now()->subDays($days)->endOfDay();

        // === TOTALS (All-time for context) ===
        $totalUsers = User::count();
        $totalPortfolios = Portfolio::count();
        $activePortfolios = Portfolio::whereHas('activeSubscription')->count();

        // === PERIOD-SPECIFIC METRICS ===
        
        // New users during the period
        $newUsers = User::whereBetween('created_at', [$start, $end])->count();
        $prevNewUsers = User::whereBetween('created_at', [$prevStart, $prevEnd])->count();

        // Revenue during the period (exclude affiliate payouts)
        $revenueCurrent = (float) Transaction::where('status', 'successful')
            ->whereBetween('created_at', [$start, $end])
            ->where('gateway', '!=', 'affiliate_payout')
            ->sum('amount');

        $revenuePrev = (float) Transaction::where('status', 'successful')
            ->whereBetween('created_at', [$prevStart, $prevEnd])
            ->where('gateway', '!=', 'affiliate_payout')
            ->sum('amount');

        $totalProfit = $revenueCurrent; // Profit for the current period

        // Revenue change percentage
        $revenueChange = 0;
        if ($revenuePrev > 0) {
            $revenueChange = (($revenueCurrent - $revenuePrev) / $revenuePrev) * 100;
        } elseif ($revenueCurrent > 0) {
            $revenueChange = 100;
        }

        // LTV: Average revenue per new user during the period
        $ltv = $newUsers > 0 ? ($revenueCurrent / $newUsers) : 0.0;
        $prevLtv = $prevNewUsers > 0 ? ($revenuePrev / $prevNewUsers) : 0.0;
        
        $ltvChange = 0;
        if ($prevLtv > 0) {
            $ltvChange = (($ltv - $prevLtv) / $prevLtv) * 100;
        } elseif ($ltv > 0) {
            $ltvChange = 100;
        }

        // Subscriptions during the period
        $subsCurrent = PortfolioSubscription::whereBetween('purchased_at', [$start, $end])->count();
        $subsPrev = PortfolioSubscription::whereBetween('purchased_at', [$prevStart, $prevEnd])->count();

        // Conversion rate: subscriptions / new signups during the period
        $conversionRate = $newUsers > 0 ? ($subsCurrent / $newUsers) * 100 : 0;
        $prevConversionRate = $prevNewUsers > 0 ? ($subsPrev / $prevNewUsers) * 100 : 0;
        
        $conversionChange = 0;
        if ($prevConversionRate > 0) {
            $conversionChange = (($conversionRate - $prevConversionRate) / $prevConversionRate) * 100;
        } elseif ($conversionRate > 0) {
            $conversionChange = 100;
        }

        // Churn: subscriptions that expired/cancelled during the period
        $churnCount = PortfolioSubscription::whereIn('status', ['cancelled', 'expired'])
            ->whereBetween('updated_at', [$start, $end])
            ->count();

        $totalSubscriptionsDuringPeriod = PortfolioSubscription::where('purchased_at', '<=', $end)->count();
        $churnRate = $totalSubscriptionsDuringPeriod > 0 ? ($churnCount / $totalSubscriptionsDuringPeriod) * 100 : 0;

        // Previous period churn
        $prevChurnCount = PortfolioSubscription::whereIn('status', ['cancelled', 'expired'])
            ->whereBetween('updated_at', [$prevStart, $prevEnd])
            ->count();
            
        $prevTotalSubscriptionsDuringPeriod = PortfolioSubscription::where('purchased_at', '<=', $prevEnd)->count();
        $prevChurnRate = $prevTotalSubscriptionsDuringPeriod > 0 ? ($prevChurnCount / $prevTotalSubscriptionsDuringPeriod) * 100 : 0;
        
        $churnChange = 0;
        if ($prevChurnRate > 0) {
            $churnChange = (($churnRate - $prevChurnRate) / $prevChurnRate) * 100;
        } elseif ($churnRate > 0) {
            $churnChange = 100;
        }

        // Engagement metrics during the period
        $visitsCount = PortfolioVisit::whereBetween('created_at', [$start, $end])->count();
        $avgViewsPerUser = $newUsers > 0 ? ($visitsCount / $newUsers) : 0;

        $messagesCount = PortfolioMessage::whereBetween('created_at', [$start, $end])->count();
        $portfoliosDuringPeriod = Portfolio::whereBetween('created_at', [$start, $end])->count();
        $avgMessagesPerPortfolio = $portfoliosDuringPeriod > 0 ? ($messagesCount / $portfoliosDuringPeriod) : 0;

        // Active portfolios purchased during the period
        $activePortfoliosThisMonth = Portfolio::whereHas('activeSubscription', function ($q) use ($start, $end) {
            $q->whereBetween('purchased_at', [$start, $end]);
        })->count();

        // === CHART DATA ===
        
        // Build labels (daily labels)
        $labels = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $labels[] = Carbon::now()->subDays($i)->format('Y-m-d');
        }

        // Aggregated data during the period
        $signups = User::selectRaw("DATE(created_at) as date, count(*) as cnt")
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('date')
            ->pluck('cnt', 'date')
            ->toArray();

        $revenue = Transaction::selectRaw("DATE(created_at) as date, coalesce(sum(amount),0) as sum")
            ->where('status', 'successful')
            ->whereBetween('created_at', [$start, $end])
            ->where('gateway', '!=', 'affiliate_payout')
            ->groupBy('date')
            ->pluck('sum', 'date')
            ->toArray();

        $affiliateConversions = Transaction::selectRaw("DATE(created_at) as date, count(*) as cnt")
            ->where('gateway', 'affiliate')
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('date')
            ->pluck('cnt', 'date')
            ->toArray();

        // Map data to labels
        $signupsData = [];
        $revenueData = [];
        $affiliateData = [];
        foreach ($labels as $date) {
            $signupsData[] = isset($signups[$date]) ? (int) $signups[$date] : 0;
            $revenueData[] = isset($revenue[$date]) ? (float) $revenue[$date] : 0.0;
            $affiliateData[] = isset($affiliateConversions[$date]) ? (int) $affiliateConversions[$date] : 0;
        }

        return view('admin.metrics.index', compact(
            'period',
            'labels',
            'signupsData',
            'revenueData',
            'affiliateData',
            'totalUsers',
            'newUsers',
            'activePortfolios',
            'totalProfit',
            'totalPortfolios',
            'ltv',
            'ltvChange',
            'churnRate',
            'churnChange',
            'conversionRate',
            'conversionChange',
            'avgViewsPerUser',
            'avgMessagesPerPortfolio',
            'activePortfoliosThisMonth',
            'revenueChange'
        ));
    }
}