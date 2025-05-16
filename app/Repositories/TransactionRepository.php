<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Interfaces\TransactionsRepositoryInterface;

class TransactionRepository implements TransactionsRepositoryInterface
{
    
    public function all($data) 
    { 
        return Transaction::all($data); 
    }

    public function find($id) 
    { 
        return Transaction::findOrFail($id); 
    }

    public function create(array $data) 
    { 
        return Transaction::create($data); 
    }

    public function update($id, array $data)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update($data);
        return $transaction;
    }

    public function delete($id)
    {
        $transaction = Transaction::findOrFail($id);
        return $transaction->delete();
    }
}
