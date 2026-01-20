<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TierRequest;
use App\Models\Feature;
use App\Models\Tier;
use Illuminate\Support\Facades\Log;

class TierController extends Controller
{
    public function index()
    {
        $tiers = Tier::with('features')->paginate(15);
        return view('admin.tiers.index', compact('tiers'));
    }

    public function create()
    {
        $features = Feature::all();
        return view('admin.tiers.create', compact('features'));
    }

    public function store(TierRequest $request)
    {

        try {

            $tier = Tier::create($request->validated());

            if ($request->has('features')) {
                foreach ($request->features as $featureId => $featureData) {
                    if (!empty($featureData['enabled'])) {
                        $feature = Feature::find($featureId);
                        $value = $feature && $feature->type === 'boolean' ? ($featureData['value'] ?? 0) : ($featureData['value'] ?? null);
                        $tier->features()->attach($featureId, [
                            'value' => $value,
                        ]);
                    }
                }
            }

            alert(type: 'success', message: 'Tier created successfully.');
            return redirect()->route('admin.tier.index');
        } catch (\Throwable $th) {
            Log::error($th);
            alert(type: 'error', message: 'Failed to create tier.');
            return back();
        }
    }

    public function edit(Tier $tier)
    {
        $features = Feature::all();
        return view('admin.tiers.edit', compact('tier', 'features'));
    }

    public function update(TierRequest $request, Tier $tier)
    {
        try {

            $tier->update($request->validated());

            // Update features
            $tier->features()->detach();

            if ($request->has('features')) {
                foreach ($request->features as $featureId => $featureData) {
                    if (!empty($featureData['enabled'])) {
                        $feature = Feature::find($featureId);
                        $value = $feature && $feature->type === 'boolean' ? ($featureData['value'] ?? 0) : ($featureData['value'] ?? null);
                        $tier->features()->attach($featureId, [
                            'value' => $value,
                        ]);
                    }
                }
            }

            alert(type: 'success', message: 'Tier updated successfully.');
            return redirect()->route('admin.tier.index');
        } catch (\Throwable $th) {
            Log::error($th);
            alert(type: 'error', message: 'Failed to updated tier.');
            return back();
        }
    }

    public function destroy(Tier $tier)
    {
        try {
            $tier->delete();
            alert(type: 'success', message: 'Tier deleted successfully.');
            return redirect()->route('admin.tier.index');
        } catch (\Throwable $th) {
            Log::error($th);
            alert(type: 'error', message: 'Failed to delete tier.');
        }
    }
}
