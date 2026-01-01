<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CouponType;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use App\Models\Plan;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::with('plan')->paginate(15);
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        $plans = Plan::all();
        $types = CouponType::options();
        return view('admin.coupons.create', compact('plans', 'types'));
    }

    public function store(CouponRequest $request)
    {
        Coupon::create($request->validated());
        return redirect()->route('admin.coupon.index')->with(['type' => 'success', 'message' => 'Coupon created successfully.']);
    }

    public function edit(Coupon $coupon)
    {
        $plans = Plan::all();
        $types = CouponType::options();
        return view('admin.coupons.edit', compact('coupon', 'plans', 'types'));
    }

    public function update(CouponRequest $request, Coupon $coupon)
    {
        $coupon->update($request->validated());
        return redirect()->route('admin.coupon.index')->with(['type' => 'success', 'message' => 'Coupon updated successfully.']);
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('admin.coupon.index')->with(['type' => 'success', 'message' => 'Coupon deleted successfully.']);;
    }
}