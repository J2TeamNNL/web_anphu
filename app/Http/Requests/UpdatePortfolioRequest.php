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
            'location' => ['nullable', 'string'],
            'client' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'area' => 'nullable|string|max:255',
            'story' => 'nullable|string|max:255',
            'type' => 'nullable',
            'category_id' => ['required', 'exists:categories,id'],
            'year' => ['nullable', 'integer'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:5120'],
            'content' => 'nullable|string',
        ];
    }
}
