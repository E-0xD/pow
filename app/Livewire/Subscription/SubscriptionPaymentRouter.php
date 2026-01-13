<?php

namespace App\Livewire\Subscription;

use App\Enums\BillingCycle;
use App\Http\Controllers\Payment\Processors\NowPaymentController;
use App\Http\Controllers\Payment\Processors\PaystackController;
use App\Http\Controllers\Payment\Processors\PolarController;
use App\Models\Coupon;
use App\Models\Plan;
use App\Models\UserSubscription;
use App\Models\Transaction;
use App\Services\CouponService;
use App\Services\EmailService;
use App\Services\MessageService;
use App\Services\SubscriptionService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class SubscriptionPaymentRouter extends Component
{
    public $plans = [];
    public $selectedPlan = null;
    public $selectedBillingCycle = 'monthly';
    public $user;
    public $paymentMethod = 'paystack';
    public $couponCode = '';
    public $appliedCoupon = null;
    public $couponError = null;
    protected $couponService;
    protected $nowpayment;
    protected $polar;
    protected $paystack;
    protected $emailService;
    protected $messageService;
    protected $subscriptionService;

    public function boot()
    {
        $this->couponService = new CouponService();
        $this->paystack = new PaystackController();
        $this->emailService = new EmailService();
        $this->messageService = new MessageService(new Agent());
        $this->subscriptionService = new SubscriptionService();
    }

    public function mount()
    {
        $this->user = Auth::user();
        $this->loadAvailablePlans();
    }

    /**
     * Load available plans organized by tier and billing cycle
     */
    public function loadAvailablePlans()
    {
        $allPlans = Plan::active()->get();

        $organized = [];
        foreach ($allPlans as $plan) {
            $tier = $plan->tier;
            $cycle = $plan->billing_cycle->value;

            if (!isset($organized[$tier])) {
                $organized[$tier] = [];
            }

            if (!isset($organized[$tier][$cycle])) {
                $organized[$tier][$cycle] = $plan;
            }
        }

        $this->plans = $organized;
    }

    /**
     * Select a plan tier
     */
    public function selectPlan($tier)
    {
        $plan = Plan::where('tier', $tier)
            ->where('billing_cycle', BillingCycle::from($this->selectedBillingCycle))
            ->active()
            ->first();

        if ($plan) {
            $this->selectedPlan = $plan;
            $this->appliedCoupon = null;
            $this->couponCode = '';
            $this->couponError = null;
        }
    }

    /**
     * Handle billing cycle change
     */
    public function updateBillingCycle($cycle)
    {
        $this->selectedBillingCycle = $cycle;

        // Reload plans for selected tier if one is already selected
        if ($this->selectedPlan) {
            $this->selectPlan($this->selectedPlan->tier);
        }
    }

    /**
     * Remove selected plan
     */
    public function removeSelectedPlan()
    {
        $this->selectedPlan = null;
        $this->appliedCoupon = null;
        $this->couponCode = '';
        $this->couponError = null;
    }

    /**
     * Apply coupon code
     */
    public function applyCoupon()
    {
        if (!$this->selectedPlan) {
            $this->couponError = 'Please select a plan first.';
            return;
        }

        if (empty($this->couponCode)) {
            $this->couponError = 'Please enter a coupon code.';
            return;
        }

        $coupon = $this->couponService->findValidCoupon($this->couponCode);
        if (!$coupon) {
            $this->couponError = 'Invalid or expired coupon code.';
            $this->appliedCoupon = null;
            return;
        }

        $applied = $this->couponService->applyCouponToPlan($coupon, $this->selectedPlan);
        if ($applied['valid']) {
            $this->appliedCoupon = $coupon;
            $this->couponError = null;
        } else {
            $this->couponError = 'This coupon does not apply to the selected plan.';
            $this->appliedCoupon = null;
        }
    }

    /**
     * Get final price with coupon applied if any
     */
    public function getFinalPriceProperty()
    {
        if (!$this->selectedPlan) {
            return 0;
        }

        $price = $this->selectedPlan->price ?? 0;

        if ($this->appliedCoupon) {
            $applied = $this->couponService->applyCouponToPlan($this->appliedCoupon, $this->selectedPlan);
            return $applied['discounted_price'] ?? $price;
        }

        return $price;
    }

    /**
     * Process payment
     */
    public function pay()
    {
        try {
            if (!$this->selectedPlan) {
                throw new \Exception('No plan selected');
            }

            DB::beginTransaction();

            $finalAmount = $this->selectedPlan->price ?? 0;
            $couponCode = null;

            if ($this->appliedCoupon) {
                $applied = $this->couponService->applyCouponToPlan($this->appliedCoupon, $this->selectedPlan);
                $finalAmount = $applied['discounted_price'] ?? $finalAmount;
                $couponCode = $this->appliedCoupon->code;
            }

            // Create transaction record
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'amount' => $finalAmount,
                'status' => 'pending',
                'gateway' => $this->paymentMethod,
                'reference' => 'SUB-' . uniqid(),
                'payable_type' => Plan::class,
                'payable_id' => $this->selectedPlan->id,
                'meta' => [
                    'coupon_code' => $couponCode,
                    'subscription_type' => 'account',
                    'billing_cycle' => $this->selectedBillingCycle,
                ]
            ]);

            // Create user subscription record
            $userSubscription = $this->subscriptionService->createSubscription(
                $this->user,
                $this->selectedPlan,
                BillingCycle::from($this->selectedBillingCycle)
            );

            // Associate subscription with transaction
            $userSubscription->update([
                'transaction_id' => $transaction->id,
            ]);

            DB::commit();

            // Process payment with gateway
            $response = $this->paystack->process(
                $this->selectedPlan,
                route('user.dashboard'),
                route('user.dashboard'),
                $this->appliedCoupon
            );

            if ($response === null) {
                throw new \Exception('Payment gateway processing failed');
            }

            $data = json_decode($response->getContent(), true);

            // Update transaction with payment gateway reference
            $transaction->update([
                'meta->payment_url' => $data['data']['invoice_url'] ?? null,
                'processor_reference' => $data['data']['transaction_id'] ?? null
            ]);

            // Store processor subscription code if returned
            if (isset($data['data']['subscription_code'])) {
                $userSubscription->update([
                    'processor_subscription_code' => $data['data']['subscription_code'],
                ]);
            }

            // Send confirmation email
            $message = $this->messageService->getPaymentInitiatedMessage(
                $transaction->amount / 100,
                $transaction->reference,
                'Account Subscription - ' . $this->selectedPlan->name
            );

            $this->emailService->send(
                Auth::user()->email,
                $message['subject'],
                $message['payload']
            );

            // Redirect to payment URL
            if (isset($data['data']['invoice_url'])) {
                $this->redirect($data['data']['invoice_url']);
            } else {
                alert('error', 'Payment gateway did not return an invoice URL');
            }
        } catch (\Exception $e) {
            Log::error('Subscription payment error', [
                'user_id' => Auth::id(),
                'plan_id' => $this->selectedPlan?->id,
                'error' => $e->getMessage(),
            ]);

            DB::rollBack();
            alert('error', 'Payment processing failed. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.subscription.subscription-payment-router', [
            'plans' => $this->plans,
            'selectedPlan' => $this->selectedPlan,
            'finalPrice' => $this->getFinalPriceProperty(),
            'user' => $this->user,
        ]);
    }
}
