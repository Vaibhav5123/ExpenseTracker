<?php

namespace App\Services;

use App\Interfaces\TransactionsRepositoryInterface;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\CategoryBudget;
use App\Notifications\BudgetExceededNotification;
use App\Models\User;
use Illuminate\Support\Facades\Notification;

class TransactionService
{
    use SoftDeletes;

    protected $transactionModel;

    public function __construct(TransactionsRepositoryInterface $transaction)
    {
        $this->transactionModel = $transaction;
    }

    public function all(Request $request) 
    {
        $categoryType = $request['type'];
        $categoryId = $request['category_id'];
        $startDate = $request['startDate'];
        $endDate = $request['endDate']; 
        $userId = Auth::id();

        $query = Transaction::with('category')
        ->where('user_id', $userId);

        if ($categoryType) {
            $query->whereHas('category', fn($q) => $q->where('type', $categoryType));
        }

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        if ($startDate) {
            $query->where('date', '>=', $startDate);
        }

        if ($endDate) {
            $query->where('date', '<=', $endDate);
        }

        $transactions = $query->orderBy('date', 'desc')->paginate(10);

        return $transactions; 
    }

    public function find($id) 
    { 
        return Transaction::with('category')->findOrFail($id); 
    }

    public function create($data) 
    { 
        $data['user_id'] = Auth::id();
        $transaction = $this->transactionModel->create($data);

        $user = Auth::user();
        $categoryId = $transaction->category_id;

        $totalSpent = Transaction::where('user_id', $user->id)
            ->where('category_id', $categoryId)
            ->sum('amount');

        $budget = CategoryBudget::where('user_id', $user->id)
            ->where('category_id', $categoryId)
            ->first();
           
        if ($budget && $totalSpent > $budget->budget) {
            Notification::send($user, new BudgetExceededNotification(
                $transaction->category->name,
                $totalSpent,
                $budget->budget
            ));
        }

        return $transaction; 
    }

    public function update($id, $data) 
    { 
        $transaction = $this->transactionModel->update($id, $data);

        return $transaction; 
    }

    public function delete($id) 
    { 
        $transaction =  Transaction::findOrFail($id);
        return $transaction->delete(); 
    }
}
