<?php

namespace App\Livewire\Payment;

use App\Http\Controllers\Payment\Processors\NowPaymentController;
use App\Http\Controllers\Payment\Processors\PolarController;
use App\Models\Plan;
use App\Models\Portfolio;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PaymentRouter extends Component
{
    public $plans;
    public $selectedPlan = null;
    public $user;
    public $paymentMethod;
    protected $nowpayment;
    protected $polar;
    public $portfolio;

    public function boot()
    {
        $this->nowpayment =  new NowPaymentController();
        $this->polar = new PolarController();
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
                    'tax_amount' => $this->selectedPlan->price * 0.1,
                    'total_amount' => $this->selectedPlan->price * 1.1
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
                        route('user.dashboard'),
                        route('user.dashboard')
                    );
                    break;

                case 'nowpayment':
                    $response = $this->nowpayment->process(
                        $this->selectedPlan->price,
                        route('user.dashboard'),
                        route('user.dashboard')
                    );
                    break;

                default:
                    throw new \Exception('Invalid payment method');
            }

            $data = json_decode($response->getContent(), true);

            // Update transaction with payment gateway reference
            $transaction->update([
                'meta->payment_url' => $data['data']['invoice_url']
            ]);

            $this->redirect($data['data']['invoice_url']);
        } catch (\Exception $e) {
            dd($e);
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
