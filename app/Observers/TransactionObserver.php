<?php

namespace App\Observers;

use App\Transaction;

class TransactionObserver
{
    public function creating(Transaction $transaction): void
    {
        if ($transaction->amount > 0) {
            $customer = $transaction->customer()->first();
            $depositCount = $customer->transactions()->where('amount', '>', 0)->count() + 1;

            if ($depositCount % config('transaction.bonus.modulo_number') === 0) {
                $transaction->bonus_amount = $transaction->amount * ($customer->bonus / 100);
            }
        }
    }
}
