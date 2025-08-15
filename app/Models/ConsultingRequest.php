<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ConsultingRequestStatus;

class ConsultingRequest extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'location',
        'note',
        'status',
    ];

    protected $casts = [
        'status' => ConsultingRequestStatus::class,
    ];
    
}
