<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

use App\Enums\CategoryType;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;
    use HasRecursiveRelationships;

    public $timestamps = true; 
    
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'type',
    ];

    protected $casts = [
        'type' => CategoryType::class,
    ];

    public static function nestedTree(array $types = []): Collection
    {
        $flat = static::query()
            ->when(!empty($types), fn($q) => $q->whereIn('type', $types))
            ->get();

        return self::buildNestedTree($flat);
    }

    protected static function buildNestedTree(Collection $flat, $parentId = null): Collection
    {
        return $flat
            ->filter(fn ($item) => $item->parent_id == $parentId)
            ->map(function ($item) use ($flat) {
                $item->children = self::buildNestedTree($flat, $item->id);
                return $item;
            });
    }

    protected static function booted()
    {
        static::deleting(function ($category) {
            $category->children()->each(function ($child) {
                $child->delete();
            });
        });
    }

    // parent() và children() đã được cung cấp bởi HasRecursiveRelationships trait

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

    public function scopePortfolio($query)
    {
        return $query->where('type', CategoryType::PORTFOLIO->value);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
    
    public function scopeArticle($query)
    {
        return $query->where('type', CategoryType::ARTICLE->value);
    }

    /**
     * Lấy tất cả ID của parent categories (ancestors)
     */
    public function getAncestorIds(): array
    {
        return $this->ancestors()->pluck('id')->toArray();
    }

    /**
     * Lấy tất cả ID của children categories (descendants)
     */
    public function getDescendantIds(): array
    {
        return $this->descendants()->pluck('id')->toArray();
    }

    /**
     * Lấy tất cả ID liên quan (ancestors + descendants + chính nó)
     */
    public function getAllRelatedIds(): array
    {
        return $this->bloodline()->pluck('id')->toArray();
    }
}
