<?php

namespace App\Http\Controllers\Payment\Processors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NowPaymentController extends Controller
{
    public function process($amount, $successUrl, $cancelUrl)
    {

        try {
            $response = Http::withHeaders([
                'x-api-key' => config('nowpayment.key'),
                'Content-Type' => 'application/json',
            ])->post(config('nowpayment.invoice_url'), [
                'price_amount' => (int) $amount,
                'price_currency' => "USD",
                'order_id' => uniqid(),
                'order_description' => config('app.name'),
                'success_url' => $successUrl,
                'cancel_url' => $cancelUrl,
                'is_fee_paid_by_user' => true,
            ]);

            if (!$response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment service unavailable'
                ], 503);
            }

            $invoiceUrl = $response->json('invoice_url');
            if (!$invoiceUrl) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid payment response'
                ], 422);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'invoice_url' => $invoiceUrl,
                    'transaction_id' => $response->json('id'),
                ]
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Payment initialization failed',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function validate(Request $request)
    {
        try {
            $response = Http::withHeaders([
                'x-api-key' => config('nowpayment.key'),
                'Content-Type' => 'application/json',
            ])->get(config('nowpayment.payment_url') . "/" . $request->query('NP_id'));

            if (!$response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unable to fetch payment details'
                ], 503);
            }


            $data = $response->json();
            $status = $data['payment_status'] ?? null;

            if (!$status) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid payment status received'
                ], 422);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'payment_status' => $data['payment_status'],
                    'transaction_id' => $data['invoice_id'],
                    'amount' => $data['price_amount']
                ],
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
