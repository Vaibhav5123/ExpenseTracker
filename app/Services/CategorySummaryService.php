<?php

namespace App\Services;

use App\Interfaces\CategorySummaryInterface;
use App\Models\Category;
use Illuminate\Support\Collection;

class CategorySummaryService implements CategorySummaryInterface
{

    public function getCategorySummaries(int $userId, ?string $startDate = null, ?string $endDate = null): Collection
    {
        $categories = Category::whereNull('user_id')
            ->orWhere('user_id', $userId)
            ->with(['transactions' => function ($query) use ($userId, $startDate, $endDate) {
                $query->where('user_id', $userId);

                if ($startDate) {
                    $query->where('date', '>=', $startDate);
                }

                if ($endDate) {
                    $query->where('date', '<=', $endDate);
                }
            }])
            ->get()
            ->filter(function ($category) {
                return $category->transactions->isNotEmpty(); 
            });

        return $categories->map(function ($category) {
            return [
                'category_name' => $category->name,
                'category_type' => $category->type,
                'total_amount' => $category->transactions->sum('amount'),
                'transaction_count' => $category->transactions->count(),
            ];
        });
    }


}
