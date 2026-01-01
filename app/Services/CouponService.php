<?php

namespace App\Services;

use App\Enums\CouponType;
use App\Models\Coupon;
use App\Models\Plan;

class CouponService
{
    public function applyCouponToPlan(Coupon $coupon, Plan $plan)
    {
        $result = [
            'valid' => false,
            'original_price' => $plan->price,
            'discounted_price' => $plan->price,
            'free_months' => 0,
            'extra_months' => 0,
            'total_duration_days' => $plan->duration,
        ];

        if (!$coupon->isValid()) {
            return $result;
        }

        switch ($coupon->type) {
            case CouponType::PLAN_DISCOUNT:
                if ($coupon->applicable_plan_id === $plan->id) {
                    $result['discounted_price'] = $this->calculateDiscount($plan->price, $coupon->discount_value);
                    $result['valid'] = true;
                }
                break;
            case CouponType::GLOBAL_DISCOUNT:
                $result['discounted_price'] = $this->calculateDiscount($plan->price, $coupon->discount_value);
                $result['valid'] = true;
                break;
            case CouponType::FREE_MONTHS:
                $result['free_months'] = $coupon->months_value;
                $result['discounted_price'] = 0;
                $result['valid'] = true;
                break;
            case CouponType::EXTRA_MONTHS:
                $result['extra_months'] = $coupon->months_value;
                $result['total_duration_days'] += $coupon->months_value * 30; // approximate
                $result['valid'] = true;
                break;
        }

        return $result;
    }

    public function findValidCoupon(string $code): ?Coupon
    {
        return Coupon::where('code', $code)
            ->where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->where(function ($query) {
                $query->whereNull('max_uses')
                    ->orWhereColumn('used_count', '<', 'max_uses');
            })
            ->first();
    }

    private function calculateDiscount($price, $discountValue)
    {
        // Assuming discount_value is percentage (0-100)
        return $price * (1 - $discountValue / 100);
    }

    public function applyCouponBenefitsToSubscription($coupon, $portfolioSubscription)
    {

        if (!$coupon || !$coupon->isValid()) {
            return;
        }

        $plan = $portfolioSubscription->plan;
        $expiresAt = $portfolioSubscription->expires_at;

        switch ($coupon->type) {
            case CouponType::FREE_MONTHS:
                $expiresAt = $expiresAt->addDays($coupon->months_value * 30);
                break;
            case CouponType::EXTRA_MONTHS:
                $expiresAt = $expiresAt->addDays($coupon->months_value * 30);
                break;
        }

        $portfolioSubscription->update(['expires_at' => $expiresAt]);
        $coupon->increment('used_count');
        $coupon->save();
    }
}
