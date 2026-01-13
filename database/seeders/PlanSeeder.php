<?php

namespace Database\Seeders;

use App\Enums\BillingCycle;
use App\Models\Plan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            // Free Tier
            [
                'uid' => Str::uuid(),
                'tier' => 'free',
                'name' => 'Free',
                'description' => 'Perfect for getting started',
                'price' => null,
                'billing_cycle' => BillingCycle::MONTHLY,
                'interval_days' => 30,
                'benefits' => config('plans.tiers.free.features'),
                'duration' => 30,
                'is_active' => true,
            ],
            [
                'uid' => Str::uuid(),
                'tier' => 'free',
                'name' => 'Free',
                'description' => 'Perfect for getting started',
                'price' => null,
                'billing_cycle' =>  BillingCycle::YEARLY,
                'interval_days' => 30,
                'benefits' => config('plans.tiers.free.features'),
                'duration' => 365,
                'is_active' => true,
            ],

            // Basic Plans
            [
                'uid' => Str::uuid(),
                'tier' => 'basic',
                'name' => 'Basic - Monthly',
                'description' => 'For professionals building their presence',
                'price' => 29.99,
                'billing_cycle' => BillingCycle::MONTHLY,
                'interval_days' => 30,
                'benefits' => config('plans.tiers.basic.features'),
                'duration' => 30,
                'is_active' => true, 
            ],
            [
                'uid' => Str::uuid(),
                'tier' => 'basic',
                'name' => 'Basic - Yearly',
                'description' => 'For professionals building their presence',
                'price' => 299.99,
                'billing_cycle' =>  BillingCycle::YEARLY,
                'interval_days' => 365,
                'benefits' => config('plans.tiers.basic.features'),
                'duration' => 365,
                'is_active' => true,
            ],

            // Pro Plans
            [
                'uid' => Str::uuid(),
                'tier' => 'pro',
                'name' => 'Pro - Monthly',
                'description' => 'For growing teams and businesses',
                'price' => 79.99,
                'billing_cycle' => BillingCycle::MONTHLY,
                'interval_days' => 30,
                'benefits' => config('plans.tiers.pro.features'),
                'duration' => 30,
                'is_active' => true,
            ],
            [
                'uid' => Str::uuid(),
                'tier' => 'pro',
                'name' => 'Pro - Yearly',
                'description' => 'For growing teams and businesses',
                'price' => 799.99,
                'billing_cycle' =>  BillingCycle::YEARLY,
                'interval_days' => 365,
                'benefits' => config('plans.tiers.pro.features'),
                'duration' => 365,
                'is_active' => true,
            ],

            // Enterprise Plans
            [
                'uid' => Str::uuid(),
                'tier' => 'enterprise',
                'name' => 'Enterprise - Monthly',
                'description' => 'Custom solutions for large organizations',
                'price' => 299.99,
                'billing_cycle' => BillingCycle::MONTHLY,
                'interval_days' => 30,
                'benefits' => config('plans.tiers.enterprise.features'),
                'duration' => 30,
                'is_active' => true,
            ],
            [
                'uid' => Str::uuid(),
                'tier' => 'enterprise',
                'name' => 'Enterprise - Yearly',
                'description' => 'Custom solutions for large organizations',
                'price' => 2999.99,
                'billing_cycle' =>  BillingCycle::YEARLY,
                'interval_days' => 365,
                'benefits' => config('plans.tiers.enterprise.features'),
                'duration' => 365,
                'is_active' => true,
            ],
        ];

        foreach ($plans as $plan) {
            Plan::updateOrCreate(
                [
                    'tier' => $plan['tier'],
                    'billing_cycle' => $plan['billing_cycle'],
                ],
                $plan
            );
        }

        $this->command->info('Plans seeded successfully');
    }
}
