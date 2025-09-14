<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{   
    protected $guarded = [];

    protected $casts = [
        'social_links' => 'json',
        'google_map' => 'json',
        'google_map_2' => 'json',
        'certificates' => 'json',
        'certificates_public_ids' => 'json',
        'license_date' => 'date',
    ];

}
