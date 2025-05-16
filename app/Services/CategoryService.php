<?php

namespace App\Services;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use App\Models\CategoryBudget;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class CategoryService
{
    use SoftDeletes;

    protected $categoryModel;

    public function __construct(CategoryRepositoryInterface $category)
    {
        $this->categoryModel = $category;
    }

    public function all() 
    { 
        $userId = Auth::id();

        $categories = Category::with('budgets')
        ->where(function ($query) use ($userId) {
            $query->whereNull('user_id')
                  ->orWhere('user_id', $userId);
        })
        ->paginate(10);

        return $categories; 
    }

    public function find($id) 
    { 
        $userId = Auth::id();

        $category = Category::with([
            'transactions' => function ($query) use ($userId) {
                $query->where('user_id', $userId);
            },
                'budgets'
            ])->findOrFail($id);

        return $category;
    }

    public function create($data) 
    { 
        $data['user_id'] = Auth::id();
        $category = $this->categoryModel->create($data);

        if (isset($data['budget'])) {
            CategoryBudget::create([
                'user_id' => Auth::id(),
                'category_id' => $category->id,
                'budget' => $data['budget']
            ]);
        }

        return $category; 
    }

    public function update($id, $data) 
    { 
        $category = $this->categoryModel->update($id, $data);

        if (isset($data['budget'])) {
            CategoryBudget::updateOrCreate(
                ['category_id' => $id, 'user_id' => Auth::id()],
                ['budget' => $data['budget']]
            );
        }

        return $category; 
    }

    public function delete($id) 
    { 
        CategoryBudget::where('category_id', $id)->delete(); 
        $category =  Category::findOrFail($id);
        return $category->delete();
    }
}
