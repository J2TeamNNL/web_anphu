<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class CompanySetting extends Model
{   
    use HasFactory;

    protected $fillable = [
        'company_name',
        'international_name',

        'director',
        'company_logo',
        'director',
        'company_email',
        'company_phone_1',
        'company_phone_2',
        'company_address_1',
        'company_address_2',
        'social_links',
        'working_hours',
        'policy_content',
        'google_map',

        'established_date',
        'tax_code',
    ];

    protected function establishedDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? Carbon::parse($value)->format('d/m/Y') : null,
            set: fn ($value) => $value 
                ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') 
                : null
        );
    }
}
