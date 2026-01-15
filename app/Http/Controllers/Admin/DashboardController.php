<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display all admin features in a grid layout.
     */
    public function index()
    {
        $features = [
            [
                'name' => 'Dashboard',
                'icon' => 'bar_chart',
                'route' => 'admin.metrics.index',
                'description' => 'View metrics and analytics'
            ],
            [
                'name' => 'Templates',
                'icon' => 'description',
                'route' => 'admin.template.index',
                'description' => 'Manage portfolio templates'
            ],
            [
                'name' => 'Users',
                'icon' => 'people',
                'route' => 'admin.user.index',
                'description' => 'Manage users'
            ],
            [
                'name' => 'Coupons',
                'icon' => 'local_offer',
                'route' => 'admin.coupon.index',
                'description' => 'Manage coupon codes'
            ],
            [
                'name' => 'Partners',
                'icon' => 'handshake',
                'route' => 'admin.partner.index',
                'description' => 'Manage partners'
            ],
            [
                'name' => 'Affiliates',
                'icon' => 'link',
                'route' => 'admin.affiliate.index',
                'description' => 'Manage affiliates'
            ],
            [
                'name' => 'Features',
                'icon' => 'stars',
                'route' => 'admin.feature.index',
                'description' => 'Manage plan features'
            ],
            [
                'name' => 'Tiers',
                'icon' => 'layers',
                'route' => 'admin.tier.index',
                'description' => 'Manage subscription tiers'
            ],
            [
                'name' => 'Plans',
                'icon' => 'card_membership',
                'route' => 'admin.plan.index',
                'description' => 'Manage subscription plans'
            ],
        ];


        return view('admin.dashboard.index', compact('features'));
    }
}
