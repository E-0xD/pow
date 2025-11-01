<?php

namespace App\Http\Controllers\Payment\Processors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class PolarController extends Controller
{
    public function process($subscription_id, $productId, $successUrl, $cancelUrl)
    {
        $confirmationUrl = $successUrl . '?checkout_id={CHECKOUT_ID}';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('polar.access_token'),
            'Content-Type' => 'application/json',
        ])->post(config('polar.url') . '/checkouts/custom/', [
            'product_id' => $productId,
            'success_url' => $confirmationUrl,
            'cancel_url' => $cancelUrl,
            'payment_processor' => 'stripe',
            'metadata' => ['uid' => $subscription_id]
        ]);

        $data = $response->json();

        return response()->json([
            'success' => true,
            'data' => [
                'invoice_url' => $data['url'],
                'transaction_id' => $data['id'],
            ]
        ], 200);
    }


    public function validate(Request $request)
    {

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('POLAR_API_KEY'),
            'Content-Type' => 'application/json',
        ])->get(config('polar.url') . '/checkouts/custom/' . $request->query('checkout_id'));

         $data = $response->json();

        return response()->json([
            'success' => true,
             'data' => [
                'payment_status' => $data['status'],
                'transaction_id' => $data['id'],
                'amount' => $data['amount']/100
            ]
        ], 200);
       
    }
}
