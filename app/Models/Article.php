<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'link',
        'description',
        'image',
        'type'
    ];

    public static function getTypes(): array
    {
        return [
            'construction' => 'Hoạt động công trình',
            'daily' => 'Đời sống An Phú',
            'event' => 'Tham quan sự kiện'
        ];
    }

    // ISOTOPE
    public function getStyleClass(): string
    {
        return 'type-' . $this->type;
    }
}