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
            'villa' => 'Biệt thự',
            'town-house' => 'Nhà phố',
            'trading-house' => 'Nhà ở kết hợp kinh doanh',
        ];
    }

    public static function getCategories(): array
    {
        return [
            'villa' => [
                'modern' => 'Hiện đại',
                'neoclassic' => 'Tân cổ điển',
            ],
            'town-house' => [
                '2story' => 'Nhà 2 tầng',
                '3story' => 'Nhà 3 tầng',
                '4story' => 'Nhà 4 tầng',
                '5story' => 'Nhà 5 tầng',
                'singleStory' => 'Nhà cấp 4',
            ],
            'trading-house' => [
                'appartment' => 'Căn hộ - Chung cư',
                'office' => 'Văn phòng',
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

