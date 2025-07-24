<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\CategoryType;

class Article extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'link',
        'description',
        'category_id',
        'type',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class)
            ->where('type', CategoryType::ARTICLE->value);
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