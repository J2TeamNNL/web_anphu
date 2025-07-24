<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Enums\CategoryType;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'location',
        'client',
        'description',
        'year',        
        'image',
        'category_id',
        'type',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class)
            ->where('type', CategoryType::PORTFOLIO->value);
    }

    public function getCategoryNameAttribute()
    {
        return $this->category?->name ?? null;
    }

    public function getParentCategoryNameAttribute()
    {
        return $this->category?->parent?->name ?? null;
    }
}

