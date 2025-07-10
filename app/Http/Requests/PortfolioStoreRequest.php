<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PortfolioStoreRequest extends FormRequest
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
            'name' => 'string',
            'location' => 'string',
            'client' => 'string',
            'image' => [
                'mimes:jpg,png,jpeg',
            ],
            'description' => 'string',           
            'year' => [
                'numeric',
            ],
            'style' => 'numeric',
        ];
    }
}
