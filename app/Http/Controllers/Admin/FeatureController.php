<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeatureRequest;
use App\Models\Feature;
use Illuminate\Support\Facades\Log;

class FeatureController extends Controller
{
    public function index()
    {
        $features = Feature::paginate(15);
        return view('admin.features.index', compact('features'));
    }

    public function create()
    {
        return view('admin.features.create');
    }

    public function store(FeatureRequest $request)
    {
        try {
            Feature::create($request->validated());
            alert(type: 'success', message: 'Feature created successfully.');
            return redirect()->route('admin.feature.index');
        } catch (\Throwable $th) {
            Log::error($th);
            alert(type: 'error', message: 'Failed to create feature.');
            return back();
        }
    }

    public function edit(Feature $feature)
    {
        return view('admin.features.edit', compact('feature'));
    }

    public function update(FeatureRequest $request, Feature $feature)
    {

        try {
            $feature->update($request->validated());
            alert(type: 'success', message: 'Feature updated successfully.');
            return redirect()->route('admin.feature.index');
        } catch (\Throwable $th) {
            Log::error($th);
            alert(type: 'error', message: 'Failed to update feature.');
            return back();
        }
    }

    public function destroy(Feature $feature)
    {
        try {
            $feature->delete();
            alert(type: 'success', message: 'Feature deleted successfully.');
            return redirect()->route('admin.feature.index');
        } catch (\Throwable $th) {
            Log::error($th);
            alert(type: 'error', message: 'Failed to delete feature.');
            return back();
        }
    }
}
