<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUpdatePortfolioSubscription;
use App\Models\Portfolio;
use App\Models\PortfolioSubscription;
use App\Models\Plan;
use Illuminate\Support\Facades\Log;


class PortfolioSubscriptionController extends Controller
{
    public function edit(Portfolio $portfolio)
    {
        $subscription = $portfolio->activeSubscription;
        $plans = Plan::all();
        return view('admin.user.subscription-edit', compact('portfolio', 'subscription', 'plans'));
    }

    public function update(AdminUpdatePortfolioSubscription $request, Portfolio $portfolio)
    {
        $data = $request->validated();

        try {
            $subscription = $portfolio->activeSubscription;
            
            if (!$subscription) {
                $subscription = new PortfolioSubscription();
                $subscription->portfolio_id = $portfolio->id;
                $subscription->user_id = $portfolio->user_id;
            }

            $subscription->plan_id = $data['plan_id'];
            $subscription->expires_at = $data['expires_at'];
            $subscription->status = $data['status'];
            $subscription->save();

            alert(type: 'success', message: 'Subscription updated successfully.');
            return redirect()->route('admin.user.show', $portfolio->user);
        } catch (\Throwable $th) {
            Log::error($th);
            alert(type: 'error', message: 'Failed to update subscription.');
            return back()->withInput();
        }
    }
}