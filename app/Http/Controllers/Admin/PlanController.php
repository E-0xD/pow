<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanRequest;
use App\Models\Plan;
use App\Models\Tier;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::with('tier')->paginate(15);
        return view('admin.plans.index', compact('plans'));
    }

    public function create()
    {
        $tiers = Tier::all();
        return view('admin.plans.create', compact('tiers'));
    }

    public function store(PlanRequest $request)
    {

        try {
            $data = $request->validated();
            $data['uid'] = Str::uuid();
            Plan::create($data);
            alert(type: 'success', message: 'Plan created successfully.');
            return redirect()->route('admin.plan.index');
        } catch (\Throwable $th) {
            Log::error($th);
            alert(type: 'error', message: 'Failed to create plan.');
            return back();
        }
    }

    public function edit(Plan $plan)
    {
        $tiers = Tier::all();
        return view('admin.plans.edit', compact('plan', 'tiers'));
    }

    public function update(PlanRequest $request, Plan $plan)
    {

        try {
            $plan->update($request->validated());
            alert(type: 'success', message: 'Plan updated successfully.');
            return redirect()->route('admin.plan.index');
        } catch (\Throwable $th) {
            Log::error($th);
            alert(type: 'error', message: 'Failed to update plan.');
            return back();
        }
    }

    public function destroy(Plan $plan)
    {
        try {
            $plan->delete();
            alert(type: 'success', message: 'Plan deleted successfully.');
            return redirect()->route('admin.plan.index');
        } catch (\Throwable $th) {
            Log::error($th);
            alert(type: 'error', message: 'Failed to delete plan.');
            return back();
        }
    }
}
