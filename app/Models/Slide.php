<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Slide extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    
    protected $casts = [
        'is_mobile' => 'boolean',
    ];

    public function media(): MorphOne
    {
        return $this->morphOne(Media::class, 'mediaable');
    }
    
    public function getTypeAttribute()
    {
        return $this->is_mobile ? 'Mobile' : 'Desktop';
    }

    public function scopeDesktop($query)
    {
        return $query->where('is_mobile', false);
    }

    public function scopeMobile($query)
    {
        return $query->where('is_mobile', true);
    }
}