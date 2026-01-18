<?php

namespace App\Livewire\Settings;

use App\Enums\BillingCycle;
use App\Enums\TransactionStatus;
use App\Enums\UserSubscriptionStatus;
use App\Http\Controllers\Payment\Processors\PaystackController;
use App\Models\Plan;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Transaction;
use App\Models\UserSubscription;
use App\Services\EmailService;
use App\Services\MessageService;
use App\Services\SubscriptionService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.app')]
class Subscription extends Component
{
    public $transactions = [];
    public $userSubscription;
    protected $paystackController;
    protected SubscriptionService $subscriptionService;
    protected EmailService $emailService;
    protected MessageService $messageService;

    public function boot()
    {
        $this->paystackController = new PaystackController();
        $this->messageService = new MessageService(app(Agent::class));
        $this->emailService = new EmailService();
        $this->subscriptionService = new SubscriptionService();
    }

    public function mount()
    {
        $this->transactions = Transaction::where('user_id', Auth::id())
            ->where('status', TransactionStatus::SUCCESSFUL)
            ->latest()
            ->take(4)
            ->get();

        $this->userSubscription = UserSubscription::where('user_id', Auth::id())
            ->where('status', UserSubscriptionStatus::ACTIVE)
            ->with('plan')
            ->first();

        if (!$this->userSubscription) {
            $this->userSubscription = UserSubscription::where('user_id', Auth::id())
                ->Where('status', UserSubscriptionStatus::CANCELLED)->latest()
                ->with('plan')
                ->first();
        }
    }

    public function cancelSubcription()
    {
        if ($this->userSubscription->status == UserSubscriptionStatus::ACTIVE && $this->userSubscription->plan->price != null) {

            $response = $this->paystackController->disableSubscription(
                $this->userSubscription->processor_subscription_code,
                $this->userSubscription->processor_email_token
            );

            $data = json_decode($response->getContent(), true);

            if ($data['success'] != true) {
                Log::error($response);
                alert('error', 'Your subscription could not be cancelled, try again later');
                $this->redirect(route('user.subscription.manage'));
                return;
            }

            alert('info', 'Your subscription is being cancelled, you\'ll be notified on the status shortly');
            $this->redirect(route('user.subscription.manage'));
        }
    }



    public function reEnableSubcription()
    {
        if ($this->userSubscription->status == UserSubscriptionStatus::CANCELLED && $this->userSubscription->plan->price != null) {

            DB::beginTransaction();

            // Create transaction record
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'amount' => 0,
                'status' => TransactionStatus::PENDING,
                'gateway' => 'paystack',
                'reference' => 'SUB-' . uniqid(),
                'payable_type' => Plan::class,
                'payable_id' => $this->userSubscription->plan->id,
                'meta' => [
                    'original_price' => $this->userSubscription->plan->price,
                    'coupon_code' => null,
                    'subscription_type' => 'reactivation',
                    'billing_cycle' => $this->userSubscription->plan->billing_cycle,
                ]
            ]);

            // Create user subscription record
            $userSubscription = $this->subscriptionService->createSubscription(
                Auth::user(),
                $this->userSubscription->plan,
                $this->userSubscription->plan->billing_cycle
            );

            // Associate subscription with transaction
            $userSubscription->update([
                'transaction_id' => $transaction->id,
            ]);

            $response = $this->paystackController->createSubscription(
                Auth::user()->email,
                $this->userSubscription->plan->paystack_plan_code,
                formatDateToISO($this->userSubscription->expires_at)
            );

            $data = json_decode($response->getContent(), true);

            if ($data['success'] != true) {
                DB::rollBack();
                Log::error($response);
                alert('error', 'Your subscription could not be reativated, try again later');
                $this->redirect(route('user.subscription.manage'));
            }

            DB::commit();

            alert('success', 'Your subscription has been reactivated Successfully');
            $this->redirect(route('user.subscription.manage'));
        }
    }

    private function cardDetails()
    {

        try {


            if ($this->userSubscription->plan->price != null && $this->userSubscription->status == UserSubscriptionStatus::ACTIVE) {

                $response = $this->paystackController->getSubscription(
                    $this->userSubscription->processor_subscription_code
                );

                $data = json_decode($response->getContent(), true);
                Log::info($data);

                if ($data['success'] != true) {
                    Log::error($response);
                    return;
                }

                $authorization = $data['data']['authorization'];

                return [
                    'brand' => $authorization['card_type'],
                    'last4' => $authorization['last4'],
                    'exp_month' => $authorization['exp_month'],
                    'exp_year' => $authorization['exp_year']
                ];
            }

            Log::info(
                'processor_subscription_code is null or plan price is null',
                [
                    'plan_price' => $this->userSubscription->plan->price,
                    'status' => $this->userSubscription->status,
                ]
            );


            return null;
        } catch (\Throwable $th) {
            Log::error($th);
            return null;
        }
    }

    public function updateCard()
    {
        $response =  $this->paystackController->getSubscriptionManagementLink($this->userSubscription->processor_subscription_code);
        $data = json_decode($response->getContent(), true);
        $this->redirect($data['data']['link']);
    }

    public function render()
    {
        return view('livewire.settings.subscription', [
            'transactions' => $this->transactions,
            'userSubscription' => $this->userSubscription,
            'userSubscriptionStatus' => UserSubscriptionStatus::class,
            'cardDetails' => $this->cardDetails()
        ]);
    }
}
