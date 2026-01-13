<?php

/**
 * Plan Configuration
 * 
 * Defines subscription tiers and their restrictions/features
 * Each plan can have monthly and yearly billing options
 */

return [
    'tiers' => [
        'free' => [
            'name' => 'Free',
            'description' => 'Perfect for getting started',
            'pricing' => [],
            'features' => [
                'portfolios' => 1,
                'projects_per_portfolio' => 3,
                'portfolio_storage_gb' => 2,
                'custom_domain' => false,
                'analytics' => false,
                'team_members' => 0,
                'api_access' => false,
                'priority_support' => false,
                'monthly_visits_limit' => 100,
            ],
            'is_paid' => false,
        ],
        'basic' => [
            'name' => 'Basic',
            'description' => 'For professionals building their presence',
            'pricing' => [
                'monthly' => [
                    'amount' => 29.99,
                    'currency' => 'USD',
                    'interval_days' => 30,
                ],
                'yearly' => [
                    'amount' => 299.99,
                    'currency' => 'USD',
                    'interval_days' => 365,
                ],
            ],
            'features' => [
                'portfolios' => 3,
                'projects_per_portfolio' => 15,
                'portfolio_storage_gb' => 25,
                'custom_domain' => true,
                'analytics' => true,
                'team_members' => 2,
                'api_access' => false,
                'priority_support' => false,
                'monthly_visits_limit' => 5000,
            ],
            'is_paid' => true,
        ],
        'pro' => [
            'name' => 'Pro',
            'description' => 'For growing teams and businesses',
            'pricing' => [
                'monthly' => [
                    'amount' => 79.99,
                    'currency' => 'USD',
                    'interval_days' => 30,
                ],
                'yearly' => [
                    'amount' => 799.99,
                    'currency' => 'USD',
                    'interval_days' => 365,
                ],
            ],
            'features' => [
                'portfolios' => 10,
                'projects_per_portfolio' => 50,
                'portfolio_storage_gb' => 100,
                'custom_domain' => true,
                'analytics' => true,
                'team_members' => 10,
                'api_access' => true,
                'priority_support' => true,
                'monthly_visits_limit' => 50000,
            ],
            'is_paid' => true,
        ],
        'enterprise' => [
            'name' => 'Enterprise',
            'description' => 'Custom solutions for large organizations',
            'pricing' => [
                'monthly' => [
                    'amount' => 299.99,
                    'currency' => 'USD',
                    'interval_days' => 30,
                ],
                'yearly' => [
                    'amount' => 2999.99,
                    'currency' => 'USD',
                    'interval_days' => 365,
                ],
            ],
            'features' => [
                'portfolios' => 999,
                'projects_per_portfolio' => 999,
                'portfolio_storage_gb' => 1000,
                'custom_domain' => true,
                'analytics' => true,
                'team_members' => 999,
                'api_access' => true,
                'priority_support' => true,
                'monthly_visits_limit' => 999999,
            ],
            'is_paid' => true,
        ],
    ],

    /**
     * Grace period after subscription expires (in days)
     * During this time, users can still access their content
     */
    'grace_period_days' => 7,

    /**
     * Auto-renewal settings
     */
    'auto_renewal' => [
        'enabled' => true,
        'retry_on_failure' => true,
        'max_retries' => 3,
        'retry_interval_days' => 3,
    ],

    /**
     * Trial settings (optional)
     */
    'trial' => [
        'enabled' => true,
        'duration_days' => 14,
        'tier' => 'pro', // Which tier level trial users get
    ],

    /**
     * Discount/coupon settings
     */
    'coupons' => [
        'enabled' => true,
        'max_discount_percent' => 50,
    ],

    /**
     * Currency formatting
     */
    'currency' => [
        'default' => 'USD',
        'symbol' => '$',
        'position' => 'before', // before or after
    ],
];
