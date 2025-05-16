<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MonthlyReportResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'month' => $this->month,
            'year' => $this->year,
            'user' => [
                'name' => $this->user->name,
                'email' => $this->user->email,
            ],
            'totals' => [
                'income' => $this->totals['Income'],
                'expense' => $this->totals['Expense'],
                'saving' => $this->totals['Saving'],
            ],
            'categories' => $this->report->map(function ($item) {
                return [
                    'label' => $item['category'],
                    'type' => $item['type'],
                    'value' => $item['total'],
                ];
            }),
            'transactions' => $this->transactions->map(function ($txn) {
                return [
                    'date' => $txn->date->format('Y-m-d'),
                    'description' => $txn->description,
                    'category' => $txn->category->name,
                    'type' => $txn->category->type,
                    'amount' => $txn->amount,
                ];
            }),
        ];
    }
}
