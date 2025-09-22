<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Slide extends Model
{
    public $timestamps = false;
    protected $fillable = [];

    /**
     * Get all media for this slide
     */
    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediaable')
                    ->orderBy('order');
    }
}