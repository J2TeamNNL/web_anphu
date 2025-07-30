<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\CategoryType;

class Price extends Model
{
    protected $fillable = [
        'name',
        'price',
        'unit',
        'description',
        'category_id',
        'type',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class)
            ->where('type', CategoryType::PRICE->value);
    }
}
