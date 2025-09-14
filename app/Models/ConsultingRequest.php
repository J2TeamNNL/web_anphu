<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ConsultingRequestStatus;

class ConsultingRequest extends Model
{
    protected $guarded = [];

    protected $casts = [
        'status' => ConsultingRequestStatus::class,
    ];
    
}
