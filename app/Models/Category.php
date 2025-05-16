<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'type',
        'user_id',
    ];

    public function budgets()
    {
        return $this->hasMany(CategoryBudget::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

}
