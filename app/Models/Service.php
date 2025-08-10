<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'slogan',
        'slug',
        'image',
        'description',
        'image_public_id',
        'content_service',
        'content_price',

        'title_1',
        'icon_1',
        'icon_1_public_id',
        'content_1',

        'title_2',
        'icon_2',
        'icon_2_public_id',
        'content_2',

        'title_3',
        'icon_3',
        'icon_3_public_id',
        'content_3',
        
        'title_4',
        'icon_4',
        'icon_4_public_id',
        'content_4',
    ];

    public function media()
    {
        return $this->morphMany(Media::class, 'mediaable');
    }
}