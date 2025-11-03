<?php

namespace App\Http\Controllers\Admin;

use App\Enums\NotificationType;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminMakeAffiliate;
use App\Models\Affiliate;
use App\Models\Transaction;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AffiliateController extends Controller
{
    public $notifications;

    public function __construct()
    {
        $this->notifications = new NotificationService();
    }

    public function index()
    {
        $affiliates = Affiliate::with('user')
            ->select('affiliates.*')
            ->selectSub(function ($query) {
                $query->from('transactions')
                    ->selectRaw('COALESCE(SUM(amount), 0)')
                    ->whereColumn('transactions.user_id', 'affiliates.user_id')
                    ->where('gateway', 'affiliate')
                    ->where('status', 'successful');
            }, 'total_commission')
            ->latest()
            ->paginate(15);


        $totalAffiliates = Affiliate::count();
        $pendingWithdrawals = Affiliate::where('balance', '>', 0)->sum('balance');
        $totalPaid = Transaction::where('gateway', 'affiliate_payout')
            ->where('status', 'successful')
            ->sum('amount');

        return view('admin.affiliate.index', compact(
            'affiliates',
            'totalAffiliates',
            'pendingWithdrawals',
            'totalPaid'
        ));
    }

    public function store(AdminMakeAffiliate $request, User $user)
    {
        try {
            if ($user->affiliate()->exists()) {
                return back()->with(['type' => 'error', 'message' => 'User is already an affiliate.']);
            }

            $user->affiliate()->create([
                'commission_rate' => $request->commission_rate,
            ]);

            return back()->with(['type' => 'success', 'message' => 'User made affiliate successfully.']);
        } catch (\Throwable $e) {
            Log::error($e);
            return back()->withInput()->with(['type' => 'error', 'message' => 'Failed to create affiliate.']);
        }
    }

    public function edit(Affiliate $affiliate)
    {
        return view('admin.affiliate.edit', compact('affiliate'));
    }

    public function update(Request $request, Affiliate $affiliate)
    {
        $data = $request->validate([
            'commission_rate' => 'required|numeric|min:0|max:100',
            'payout_method' => 'required|in:paypal,bank,crypto',
            'payout_details' => 'required|array',
            'payout_details.account' => 'required|string',
        ]);

        try {
            $affiliate->update($data);
            return redirect()->route('admin.affiliate.index')->with(['type' => 'success', 'message' => 'Affiliate updated.']);
        } catch (\Throwable $e) {
            Log::error($e);
            return back()->withInput()->with(['type' => 'error', 'message' => 'Failed to update affiliate.']);
        }
    }

    public function destroy(Affiliate $affiliate)
    {
        try {
            $affiliate->delete();
            return redirect()->route('admin.affiliate.index')->with(['type' => 'success', 'message' => 'Affiliate removed.']);
        } catch (\Throwable $e) {
            Log::error($e);
            return back()->with(['type' => 'error', 'message' => 'Failed to remove affiliate.']);
        }
    }

    public function processPayout(Request $request, Affiliate $affiliate)
    {
        $data = $request->validate([
            'amount' => "required|numeric|min:0|max:{$affiliate->balance}",
        ]);

        try {
            DB::transaction(function () use ($affiliate, $data) {
                $transaction = Transaction::create([
                    'user_id' => $affiliate->user_id,
                    'amount' => $data['amount'],
                    'status' => 'successful',
                    'gateway' => 'affiliate_payout',
                    'reference' => Str::random(16),
                    'payable_type' => Affiliate::class,
                    'payable_id' => $affiliate->id,
                    'meta' => [
                        'payout_method' => $affiliate->payout_method,
                        'payout_details' => $affiliate->payout_details,
                    ],
                ]);

                Log::info($transaction);

                $affiliate->balance -= $data['amount'];
                $affiliate->last_payout_at = now();
                $affiliate->save();

                // Add notification
                $this->notifications->sendToUser(
                    NotificationType::PAYMENT_SUCCESS,
                    $affiliate->user_id,
                    'Affiliate Payout',
                    'Your affiliate payout of $' . number_format($data['amount'], 2) . ' has been processed.',
                    ['amount' => $data['amount']]
                );
            });

            return back()->with(['type' => 'success', 'message' => 'Payout processed successfully.']);
        } catch (\Throwable $e) {
            Log::error($e);
            return back()->with(['type' => 'error', 'message' => 'Failed to process payout.']);
        }
    }
}
