<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomPageRequest extends FormRequest
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
            'name' => [
                'nullable',
                'string',
                Rule::unique('custom_pages', 'name')->ignore($this->route('custom_page')),
            ],
            'slug' => [
                'nullable',
                'string',
                Rule::unique('custom_pages', 'slug')->ignore($this->route('custom_page')),
            ],
            'title_1' => 'nullable|string|max:255',
            'title_2' => 'nullable|string|max:255',
            'title_3' => 'nullable|string|max:255',
            'title_4' => 'nullable|string|max:255',

            'image_1' => 'nullable|image|max:5120',
            'image_2' => 'nullable|image|max:5120',
            'image_3' => 'nullable|image|max:5120',
            'image_4' => 'nullable|image|max:5120',

            'custom_content_1' => 'nullable|string',
            'custom_content_2' => 'nullable|string',
            'custom_content_3' => 'nullable|string',
            'custom_content_4' => 'nullable|string',
        ];
    }
}
