<?php

namespace App\Services\Transactions;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TransactionService
{

    public function getTransactions(Request $request): LengthAwarePaginator
    {
        $query = Transaction::query();

        if ($request->has('type') && $request->input('type') !== null) {
            $query->where('type', $request->input('type'));
        }

        return $query->paginate(perPage: 15);
    }

    public function createTransaction(array $data): Transaction
    {
        $data['amount'] = $this->adjustAmount(amount: $data['amount'], type: $data['type']);

        return Transaction::create($data);
    }

    public function updateTransaction(Transaction $transaction, array $data): Transaction
    {
        $data['amount'] = $this->adjustAmount(amount: $data['amount'], type: $data['type']);

        $transaction->update($data);

        return $transaction;
    }

    private function adjustAmount(float $amount, string $type): float
    {
        if ($type === 'expense') {
            return -abs(num: $amount);
        }

        return abs(num: $amount);

    }

}

