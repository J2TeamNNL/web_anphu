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
        'slug',
        'location',
        'client',
        'description',
        'year',        
        'image',
        'category_id',
        'portfolio_type_id',
    ];

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }
}

