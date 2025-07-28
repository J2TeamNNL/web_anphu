<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\CategoryType;

class UpdatePortfolioRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'location' => ['required', 'string'],
            'client' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'type' => 'nullable',
            'category_id' => ['required', 'exists:categories,id'],
            'year' => ['nullable', 'integer'],
            'image_new' => ['nullable', 'image'],
            'content' => 'nullable|string',
        ];
    }
}
