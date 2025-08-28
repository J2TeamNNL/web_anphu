<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanySettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_name' => 'required|string|max:255',
            'company_brand' => 'nullable|string|max:255',
            'international_name' => 'nullable|string|max:255',
            'director' => 'nullable|string|max:255',
            'company_logo' => 'nullable|image|max:2048',
            'company_email' => 'required|email',
            'company_phone_1' => 'required|string',
            'company_phone_2' => 'required|string',
            'company_address_1' => 'required|string',
            'company_address_2' => 'required|string',
            'working_hours' => 'nullable|string',
            'policy_content' => 'nullable|string',

            // Social links input (form field)
            'facebook_link'  => 'nullable|url',
            'youtube_link'   => 'nullable|url',
            'tiktok_link'    => 'nullable|url',
            'instagram_link' => 'nullable|url',

            // Google map input (form field)
            'google_map' => 'nullable|array',
            'google_map.map_1.embed_url' => 'nullable|url',
            'google_map.map_2.embed_url' => 'nullable|url',

            'established_date' => ['nullable','date','before_or_equal:today'],
            'tax_code'         => ['nullable','regex:/^\d{10}(\d{3})?$/'],

            'certificates'   => 'nullable|array|max:6',
            'certificates.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }
}