<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Affiliate;
use App\Services\NotificationService;
use App\Models\Transaction;
use App\Models\User;

class AffiliateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $affiliate = $user->affiliate;
        if (!$affiliate) {
            $affiliate = Affiliate::firstOrCreate(['user_id' => $user->id]);
        }

        $transactions = Transaction::where('user_id', $user->id)->latest()->limit(20)->get();
        $totalCommissions = (float) Transaction::where('user_id', $user->id)
            ->where('gateway', 'affiliate')
            ->where('reference', 'commission')
            ->sum('amount');

        $totalReferrals = User::where('referred_by', $user->id)->count();

        return view('user.affiliate.index', [
            'affiliate' => $affiliate,
            'transactions' => $transactions,
            'totalCommissions' => $totalCommissions,
            'totalReferrals' => $totalReferrals,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $affiliate = Affiliate::firstOrCreate(['user_id' => $user->id]);

        $data = $request->validate([
            'payout_method' => 'required|string|in:bank,crypto',
            'bank_name' => 'required_if:payout_method,bank',
            'account_number' => 'required_if:payout_method,bank',
            'network' => 'required_if:payout_method,crypto',
            'wallet_address' => 'required_if:payout_method,crypto',
        ]);

        $affiliate->payout_method = $data['payout_method'];
        
        // Structure payout details based on method
        if ($data['payout_method'] === 'bank') {
            $affiliate->payout_details = [
                'bank_name' => $data['bank_name'],
                'account_number' => $data['account_number'],
            ];
        } else {
            $affiliate->payout_details = [
                'network' => $data['network'],
                'wallet_address' => $data['wallet_address'],
            ];
        }

        $affiliate->save();

        return back()->with('success', 'Payout details updated.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
