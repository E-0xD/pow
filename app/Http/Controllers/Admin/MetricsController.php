<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\MetricsService;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Portfolio;
use App\Models\Transaction;
use App\Models\PortfolioVisit;
use App\Models\PortfolioMessage;
use App\Models\UserSubscription;
use App\Models\UserDailyActivity;
use Carbon\Carbon;

class MetricsController extends Controller
{
    protected MetricsService $metricsService;

    public function __construct(MetricsService $metricsService)
    {
        $this->metricsService = $metricsService;
    }

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

        // === USER METRICS ===
        $totalUsers = $this->metricsService->getTotalUsers();
        $newUsers = $this->metricsService->getNewUsers($start, $end);
        $prevNewUsers = $this->metricsService->getNewUsers($prevStart, $prevEnd);
        
        $dau = $this->metricsService->getDAU();
        $wau = $this->metricsService->getWAU();
        $mau = $this->metricsService->getMAU();

        // Growth rates
        $userGrowthRate = $this->metricsService->getUserGrowthRate($start, $end, $prevStart, $prevEnd);
        
        // Activation rate (portfolio creators)
        $activationRate = $this->metricsService->getActivationRate($start, $end);
        
        // === REVENUE METRICS ===
        $revenueCurrent = $this->metricsService->getTotalRevenue($start, $end);
        $revenuePrev = $this->metricsService->getTotalRevenue($prevStart, $prevEnd);
        $revenueGrowthRate = $this->metricsService->getRevenueGrowthRate($start, $end, $prevStart, $prevEnd);

        // MRR / ARR
        $mrr = $this->metricsService->getMRR();
        $arr = $this->metricsService->getARR();

        // ARPU
        $arpu = $this->metricsService->getARPU($start, $end);
        $prevArpu = $this->metricsService->getARPU($prevStart, $prevEnd);

        // === RETENTION & CHURN ===
        $retentionRate = $this->metricsService->getRetentionRate($start, $end, $prevStart, $prevEnd);
        $churnRate = $this->metricsService->getChurnRate($start, $end);
        $prevChurnRate = $this->metricsService->getChurnRate($prevStart, $prevEnd);

        // === CONVERSION RATES ===
        $portfolioConversionRate = $this->metricsService->getPortfolioConversionRate($start, $end);
        $subscriptionConversionRate = $this->metricsService->getSubscriptionConversionRate($start, $end);

        // === TIME TO VALUE ===
        $avgPortfolioTTV = $this->metricsService->getAveragePortfolioTTV($start, $end);
        $avgSubscriptionTTV = $this->metricsService->getAverageSubscriptionTTV($start, $end);

        // === CUSTOMER LIFETIME VALUE ===
        $topUsers = User::orderByDesc('created_at')->limit(100)->pluck('id');
        $avgLTV = 0;
        foreach ($topUsers as $userId) {
            $avgLTV += $this->metricsService->getCustomerLifetimeValue($userId);
        }
        $avgLTV = $topUsers->count() > 0 ? $avgLTV / $topUsers->count() : 0;

        // === COHORT RETENTION ===
        $cohortRetention = $this->metricsService->getCohortRetention($prevStart, $prevEnd, 30);

        // === PORTFOLIOS & ENGAGEMENT ===
        $totalPortfolios = Portfolio::count();
        $newPortfolios = Portfolio::whereBetween('created_at', [$start, $end])->count();
        
        $visitsCount = PortfolioVisit::whereBetween('created_at', [$start, $end])->count();
        $messagesCount = PortfolioMessage::whereBetween('created_at', [$start, $end])->count();

        // === GEOGRAPHIC DATA ===
        $usersByCountry = $this->metricsService->getUsersByCountry(10);
        $usersByCity = $this->metricsService->getUsersByCity(null, 10);
        $deviceBreakdown = $this->metricsService->getDeviceTypeBreakdown($start, $end);
        $topCountries = $this->metricsService->getTopCountries(5);

        // === CHART DATA ===
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

        $activeUsers = UserDailyActivity::selectRaw("date, count(distinct user_id) as cnt")
            ->whereBetween('date', [$start->toDateString(), $end->toDateString()])
            ->groupBy('date')
            ->pluck('cnt', 'date')
            ->toArray();

        // Map data to labels
        $signupsData = [];
        $revenueData = [];
        $activeUsersData = [];
        foreach ($labels as $date) {
            $signupsData[] = isset($signups[$date]) ? (int) $signups[$date] : 0;
            $revenueData[] = isset($revenue[$date]) ? (float) $revenue[$date] : 0.0;
            $activeUsersData[] = isset($activeUsers[$date]) ? (int) $activeUsers[$date] : 0;
        }

        return view('admin.metrics.index', compact(
            'period',
            'labels',
            'signupsData',
            'revenueData',
            'activeUsersData',
            // User metrics
            'totalUsers',
            'newUsers',
            'dau',
            'wau',
            'mau',
            'userGrowthRate',
            'activationRate',
            // Revenue metrics
            'revenueCurrent',
            'revenueGrowthRate',
            'mrr',
            'arr',
            'arpu',
            // Retention metrics
            'retentionRate',
            'churnRate',
            // Conversion rates
            'portfolioConversionRate',
            'subscriptionConversionRate',
            // Time to value
            'avgPortfolioTTV',
            'avgSubscriptionTTV',
            // Cohort & LTV
            'avgLTV',
            'cohortRetention',
            // Portfolio metrics
            'totalPortfolios',
            'newPortfolios',
            'visitsCount',
            'messagesCount',
            // Geographic data
            'usersByCountry',
            'usersByCity',
            'deviceBreakdown',
            'topCountries'
        ));
    }
}