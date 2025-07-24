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
        'image',
        'link',
        'description',
        'category_id',
        'article_type_id',
    ];

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }
}