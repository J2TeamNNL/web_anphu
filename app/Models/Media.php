<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'url',
        'public_id',
        'file_path',
        'type',
        'caption',
        'order',
        'mediable_id',
        'mediable_type'
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    public function mediable()
    {
        return $this->morphTo();
    }
}
