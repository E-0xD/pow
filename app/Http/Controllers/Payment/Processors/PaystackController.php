<?php

namespace App\Http\Controllers\Payment\Processors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PaystackController extends Controller
{
    public function process($subscription_id, $plan, $successUrl, $cancelUrl)
    {
        try {
            $response = Http::withToken(config('paystack.secret'))
                ->post(config('paystack.url') . "initialize", [
                    'email' => Str::random(8).'-'.Auth::user()->email,
                    "amount" => "500000",
                    'plan' => $plan->paystack_plan_code,
                    'callback_url' => $successUrl,
                    'metadata' => [
                        'subscription_id' => $subscription_id,
                        'cancel_url' => $cancelUrl
                    ]
                ]);

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
            Log::error($th);
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
            Log::error($th);
            return response()->json([
                'success' => false,
                'message' => 'Payment validation failed',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
