<?php

namespace App\Services;

use App\Models\User;
use App\Models\Portfolio;
use App\Models\Transaction;
use App\Models\UserSubscription;
use App\Models\UserDailyActivity;
use App\Enums\UserSubscriptionStatus;
use App\Enums\TransactionStatus;
use Carbon\Carbon;

class MetricsService
{
    /**
     * Get total users
     */
    public function getTotalUsers(): int
    {
        return User::count();
    }

    /**
     * Get new users for a date range
     */
    public function getNewUsers($startDate, $endDate): int
    {
        return User::whereBetween('created_at', [$startDate, $endDate])->count();
    }

    /**
     * Get Daily Active Users (DAU)
     */
    public function getDAU($date = null): int
    {
        $date = $date ?? now()->toDateString();
        return UserDailyActivity::where('date', $date)->distinct('user_id')->count('user_id');
    }

    /**
     * Get Weekly Active Users (WAU)
     */
    public function getWAU($endDate = null): int
    {
        $endDate = $endDate ? Carbon::parse($endDate) : now();
        $startDate = $endDate->copy()->subDays(7);

        return UserDailyActivity::whereBetween('date', [$startDate->toDateString(), $endDate->toDateString()])
            ->distinct('user_id')
            ->count('user_id');
    }

    /**
     * Get Monthly Active Users (MAU)
     */
    public function getMAU($endDate = null): int
    {
        $endDate = $endDate ? Carbon::parse($endDate) : now();
        $startDate = $endDate->copy()->subDays(30);

        return UserDailyActivity::whereBetween('date', [$startDate->toDateString(), $endDate->toDateString()])
            ->distinct('user_id')
            ->count('user_id');
    }

    /**
     * Get user growth rate (% increase)
     */
    public function getUserGrowthRate($currentStart, $currentEnd, $prevStart, $prevEnd): float
    {
        $currentUsers = $this->getNewUsers($currentStart, $currentEnd);
        $prevUsers = $this->getNewUsers($prevStart, $prevEnd);

        if ($prevUsers <= 0) {
            return $currentUsers > 0 ? 100.0 : 0.0;
        }

        return (($currentUsers - $prevUsers) / $prevUsers) * 100;
    }

    /**
     * Get activation rate (% of users who created a portfolio)
     */
    public function getActivationRate($startDate, $endDate): float
    {
        $newUsers = $this->getNewUsers($startDate, $endDate);

        if ($newUsers <= 0) {
            return 0.0;
        }

        $portfolioCreators = Portfolio::whereBetween('created_at', [$startDate, $endDate])
            ->distinct('user_id')
            ->count('user_id');

        return $portfolioCreators > 0 ? ($portfolioCreators / $newUsers) * 100 : 0.0;
    }

    /**
     * Get Monthly Recurring Revenue (MRR)
     */
    public function getMRR(): float
    {
        return (float) UserSubscription::where('status', UserSubscriptionStatus::ACTIVE)
            ->whereHas('plan')
            ->get()
            ->sum(function ($sub) {
                $monthlyPrice = $sub->plan->price;
                // Adjust based on billing cycle
                return match ($sub->billing_cycle->value) {
                    'monthly' => $monthlyPrice,
                    'quarterly' => $monthlyPrice / 3,
                    'annually' => $monthlyPrice / 12,
                    'biannual' => $monthlyPrice / 6,
                    default => 0,
                };
            });
    }

    /**
     * Get Annual Recurring Revenue (ARR)
     */
    public function getARR(): float
    {
        return $this->getMRR() * 12;
    }

    /**
     * Get Average Revenue Per User (ARPU)
     */
    public function getARPU($startDate, $endDate): float
    {
        $totalUsers = $this->getNewUsers($startDate, $endDate);

        if ($totalUsers <= 0) {
            return 0.0;
        }

        $totalRevenue = $this->getTotalRevenue($startDate, $endDate);

        return $totalRevenue > 0 ? ($totalRevenue / $totalUsers) : 0.0;
    }

    /**
     * Get total revenue for a period
     */
    public function getTotalRevenue($startDate, $endDate): float
    {
        return (float) Transaction::where('status', TransactionStatus::SUCCESSFUL)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('gateway', '!=', 'affiliate_payout')
            ->sum('amount');
    }

    /**
     * Get revenue growth rate (% increase)
     */
    public function getRevenueGrowthRate($currentStart, $currentEnd, $prevStart, $prevEnd): float
    {
        $currentRevenue = $this->getTotalRevenue($currentStart, $currentEnd);
        $prevRevenue = $this->getTotalRevenue($prevStart, $prevEnd);

        if ($prevRevenue <= 0) {
            return $currentRevenue > 0 ? 100.0 : 0.0;
        }

        return (($currentRevenue - $prevRevenue) / $prevRevenue) * 100;
    }

    /**
     * Get retention rate (% of users who remain active)
     */
    public function getRetentionRate($startDate, $endDate, $cohortStartDate, $cohortEndDate): float
    {
        $cohortUsers = $this->getNewUsers($cohortStartDate, $cohortEndDate);

        if ($cohortUsers <= 0) {
            return 0.0;
        }

        $retainedUsers = UserDailyActivity::whereBetween('date', [$startDate, $endDate])
            ->whereIn('user_id', User::whereBetween('created_at', [$cohortStartDate, $cohortEndDate])->pluck('id'))
            ->distinct('user_id')
            ->count('user_id');

        return $retainedUsers > 0 ? ($retainedUsers / $cohortUsers) * 100 : 0.0;
    }

    /**
     * Get churn rate (% of users lost)
     */
    public function getChurnRate($startDate, $endDate): float
    {
        $cancelledSubscriptions = UserSubscription::whereIn('status', [UserSubscriptionStatus::CANCELLED, UserSubscriptionStatus::EXPIRED])
            ->whereBetween('updated_at', [$startDate, $endDate])
            ->count();

        $totalActiveSubscriptions = UserSubscription::where('purchased_at', '<=', $endDate)->count();

        if ($totalActiveSubscriptions <= 0) {
            return 0.0;
        }

        return $cancelledSubscriptions > 0 ? ($cancelledSubscriptions / $totalActiveSubscriptions) * 100 : 0.0;
    }

    /**
     * Get cohort retention analysis
     */
    public function getCohortRetention($cohortStartDate, $cohortEndDate, $lookbackDays = 30): array
    {
        $cohortUsers = User::whereBetween('created_at', [$cohortStartDate, $cohortEndDate])->pluck('id');

        $retention = [];
        $cohortCount = $cohortUsers->count();

        for ($day = 0; $day < $lookbackDays; $day++) {
            $date = Carbon::parse($cohortStartDate)->addDays($day)->toDateString();

            $retainedCount = UserDailyActivity::where('date', $date)
                ->whereIn('user_id', $cohortUsers)
                ->distinct('user_id')
                ->count('user_id');

            $retention[$date] = $cohortCount > 0 ? ($retainedCount / $cohortCount) * 100 : 0.0;
        }

        return $retention;
    }

    /**
     * Get customer lifetime value (CLV)
     */
    public function getCustomerLifetimeValue($userId): float
    {
        return (float) Transaction::where('user_id', $userId)
            ->where('status', TransactionStatus::SUCCESSFUL)
            ->sum('amount');
    }

    /**
     * Get conversion rate (signups to portfolio creators)
     */
    public function getPortfolioConversionRate($startDate, $endDate): float
    {
        $newUsers = $this->getNewUsers($startDate, $endDate);

        if ($newUsers <= 0) {
            return 0.0;
        }

        $portfolioCreators = Portfolio::whereBetween('created_at', [$startDate, $endDate])
            ->distinct('user_id')
            ->count('user_id');

        return $portfolioCreators > 0 ? ($portfolioCreators / $newUsers) * 100 : 0.0;
    }

    /**
     * Get subscription conversion rate (signups to subscribers)
     */
    public function getSubscriptionConversionRate($startDate, $endDate): float
    {
        $newUsers = $this->getNewUsers($startDate, $endDate);

        if ($newUsers <= 0) {
            return 0.0;
        }

        $subscribers = UserSubscription::whereBetween('purchased_at', [$startDate, $endDate])
            ->distinct('user_id')
            ->count('user_id');

        return $subscribers > 0 ? ($subscribers / $newUsers) * 100 : 0.0;
    }

    /**
     * Get time to value (days to first portfolio or subscription)
     */
    public function getTimeToValue($userId): ?array
    {
        $user = User::find($userId);

        if (!$user) {
            return null;
        }

        $portfolio = Portfolio::where('user_id', $userId)
            ->orderBy('created_at')
            ->first();

        $subscription = UserSubscription::where('user_id', $userId)
            ->orderBy('purchased_at')
            ->first();

        return [
            'portfolio_ttv' => $portfolio
                ? $user->created_at->diffInDays($portfolio->created_at)
                : null,

            'subscription_ttv' => $subscription
                ? $user->created_at->diffInDays($subscription->purchased_at)
                : null,
        ];
    }


    /**
     * Get average time to value for a cohort
     */
    public function getAveragePortfolioTTV($startDate, $endDate): float
    {
        $users = User::whereBetween('created_at', [$startDate, $endDate])->get();

        $total = 0;
        $count = 0;

        foreach ($users as $user) {
            $ttv = $this->getTimeToValue($user->id);

            if ($ttv && $ttv['portfolio_ttv'] !== null) {
                $total += $ttv['portfolio_ttv'];
                $count++;
            }
        }

        return $count > 0 ? round($total / $count, 2) : 0.0;
    }

    public function getAverageSubscriptionTTV($startDate, $endDate): float
    {
        $users = User::whereBetween('created_at', [$startDate, $endDate])->get();

        $total = 0;
        $count = 0;

        foreach ($users as $user) {
            $ttv = $this->getTimeToValue($user->id);

            if ($ttv && $ttv['subscription_ttv'] !== null) {
                $total += $ttv['subscription_ttv'];
                $count++;
            }
        }

        return $count > 0 ? round($total / $count, 2) : 0.0;
    }


    /**
     * Get users by country
     */
    public function getUsersByCountry($limit = 10): array
    {
        return UserDailyActivity::selectRaw('country, count(distinct user_id) as user_count')
            ->whereNotNull('country')
            ->where('country', '!=', 'Unknown')
            ->groupBy('country')
            ->orderByDesc('user_count')
            ->limit($limit)
            ->pluck('user_count', 'country')
            ->toArray();
    }

    /**
     * Get users by city
     */
    public function getUsersByCity($country = null, $limit = 10): array
    {
        $query = UserDailyActivity::selectRaw('city, count(distinct user_id) as user_count')
            ->whereNotNull('city')
            ->where('city', '!=', 'Unknown');

        if ($country) {
            $query->where('country', $country);
        }

        return $query->groupBy('city')
            ->orderByDesc('user_count')
            ->limit($limit)
            ->pluck('user_count', 'city')
            ->toArray();
    }

    /**
     * Get device type breakdown
     */
    public function getDeviceTypeBreakdown($startDate, $endDate): array
    {
        return UserDailyActivity::selectRaw('device_type, count(distinct user_id) as user_count')
            ->whereBetween('date', [$startDate, $endDate])
            ->groupBy('device_type')
            ->pluck('user_count', 'device_type')
            ->toArray();
    }

    /**
     * Get top countries with user counts
     */
    public function getTopCountries($limit = 5): array
    {
        $countries = UserDailyActivity::selectRaw('country, count(distinct user_id) as user_count')
            ->whereNotNull('country')
            ->where('country', '!=', 'Unknown')
            ->groupBy('country')
            ->orderByDesc('user_count')
            ->limit($limit)
            ->get()
            ->map(fn($item) => [
                'country' => $item->country,
                'users' => $item->user_count,
            ])
            ->toArray();

        return $countries;
    }
}
