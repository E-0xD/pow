<?php

namespace App\Http\Controllers\Payment\Processors;

use App\Http\Controllers\Controller;
use App\Services\CouponService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaystackController extends Controller
{

    protected $couponService;

    public function __construct()
    {
        $this->couponService = new CouponService();
    }

    public function process($plan, $successUrl, $cancelUrl, $couponCode = null)
    {
        try {
            $amount = ($plan->price * 1500) * 100; // Convert to kobo
            $extraMonths = 0;
            $freeMonths = 0;
            $extraMonths = 0;


            if ($couponCode) {
                $applied = $this->couponService->applyCouponToPlan($couponCode, $plan);
                if ($applied['valid']) {
                    $amount = ($applied['discounted_price'] * 1500) * 100;
                    $extraMonths = $applied['extra_months'];
                    $freeMonths = $applied['free_months'];
                }
            }

            // For free months, charge minimum 50 NGN and don't use Paystack trial
            if ($freeMonths > 0) {
                $amount = 50 * 100; // 50 NGN in kobo
                $extraMonths = 0; // Don't use trial for free months
            }

            $payload = [
                'email' => Auth::user()->email,
                'amount' => (int) $amount,
                'callback_url' => $successUrl,
                'metadata' => [
                    'user_id' => Auth::id(),
                    'cancel_url' => $cancelUrl,
                    'coupon_code' => $couponCode,
                    'plan_code' => $plan->paystack_plan_code,
                    'plan_duration' => $plan->duration,
                    'free_months' => $freeMonths,
                    'extra_months' => $extraMonths,
                ]
            ];

            if (!$couponCode) {
                $payload['plan'] = $plan->paystack_plan_code;
            }


            $response = Http::withToken(config('paystack.secret'))
                ->post(config('paystack.url') . "transaction/initialize", $payload);

            if (!$response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment service unavailable'
                ], 503);
            }

            $authorizationUrl = $response->json('data.authorization_url');
            if (!$authorizationUrl) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid payment response'
                ], 422);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'invoice_url' => $authorizationUrl,
                    'transaction_id' => $response->json('data.reference'),
                ]
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), ['exception' => $th]);
            return response()->json([
                'success' => false,
                'message' => 'Payment initialization failed',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Get subscription management link
     */
    public function getSubscriptionManagementLink($subscriptionCode)
    {
        try {
            $response = Http::withToken(config('paystack.secret'))
                ->get(config('paystack.url') . "subscription/{$subscriptionCode}/manage/link");

            if (! $response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unable to get subscription management link',
                ], 503);
            }

            return response()->json([
                'success' => true,
                'message' => 'Subscription management link retrieved successfully',
                'data' => $response->json('data'),
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), ['exception' => $th]);

            return response()->json([
                'success' => false,
                'message' => 'Subscription management link retrieval failed',
            ], 500);
        }
    }


    /**
     * Enable a Paystack subscription
     */
    public function enableSubscription($subscriptionCode, $token)
    {
        try {
            $response = Http::withToken(config('paystack.secret'))
                ->post(config('paystack.url') . "subscription/enable", [
                    'code' => $subscriptionCode,
                    'token' => $token,
                ]);

            if (! $response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unable to enable subscription',
                ], 503);
            }

            return response()->json([
                'success' => true,
                'message' => 'Subscription enabled successfully',
                'data' => $response->json('data'),
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), ['exception' => $th]);

            return response()->json([
                'success' => false,
                'message' => 'Subscription enable failed',
            ], 500);
        }
    }


    /**
     * Disable a Paystack subscription
     */
    public function disableSubscription($subscriptionCode, $token)
    {
        try {
            $response = Http::withToken(config('paystack.secret'))
                ->post(config('paystack.url') . "subscription/disable", [
                    'code' => $subscriptionCode,
                    'token' => $token,
                ]);

            if (! $response->successful()) {
                Log::error($response);
                return response()->json([
                    'success' => false,
                    'message' => 'Unable to disable subscription',
                ], 503);
            }

            return response()->json([
                'success' => true,
                'message' => 'Subscription disabled successfully',
                'data' => $response->json('data'),
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), ['exception' => $th]);

            return response()->json([
                'success' => false,
                'message' => 'Subscription disable failed',
            ], 500);
        }
    }



    /**
     * Get customer information from Paystack
     */
    public function getCustomer($emailOrCode)
    {
        try {
            $response = Http::withToken(config('paystack.secret'))
                ->get(config('paystack.url') . "customer/{$emailOrCode}");

            if (! $response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unable to retrieve customer information',
                ], 503);
            }

            return response()->json([
                'success' => true,
                'message' => 'Customer retrieved successfully',
                'data' => $response->json('data'),
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), ['exception' => $th]);

            return response()->json([
                'success' => false,
                'message' => 'Customer retrieval failed',
            ], 500);
        }
    }


    /**
     * Update customer information on Paystack
     */
    public function updateCustomer($customerCode, array $data)
    {
        try {
            $response = Http::withToken(config('paystack.secret'))
                ->put(config('paystack.url') . "customer/{$customerCode}", $data);

            if (! $response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unable to update customer',
                ], 503);
            }

            return response()->json([
                'success' => true,
                'message' => 'Customer updated successfully',
                'data' => $response->json('data'),
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), ['exception' => $th]);

            return response()->json([
                'success' => false,
                'message' => 'Customer update failed',
            ], 500);
        }
    }


    /**
     * Get subscription details from Paystack
     */
    public function getSubscription(String $subscriptionIdOrCode)
    {
        try {
            $response = Http::withToken(config('paystack.secret'))
                ->get(config('paystack.url') . "subscription/{$subscriptionIdOrCode}");

            if (! $response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unable to retrieve subscription',
                ], 503);
            }

            return response()->json([
                'success' => true,
                'message' => 'Subscription retrieved successfully',
                'data' => $response->json('data'),
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), ['exception' => $th]);

            return response()->json([
                'success' => false,
                'message' => 'Subscription retrieval failed',
            ], 500);
        }
    }

    /**
     * Create a subscription on Paystack
     */
    public function createSubscription($customerEmailOrCode, $planIdOrCode, $startDate = null)
    {
        try {
            $payload = [
                'customer' => $customerEmailOrCode,
                'plan' => $planIdOrCode,
            ];

            // Only add start_date if provided
            if ($startDate) {
                $payload['start_date'] = $startDate;
            }

            $response = Http::withToken(config('paystack.secret'))
                ->post(config('paystack.url') . "subscription", $payload);

            if (! $response->successful()) {
                Log::error($response);
                return response()->json([
                    'success' => false,
                    'message' => 'Unable to create subscription',
                ], 503);
            }

            return response()->json([
                'success' => true,
                'message' => 'Subscription created successfully',
                'data' => $response->json('data'),
            ], 200);

        } catch (\Throwable $th) {
            Log::error($th->getMessage(), ['exception' => $th]);

            return response()->json([
                'success' => false,
                'message' => 'Subscription creation failed',
            ], 500);
        }
    }

    /**
     * Manual validation endpoint
     */
    public function validate(Request $request)
    {
        $reference = $request->query('reference');

        if (!$reference) {
            return response()->json([
                'success' => false,
                'message' => 'Reference is required'
            ], 422);
        }

        try {
            $response = Http::withToken(config('paystack.secret'))
                ->get(config('paystack.url') . "/verify/{$reference}");

            if (!$response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unable to verify payment'
                ], 503);
            }

            $data = $response->json('data');

            if (!$data) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid payment data received'
                ], 422);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'status' => $data['status'],
                    'amount' => $data['amount'] / 100,
                    'reference' => $data['reference'],
                    'customer_email' => $data['customer']['email'] ?? null,
                    'plan_code' => $data['plan_object']['plan_code'] ?? null,
                    'subscription_code' => $data['subscription_code'] ?? null,
                ]
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), ['exception' => $th]);
            return response()->json([
                'success' => false,
                'message' => 'Payment validation failed',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
