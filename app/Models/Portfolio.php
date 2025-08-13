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
        'area',
        'story',
        'client',
        'description',
        'year',        
        'thumbnail',
        'thumbnail_public_id',
        'category_id',
        'type',
        'content'
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

    public function media()
    {
        return $this->morphMany(Media::class, 'mediaable');
    }
}

