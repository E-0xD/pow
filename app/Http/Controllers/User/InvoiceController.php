<?php

namespace App\Http\Controllers\User;

use App\Enums\TransactionStatus;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    private function getTransactionByReference(string $reference)
    {
        $transaction = Transaction::where('reference', $reference)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return $transaction;
    }

    public function show(string $reference)
    {
        $transaction = $this->getTransactionByReference($reference);
        $transactionStatus = TransactionStatus::class;

        return view('user.invoice.show', compact('transaction', 'transactionStatus'));
    }

  
}
