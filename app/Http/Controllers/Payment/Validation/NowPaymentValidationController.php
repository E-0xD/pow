<?php

namespace App\Http\Controllers\Payment\Validation;

use App\Enums\PortfolioSubscriptionStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Payment\Processors\NowPaymentController;
use App\Models\Plan;
use App\Models\PortfolioSubscription;
use App\Models\Transaction;
use App\Services\EmailService;
use App\Services\MessageService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class NowPaymentValidationController extends Controller
{
    public $nowpayment;
    public $emailService;
    public $messageService;

    public function __construct()
    {
        $this->emailService = new EmailService();
        $this->messageService = new MessageService(new Agent());
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
        $portfolioSubscription = PortfolioSubscription::where('transaction_id', $transaction->id)->first();

        if ($transaction->amount  > $amount) {
            return redirect()->route('user.portfolio.index')->with([
                'type' => 'error',
                'message' => 'Incomplete Payment Received, Kindly contact support'
            ]);

            $message = $this->messageService->getPaymentFailedMessage($portfolioSubscription->transaction->amount, $portfolioSubscription->transaction->reference,  $portfolioSubscription->portfolio->title);

            $this->emailService->send(
                $portfolioSubscription->user->email,
                $message['subject'],
                $message['payload']
            );
        } else {

            $plan = Plan::find($portfolioSubscription->plan_id);

            $portfolioSubscription->update([
                'status' => PortfolioSubscriptionStatus::ACTIVE,
                'purchased_at' => now(),
                'expires_at' => Carbon::now()->addDays((int) $plan->duration),
            ]);

            $message = $this->messageService->getPaymentSuccessMessage($portfolioSubscription->transaction->amount, $portfolioSubscription->transaction->reference,  $portfolioSubscription->portfolio->title);

            $this->emailService->send(
                $portfolioSubscription->user->email,
                $message['subject'],
                $message['payload']
            );

            return redirect()->route('user.portfolio.index')->with([
                'type' => 'success',
                'message' => 'Payment Received, Portfolio Activated'
            ]);
        };
    }
}
