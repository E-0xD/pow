<?php

namespace App\Http\Controllers\Payment\Processors;

use App\Http\Controllers\Controller;
use App\Services\CouponService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PaystackController extends Controller
{

    protected $couponService;

    public function __construct()
    {
        $this->couponService = new CouponService();
    }

    public function process($subscription_id, $plan, $successUrl, $cancelUrl, $couponCode = null)
    {
        try {
            $amount = ($plan->price * 1500) * 100; // Convert to kobo
            $extraMonths = 0;
            $freeMonths = 0;
            $extraMonths = 0;

            if ($couponCode) {
                $coupon = $this->couponService->findValidCoupon($couponCode);
                if ($coupon) {
                    $applied = $this->couponService->applyCouponToPlan($coupon, $plan);
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
                'email' => Str::random(8) . '-' . Auth::user()->email,
                'amount' => (int) $amount,
                'callback_url' => $successUrl,
                'metadata' => [
                    'subscription_id' => $subscription_id,
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
