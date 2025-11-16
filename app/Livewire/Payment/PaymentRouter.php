<?php

namespace App\Livewire\Payment;

use App\Http\Controllers\Payment\Processors\NowPaymentController;
use App\Http\Controllers\Payment\Processors\PaystackController;
use App\Http\Controllers\Payment\Processors\PolarController;
use App\Models\Plan;
use App\Models\Portfolio;
use App\Models\Transaction;
use App\Services\EmailService;
use App\Services\MessageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class PaymentRouter extends Component
{
    public $plans;
    public $selectedPlan = null;
    public $user;
    public $paymentMethod = 'paystack';
    protected $nowpayment;
    protected $polar;
    protected $paystack;
    public $portfolio;
    protected $emailService;
    protected $messageService;

    public function boot()
    {
        $this->nowpayment =  new NowPaymentController();
        $this->polar = new PolarController();
        $this->paystack = new PaystackController();
        $this->emailService = new EmailService();
        $this->messageService = new MessageService(new Agent());
    }

    public function mount(Portfolio $portfolio)
    {
        $this->portfolio = $portfolio;
        $this->plans = Plan::get();
    }

    public function selectPlan($planId)
    {
        $this->selectedPlan = Plan::find($planId);
    }

    public function removeSelectedPlan()
    {
        $this->selectedPlan = null;
    }

    public function pay()
    {
        try {
            DB::beginTransaction();

            // Create the transaction record
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'amount' => $this->selectedPlan->price,
                'status' => 'pending',
                'gateway' => $this->paymentMethod,
                'reference' => 'REF-' . uniqid(),
                'payable_type' => Plan::class,
                'payable_id' => $this->selectedPlan->id,
                'meta' => [
                    'plan_name' => $this->selectedPlan->name,
                    'total_amount' => $this->selectedPlan->price
                ]
            ]);

            $portfolioSubscription = $this->portfolio->subscriptions()->create([
                'plan_id' => $this->selectedPlan->id,
                'user_id' => Auth::id(),
                'status' => 'pending',
                'transaction_id' => $transaction->id,
            ]);
            DB::commit();

            // Process payment with gateway
            switch ($this->paymentMethod) {
                case 'polar':
                    $response = $this->polar->process(
                        $portfolioSubscription->id,
                        $this->selectedPlan->uid,
                        route('user.portfolio.index'),
                        route('user.dashboard')
                    );
                    break;

                case 'nowpayment':
                    $response = $this->nowpayment->process(
                        $this->selectedPlan->price,
                        route('nowpayment.validate'),
                        route('user.dashboard')
                    );
                    break;
                case 'paystack':
                    $response = $this->paystack->process(
                        $portfolioSubscription->id,
                        $this->selectedPlan,
                        route('user.portfolio.index'),
                        route('user.dashboard')
                    );
                    break;
                default:
                    throw new \Exception('Invalid payment method');
            }

            $data = json_decode($response->getContent(), true);

            // Update transaction with payment gateway reference
            $transaction->update([
                'meta->payment_url' => $data['data']['invoice_url'],
                'processor_reference' => $data['data']['transaction_id']
            ]);

            $message = $this->messageService->getPaymentInitiatedMessage($transaction->amount, $transaction->reference, $this->portfolio->title);

            $this->emailService->send(
                Auth::user()->email,
                $message['subject'],
                $message['payload']
            );

            $this->redirect($data['data']['invoice_url']);
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
            session()->flash('error', 'Payment processing failed. Please try again.');
            return;
        }
    }

    public function render()
    {
        return view('livewire.payment.payment-router');
    }
}
