<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CouponType;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use App\Models\Plan;
use Illuminate\Support\Facades\Log;

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
        try {
            Coupon::create($request->validated());
            alert(type: 'success', message: 'Coupon created successfully.');
            return redirect()->route('admin.coupon.index');
        } catch (\Throwable $th) {
            Log::error($th);
            alert(type: 'error', message: 'Failed to create coupon.');
            return back();
        }
    }

    public function edit(Coupon $coupon)
    {
        $plans = Plan::all();
        $types = CouponType::options();
        return view('admin.coupons.edit', compact('coupon', 'plans', 'types'));
    }

    public function update(CouponRequest $request, Coupon $coupon)
    {
        try {
            $coupon->update($request->validated());
            alert(type: 'success', message: 'Coupon updated successfully.');
            return redirect()->route('admin.coupon.index');
        } catch (\Throwable $th) {
            Log::error($th);
            alert(type: 'error', message: 'Failed to update coupon.');
            return back();
        }
    }

    public function destroy(Coupon $coupon)
    {
        try {
            $coupon->delete();
            alert(type: 'success', message: 'Coupon deleted successfully.');
            return redirect()->route('admin.coupon.index');
        } catch (\Throwable $th) {
            Log::error($th);
            alert(type: 'error', message: 'Failed to delete coupon.');
            return back();
        }
    }
}