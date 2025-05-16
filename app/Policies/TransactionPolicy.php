<?php

namespace App\Policies;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TransactionPolicy
{
    public function view(User $user, Transaction $transaction)
    {
        return $user->id === $transaction->user_id;
    }

    public function update(User $user, Transaction $transaction)
    {
        return $user->id === $transaction->user_id;
    }

    public function delete(User $user, Transaction $transaction)
    {
        return $user->id === $transaction->user_id;
    }
    
    public function viewAny(User $user): bool
    {
        return true;
    }


    public function create(User $user): bool
    {
        return true;
    }

    
    public function restore(User $user, Transaction $transaction): bool
    {
        return false;
    }


    public function forceDelete(User $user, Transaction $transaction): bool
    {
        return false;
    }
}
