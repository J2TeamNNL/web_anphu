<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomPage extends Model
{

    protected $fillable = [
        'name',
        'slug',
        'title_1', 'title_2', 'title_3', 'title_4',
        'image_1', 'image_1_public_id',
        'image_2', 'image_2_public_id',
        'image_3', 'image_3_public_id',
        'image_4', 'image_4_public_id',
        'custom_content_1',
        'custom_content_2',
        'custom_content_3',
        'custom_content_4',
    ];
}