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

    public $timestamps = false;
    
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
        $flat = static::tree()
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

    public function portfolios()
    {
        return $this->morphedByMany(Portfolio::class, 'categorizable');
    }

    public function articles()
    {
        return $this->morphedByMany(Article::class, 'categorizable');
    }
    
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
