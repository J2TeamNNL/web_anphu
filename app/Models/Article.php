<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\CategoryType;
use Illuminate\Support\Str;

class Article extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'thumbnail_public_id',
        'link',
        'description',
        'category_id',
        'type',
        'content'
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

    public function media()
    {
        return $this->morphMany(Media::class, 'mediaable');
    }
}