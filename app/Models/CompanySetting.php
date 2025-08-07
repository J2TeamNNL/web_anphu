<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanySetting extends Model
{   
    use HasFactory;

    protected $fillable = [
        'company_name',
        'company_logo',
        'company_email',
        'company_phone_1',
        'company_phone_2',
        'company_address_1',
        'company_address_2',
        'pocily',
        'social_links',
        'working_hours',
        'policy_content',
        'google_map',
    ];
}
