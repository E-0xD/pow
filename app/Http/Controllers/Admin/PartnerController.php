<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePartnerRequest;
use App\Http\Requests\UpdatePartnerRequest;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = Partner::withCount('users')->get();
        $totalUsers = Partner::withCount('users')->get()->sum('users_count');

        return view('admin.partners.index', compact('partners', 'totalUsers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.partners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartnerRequest $request)
    {
        Partner::create([
            'name' => $request->name,
            'email' => $request->email,
            'api_key' => Str::random(64),
        ]);

        return redirect()->route('admin.partner.index')->with('success', 'Partner created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Partner $partner)
    {
        $partner->load('users');
        return view('admin.partners.show', compact('partner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePartnerRequest $request, Partner $partner)
    {
        $partner->update($request->only(['name', 'email']));

        return redirect()->route('admin.partner.index')->with('success', 'Partner updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        $partner->delete();

        return redirect()->route('admin.partner.index')->with('success', 'Partner deleted successfully.');
    }
}
