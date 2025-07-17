<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

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
    ];

    public static function nestedTree(): Collection
    {
        // Lấy toàn bộ tree dạng phẳng, đã sắp xếp đúng thứ tự
        $flat = static::tree()->get(); // LaravelAdjacencyList

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
}
