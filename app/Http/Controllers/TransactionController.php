<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TransactionService;
use App\Services\CategoryService;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\StoreTransactionRequest;

class TransactionController extends Controller
{
    use SoftDeletes, AuthorizesRequests;
    protected $transactionService;
    protected $categoryService;

    public function __construct(TransactionService $transactionService, CategoryService $categoryService)
    {
        $this->transactionService = $transactionService;
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $userId = Auth::id();

        $transactions = $this->transactionService->all($request);

        $categories = \App\Models\Category::whereNull('user_id')
        ->orWhere('user_id', $userId)
        ->get();

        $types = ['Income', 'Saving', 'Expense'];

        return view('transaction.transaction-view', compact('transactions','types','categories'));
    }

    public function create()
    {
        $categories = $this->categoryService->all();
        return view('transaction.transaction-add', compact('categories'));
    }

    public function store(StoreTransactionRequest $request)
    {
        $validated = $request->validated();

        $this->transactionService->create($validated);
        return redirect()->route('transaction.index')->with('success', 'Transaction added successfully.');
    }

    public function show($id)
    {
        $transaction = $this->transactionService->find($id);
        $this->authorize('view', $transaction);
        return view('transaction.transaction-show', compact('transaction'));
    }

    public function edit($id)
    {
        $transaction = $this->transactionService->find($id);
        $categories = $this->categoryService->all();

        $this->authorize('update', $transaction);

        return view('transaction.transaction-edit', compact('transaction', 'categories'));
    }

    public function update(StoreTransactionRequest $request, $id)
    {
        $validated = $request->validated();

        $this->transactionService->update($id, $validated);
        return redirect()->route('transaction.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy($id)
    {
        $this->transactionService->delete($id);
        return redirect()->route('transaction.index')->with('success', 'Transaction deleted.');
    }
}

