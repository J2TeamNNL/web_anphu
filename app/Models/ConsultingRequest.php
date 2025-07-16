<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultingRequest extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'location',
        'status',
    ];
}
