<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use App\Enums\TransactionStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with('user', 'payable');

        // Search by reference, processor_reference, user email/name
        if ($search = $request->query('q')) {
            $query->where(fn($q) => 
                $q->where('reference', 'like', "%{$search}%")
                    ->orWhere('processor_reference', 'like', "%{$search}%")
                    ->orWhereHas('user', fn($u) => $u->where('email', 'like', "%{$search}%")->orWhere('name', 'like', "%{$search}%"))
            );
        }

        // Filter by status
        if ($status = $request->query('status')) {
            $query->where('status', $status);
        }

        // Date range filter
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        $transactions = $query->latest()->paginate(15)->withQueryString();

        // Get summary data
        $summary = $this->getSummary($startDate, $endDate);

        $statuses = TransactionStatus::cases();

        return view('admin.transaction.index', compact('transactions', 'summary', 'statuses'));
    }

    public function getSummary($startDate = null, $endDate = null)
    {
        $query = Transaction::query();

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        $summary = [
            'total_amount' => $query->sum('amount'),
            'by_status' => []
        ];

        foreach (TransactionStatus::cases() as $status) {
            $amount = (clone $query)->where('status', $status->value)->sum('amount');
            $count = (clone $query)->where('status', $status->value)->count();

            $summary['by_status'][$status->value] = [
                'amount' => $amount,
                'count' => $count,
                'label' => $status->label(),
                'color' => $status->color(),
                'textColor' => $status->textColor()
            ];
        }

        return $summary;
    }

    public function updateStatus(TransactionRequest $request, Transaction $transaction)
    {
        try {
            $data = $request->validated();
            $transaction->update(['status' => $data['status']]);

            alert(type: 'success', message: 'Transaction status updated successfully.');
            return redirect()->back();
        } catch (\Throwable $th) {
            alert(type: 'error', message: 'Failed to update transaction status.');
            \Illuminate\Support\Facades\Log::error('Transaction status update failed', [
                'transaction_id' => $transaction->id,
                'error' => $th->getMessage()
            ]);
            return redirect()->back();
        }
    }
}
