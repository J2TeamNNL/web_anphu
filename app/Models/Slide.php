<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Slide extends Model
{
    public $timestamps = false;
    protected $fillable = [];

    public function media(): MorphOne
    {
        return $this->morphOne(Media::class, 'mediaable');
    }
}