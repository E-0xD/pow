<?php

namespace App\Http\Controllers\Payment\Validation;

use App\Enums\PortfolioSubscriptionStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Payment\Processors\NowPaymentController;
use App\Models\Plan;
use App\Models\PortfolioSubscription;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NowPaymentValidationController extends Controller
{
    public $nowpayment;
    public function __construct()
    {
        $this->nowpayment = new NowPaymentController();
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $response = $this->nowpayment->validate($request);

        $responseData = json_decode($response->getContent(), true);

        [
            'amount' => $amount,
            'transaction_id' => $transactionId
        ] = $responseData['data'];


        $transaction = Transaction::where('processor_reference',  $transactionId)->first();

        if ($transaction->amount  > $amount) {
            return redirect()->route('user.portfolio.index')->with([
                'type' => 'error',
                'message' => 'Incomplete Payment Received, Kindly contact support'
            ]);
        } else {

            $portfolioSubscription = PortfolioSubscription::where('transaction_id', $transaction->id)->first();
            $plan = Plan::find($portfolioSubscription->plan_id);

            $portfolioSubscription->update([
                'status' => PortfolioSubscriptionStatus::ACTIVE,
                'purchased_at' => now(),
                'expires_at' => Carbon::now()->addDays((int) $plan->duration),
            ]);

            return redirect()->route('user.portfolio.index')->with([
                'type' => 'success',
                'message' => 'Payment Received, Portfolio Activated'
            ]);
        };
    }
}
