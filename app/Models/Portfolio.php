<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'client',
        'description',
        'year',
        'type',
        'category',
        'image',
        'image1',
        'image2',
        'image3',
        'image4'
    ];

    public function getImageUrlAttribute()
    {
        return Storage::url('portfolio/' . $this->image);
    }

    public static function getTypes(): array
    {
        return [
            'interior' => 'Nội thất',
            'villa' => 'Biệt thự',
            'town' => 'Nhà phố',
            'commercial' => 'Nhà thương mại'
        ];
    }

    public static function getCategories(): array
    {
        return [
            'interior' => [
                'home' => 'Nội thất nhà ở',
                'office' => 'Nội thất văn phòng',
            ],
            'villa' => [
                'modern' => 'Hiện đại',
                'neoclassic' => 'Tân cổ điển',
            ],
            'town' => [
                '2story' => 'Nhà 2 tầng',
                '3story' => 'Nhà 3 tầng',
                '4to8story' => 'Nhà 4-8 tầng',
                '5story' => 'Nhà 5 tầng',
                'singleStory' => 'Nhà cấp 4',
            ],
            'commercial' => [
                'homestay' => 'Homestay',
                'appartment' => 'Chung cư',
            ],
        ];
    }

    public function getTypeName(): string
    {
        return self::getTypes()[$this->type] ?? ucfirst($this->type);
    }

    public function getCategoryName(): string
    {
        $categories = self::getCategories();

        return $categories[$this->type][$this->category] ?? ucfirst($this->category);
    }

    // ISOTOPE
    public function getStyleClass(): string
    {
        return "{$this->type} {$this->category}";
    }
}

