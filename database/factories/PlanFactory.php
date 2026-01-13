<?php

namespace Database\Factories;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PlanFactory extends Factory
{
    protected $model = Plan::class;

    public function definition(): array
    {
        $tier = $this->faker->randomElement(['free', 'basic', 'pro', 'enterprise']);
        $billingCycle = $this->faker->randomElement(['monthly', 'yearly']);

        $config = config("plans.tiers.{$tier}");

        return [
            'uid' => Str::uuid(),
            'tier' => $tier,
            'name' => $config['name'],
            'description' => $config['description'],
            'price' => $config['pricing'][$billingCycle]['amount'] ?? null,
            'billing_cycle' => $billingCycle,
            'interval_days' => $config['pricing'][$billingCycle]['interval_days'] ?? null,
            'benefits' => $config['features'] ?? [],
            'duration' => $config['pricing'][$billingCycle]['interval_days'] ?? 30,
            'is_active' => true,
        ];
    }

    public function free(): static
    {
        return $this->state(fn(array $attributes) => [
            'tier' => 'free',
            'name' => 'Free',
            'description' => 'Perfect for getting started',
            'price' => null,
            'billing_cycle' => 'monthly',
            'interval_days' => 30,
        ]);
    }

    public function basic(): static
    {
        return $this->state(fn(array $attributes) => [
            'tier' => 'basic',
            'name' => 'Basic',
            'description' => 'For professionals building their presence',
            'price' => 29.99,
            'billing_cycle' => 'monthly',
            'interval_days' => 30,
        ]);
    }

    public function basicYearly(): static
    {
        return $this->state(fn(array $attributes) => [
            'tier' => 'basic',
            'name' => 'Basic',
            'description' => 'For professionals building their presence',
            'price' => 299.99,
            'billing_cycle' => 'yearly',
            'interval_days' => 365,
        ]);
    }

    public function pro(): static
    {
        return $this->state(fn(array $attributes) => [
            'tier' => 'pro',
            'name' => 'Pro',
            'description' => 'For growing teams and businesses',
            'price' => 79.99,
            'billing_cycle' => 'monthly',
            'interval_days' => 30,
        ]);
    }

    public function proYearly(): static
    {
        return $this->state(fn(array $attributes) => [
            'tier' => 'pro',
            'name' => 'Pro',
            'description' => 'For growing teams and businesses',
            'price' => 799.99,
            'billing_cycle' => 'yearly',
            'interval_days' => 365,
        ]);
    }

    public function enterprise(): static
    {
        return $this->state(fn(array $attributes) => [
            'tier' => 'enterprise',
            'name' => 'Enterprise',
            'description' => 'Custom solutions for large organizations',
            'price' => 299.99,
            'billing_cycle' => 'monthly',
            'interval_days' => 30,
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn(array $attributes) => [
            'is_active' => false,
        ]);
    }
}
