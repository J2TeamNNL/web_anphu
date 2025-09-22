<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'file_path',
        'url',
        'public_id',
        'type',
        'caption',
        'order',
        'mediaable_id',
        'mediaable_type',
    ];
    protected $casts = [
        'order' => 'integer',
    ];

    public function mediaable()
    {
        return $this->morphTo();
    }
}
