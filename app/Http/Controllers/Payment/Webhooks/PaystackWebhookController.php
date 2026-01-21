<?php

namespace App\Http\Controllers\Payment\Webhooks;

use App\Enums\BillingCycle;
use App\Enums\TransactionStatus;
use App\Enums\UserSubscriptionStatus;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\User;
use App\Models\UserSubscription;
use App\Models\PaystackCustomer;
use App\Models\Transaction;
use App\Services\EmailService;
use App\Services\MessageService;
use App\Services\SubscriptionService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class PaystackWebhookController extends Controller
{
    protected $emailService;
    protected $messageService;

    public function __construct()
    {
        $this->emailService = new EmailService();
        $this->messageService = new MessageService(new Agent());
    }

    public function __invoke(Request $request)
    {

        $data = $request->json()->all();
        Log::info('Paystack Webhook Received:', $data);

        $event = $data['event'] ?? null;
        $payload = $data['data'] ?? [];

        try {
            if ($event == 'charge.success' && !isset($payload['plan']['id'])) {
                $this->handleChargeSuccess($payload);
            }

            if ($event == 'subscription.create') {
                $this->handleSubscriptionActivation($payload);
            }

            if ($event == 'subscription.not_renew') {
                $this->handleCancelSubscription($payload);
            }

            if ($event == 'invoice.update') {
                $this->handleInvoiceUpdate($payload);
            }

            return response()->json(['status' => 'ok'], Response::HTTP_OK);
        } catch (\Throwable $th) {

            Log::error('Paystack webhook error: ' . $th);


            $user = User::where('email', $payload['customer']['email'])->first();

            if ($user) {
                app(new SubscriptionService())->revertToFreeWhenError($user);
            }


            return response()->json(['status' => 'ok'], Response::HTTP_OK);
        }
    }


    /**
     * Find user by Paystack customer code and ID, or by email
     * Creates a new user and links to PaystackCustomer table if not found
     *
     * @param array $paystackCustomer Customer data from Paystack webhook
     * @return User
     */
    protected function findOrCreateUserWithPaystackCustomer(array $paystackCustomer): User
    {
        $paystackCustomerId = $paystackCustomer['id'] ?? null;
        $paystackCustomerCode = $paystackCustomer['customer_code'] ?? null;
        $email = $paystackCustomer['email'] ?? null;

        if ((!$paystackCustomerId && !$paystackCustomerCode) || !$email) {
            Log::warning('Missing required Paystack customer data', $paystackCustomer);
            throw new \Exception("Missing required Paystack customer data", 1);
        }

        // Try to find user via PaystackCustomer table using customer code and ID
        $paystackCustomerRecord = PaystackCustomer::where('paystack_customer_id', $paystackCustomerId)
            ->orWhere('paystack_customer_code', $paystackCustomerCode)
            ->first();

        if ($paystackCustomerRecord) {
            Log::info("User found via PaystackCustomer table", [
                'user_id' => $paystackCustomerRecord->user_id,
                'paystack_customer_id' => $paystackCustomerId
            ]);

            return $paystackCustomerRecord->user;
        }

        // Try to find user by email
        $user = User::where('email', $email)->first();

        if ($user) {
            // Check if user already has a PaystackCustomer record
            $existingRecord = $user->paystackCustomer;

            if (!$existingRecord) {
                // Create PaystackCustomer record
                $user->paystackCustomer()->create([
                    'paystack_customer_id' => $paystackCustomerId,
                    'paystack_customer_code' => $paystackCustomerCode,
                ]);

                Log::info("PaystackCustomer record created for existing user", [
                    'user_id' => $user->id,
                ]);
            }

            return $user;
        }

        Log::error($paystackCustomer);
        throw new \Exception("User not Found", 1);
    }

    /**
     * Handle charge success - initial purchase
     * Creates recurring subscription if coupon was applied (charge-only scenario)
     * Also manages subscription statuses: cancels active, fails other pending
     */
    protected function handleChargeSuccess(array $payload)
    {

        $user = $this->findOrCreateUserWithPaystackCustomer($payload['customer']);

        $planCode = $payload['metadata']['plan_code'] ?? null;
        $freeMonths = (int) ($payload['metadata']['free_months'] ?? 0);
        $extraMonths = (int) ($payload['metadata']['extra_months'] ?? 0);


        // Get latest pending subscription for this user
        $subscription = UserSubscription::where('user_id', $user->id)
            ->where('status', UserSubscriptionStatus::PENDING)
            ->latest('id')
            ->first();

        // If no pending subscription, get the latest one
        if (!$subscription) {
            $subscription = UserSubscription::where('user_id', $user->id)
                ->latest('id')
                ->first();
        }

        // Cancel any active subscriptions for this user
        UserSubscription::where('user_id', $user->id)
            ->where('status', UserSubscriptionStatus::ACTIVE)
            ->update(['status' => UserSubscriptionStatus::CANCELLED]);

        // Mark any other pending subscriptions as failed
        UserSubscription::where('user_id', $user->id)
            ->where('status', UserSubscriptionStatus::PENDING)
            ->where('id', '!=', $subscription?->id)
            ->update(['status' => UserSubscriptionStatus::FAILED]);

        if (!$subscription) {
            Log::warning("UserSubscription not found for user {$user->id}");
            return;
        }

        // Update transaction status
        if ($subscription->transaction) {
            $subscription->transaction->update(['status' => TransactionStatus::SUCCESSFUL]);
        }

        // If coupon was applied, plan_code won't be in the charge payload
        // Create delayed recurring subscription to start after free/extra months
        if ($planCode && ($freeMonths > 0 || $extraMonths > 0)) {
            $this->createRecurringSubscription(
                $payload,
                $planCode,
                $freeMonths,
                $extraMonths
            );
        }

        Log::info("Charge successful for user {$user->id}");
    }

    /**
     * Handle subscription activation - triggered after initial charge or Paystack subscription created
     * Also manages subscription statuses: cancels active, fails other pending
     */
    protected function handleSubscriptionActivation(array $payload)
    {

        $user = $this->findOrCreateUserWithPaystackCustomer($payload['customer']);

        $message = $this->messageService->getSubscriptionActivationFailedMessage($user);

        $emailToken = $payload['email_token'] ?? null;
        $subscriptionCode = $payload['subscription_code'] ?? null;
        $nextPaymentDate = $payload['next_payment_date'] ?? null;

        if (!$emailToken || !$subscriptionCode) {
            Log::warning('Missing required data in subscription.create', [
                'emailToken' => $emailToken,
                'subscription_code' => $subscriptionCode
            ]);

            $this->emailService->send(
                $user->email,
                $message['subject'],
                $message['payload']
            );

            throw new \Exception("Missing required data in subscription.create", 1);

            return;
        }


        $subscription = $user->subscriptions()
            ->where('status', UserSubscriptionStatus::PENDING)
            ->latest('id')
            ->first();

        if ($subscription) {
            // Cancel any active subscriptions for this user
            UserSubscription::where('user_id', $subscription->user_id)
                ->where('status', UserSubscriptionStatus::ACTIVE)
                ->update(['status' => UserSubscriptionStatus::CANCELLED]);

            // Mark any other pending subscriptions as failed
            UserSubscription::where('user_id', $subscription->user_id)
                ->where('status', UserSubscriptionStatus::PENDING)
                ->where('id', '!=', $subscription->id)
                ->update(['status' => UserSubscriptionStatus::FAILED]);
        }

        if (!$subscription) {
            Log::warning("User Subscription not found for email " . $payload['customer']['email']);

            $this->emailService->send(
                $user->email,
                $message['subject'],
                $message['payload']
            );

            throw new \Exception("User Subscription not found for email " . $user->email, 1);

            return;
        }

        // Calculate expiration date from next payment date
        $expiresAt = $nextPaymentDate ? Carbon::parse($nextPaymentDate) : now()->addMonth();

        // Update subscription with Paystack details
        $subscription->update([
            'status' => UserSubscriptionStatus::ACTIVE,
            'purchased_at' => now(),
            'expires_at' => $expiresAt,
            'processor_subscription_code' => $subscriptionCode,
            'processor_email_token' => $emailToken
        ]);

        if ($subscription->transaction) {
            $subscription->transaction->update(['status' => TransactionStatus::SUCCESSFUL]);
        }

        Log::info("Subscription activated for user {$subscription->user_id}", [
            'expires_at' => $expiresAt,
            'subscription_code' => $subscriptionCode
        ]);

        $message = $this->messageService->getPaymentSuccessMessage($user, $subscription->transaction->amount, $subscription->transaction->reference);

        $this->emailService->send(
            $user->email,
            $message['subject'],
            $message['payload']
        );
    }

    /**
     * Create delayed recurring subscription (for coupon scenarios)
     * Starts after initial charge + free/extra months
     */
    protected function createRecurringSubscription(
        array $payload,
        string $planCode,
        int $freeMonths,
        int $extraMonths
    ) {
        $planDuration = (int) ($payload['metadata']['plan_duration'] ?? 30);
        $startDays = $planDuration;

        if ($freeMonths > 0) {
            $startDays += $freeMonths * 30;
        }

        if ($extraMonths > 0) {
            $startDays += $extraMonths * 30;
        }

        $subscriptionStartDate = now()->addDays($startDays);

        $subPayload = [
            'customer' => $payload['customer']['customer_code'],
            'plan' => $planCode,
            'start_date' => $subscriptionStartDate->toIso8601String(),
        ];

        $response = Http::withToken(config('paystack.secret'))
            ->post(config('paystack.url') . 'subscription', $subPayload);

        if ($response->successful()) {
            Log::info('Recurring subscription created successfully', [
                'subscription_code' => $response->json('data.subscription_code'),
                'start_date' => $subscriptionStartDate
            ]);
        } else {
            Log::error('Failed to create recurring subscription', [
                'response' => $response->json(),
                'payload' => $subPayload
            ]);

            throw new \Exception("Failed to create recurring subscription", 1);
        }
    }

    protected function handleCancelSubscription(array $payload)
    {
        $user = $this->findOrCreateUserWithPaystackCustomer($payload['customer']);;

        if (!$user) {
            Log::warning($user . 'user not found');
            throw new \Exception("user not found", 1);
            return null;
        }

        $subscription = $user->subscriptions()->where('status', UserSubscriptionStatus::ACTIVE)->latest()->first();

        if (!$subscription) {
            Log::warning("UserSubscription not found for email " . $payload['customer']['email']);
            $message = $this->messageService->getSubscriptionCancellationFailedMessage($user);

            $this->emailService->send(
                $user->email,
                $message['subject'],
                $message['payload']
            );

            throw new \Exception("UserSubscription not found for email " . $payload['customer']['email'], 1);
            return;
        }

        $subscription->update([
            'status' => UserSubscriptionStatus::CANCELLED
        ]);

        $message = $this->messageService->getSubscriptionCancelledMessage($user, $subscription->plan->name);

        $this->emailService->send(
            $user->email,
            $message['subject'],
            $message['payload']
        );
    }

    /**
     * Handle invoice update - subscription renewal
     * Marks the current active subscription as renewed and creates a new active subscription
     */
    protected function handleInvoiceUpdate(array $payload)
    {
        // Find or create user with Paystack customer data
        $user = $this->findOrCreateUserWithPaystackCustomer($payload['customer']);

        $subscriptionCode = $payload['subscription']['subscription_code'] ?? null;
        $nextPaymentDate = $payload['subscription']['next_payment_date'] ?? null;
        $invoiceAmount = $payload['amount'] ?? null;
        $transactionReference = $payload['transaction']['reference'] ?? null;
        $paidAt = $payload['paid_at'] ?? null;

        if (!$subscriptionCode || !$invoiceAmount || !$transactionReference) {
            Log::warning('Missing required data in invoice.update', [
                'subscription_code' => $subscriptionCode,
                'amount' => $invoiceAmount,
                'reference' => $transactionReference
            ]);

            throw new \Exception("Missing required data in invoice.update", 1);
        }

        // Find the current active subscription
        $activeSubscription = $user->subscriptions()
            ->where('status', UserSubscriptionStatus::ACTIVE)
            ->latest('id')
            ->first();

        if (!$activeSubscription) {
            Log::warning("No active subscription found for renewal", [
                'user_id' => $user->id,
                'subscription_code' => $subscriptionCode
            ]);

            throw new \Exception("No active subscription found for renewal", 1);
        }

        // Get the email token from the active subscription to carry forward
        $emailToken = $activeSubscription->processor_email_token;

        // Update current active subscription to RENEWED
        $activeSubscription->update([
            'status' => UserSubscriptionStatus::RENEWED,
        ]);

        Log::info("Subscription marked as renewed", [
            'subscription_id' => $activeSubscription->id,
            'user_id' => $user->id
        ]);

        // Calculate expiration date for new subscription
        $expiresAt = $nextPaymentDate ? Carbon::parse($nextPaymentDate) : now()->addMonth();

        // Create new active subscription
        $newSubscription = $user->subscriptions()->create([
            'plan_id' => $activeSubscription->plan_id,
            'status' => UserSubscriptionStatus::ACTIVE,
            'purchased_at' => $paidAt ? Carbon::parse($paidAt) : now(),
            'expires_at' => $expiresAt,
            'processor_subscription_code' => $subscriptionCode,
            'processor_email_token' => $emailToken,
            'billing_cycle' => $activeSubscription->billing_cycle,
        ]);

        Log::info("New subscription created for renewal", [
            'subscription_id' => $newSubscription->id,
            'user_id' => $user->id,
            'expires_at' => $expiresAt
        ]);

        // Create transaction record for the renewal
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'amount' => $activeSubscription->plan->price,
            'status' => TransactionStatus::SUCCESSFUL,
            'gateway' => 'paystack',
            'reference' => $transactionReference,
            'processor_reference' => $subscriptionCode,
            'payable_type' => Plan::class,
            'payable_id' =>  $activeSubscription->plan_id,
            'meta' => [
                'invoice_code' => $payload['invoice_code'] ?? null,
                'period_start' => $payload['period_start'] ?? null,
                'period_end' => $payload['period_end'] ?? null,
            ]
        ]);

        $newSubscription->update([
            'transaction_id' => $transaction->id
        ]);

        Log::info("Renewal transaction created", [
            'transaction_id' => $transaction->id,
            'user_id' => $user->id,
            'amount' => $invoiceAmount
        ]);

        // Send renewal success email
        $message = $this->messageService->getPaymentSuccessMessage($user, $invoiceAmount, $transactionReference);

        $this->emailService->send(
            $user->email,
            $message['subject'],
            $message['payload']
        );
    }
}
