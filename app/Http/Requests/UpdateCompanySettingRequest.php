<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanySettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'company_name' => 'required|string|max:255',
            'company_logo' => 'nullable|image|max:2048',
            'company_email' => 'required|email',
            'company_phone_1' => 'required|string',
            'company_phone_2' => 'required|string',
            'company_address_1' => 'required|string',
            'company_address_2' => 'required|string',
            'policy' => 'nullable|string',
            'social_links' => 'nullable|string',
            'working_hours' => 'nullable|string',
        ];
    }
}
