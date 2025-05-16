<?php

namespace App\Observers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Log;

class TransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     */
    public function created(Transaction $transaction): void
    {
        Log::info('Transaction Created', [
            'id' => $transaction->id,
            'user_id' => $transaction->user_id,
            'amount' => $transaction->amount,
            'date' => $transaction->date,
        ]);
    }

    /**
     * Handle the Transaction "updated" event.
     */
    public function updated(Transaction $transaction): void
    {
        Log::info('Transaction Updated', [
            'id' => $transaction->id,
            'user_id' => $transaction->user_id,
            'amount' => $transaction->amount,
            'date' => $transaction->date,
        ]);
    }

    /**
     * Handle the Transaction "deleted" event.
     */
    public function deleted(Transaction $transaction): void
    {
        Log::info('Transaction Deleted', [
            'id' => $transaction->id,
            'user_id' => $transaction->user_id,
            'amount' => $transaction->amount,
            'date' => $transaction->date,
        ]);
    }

    /**
     * Handle the Transaction "restored" event.
     */
    public function restored(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     */
    public function forceDeleted(Transaction $transaction): void
    {
        //
    }
}
