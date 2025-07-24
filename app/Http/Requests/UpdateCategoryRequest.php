<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\CategoryType;
use Illuminate\Validation\Rules\Enum;

class UpdateCategoryRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', new Enum(CategoryType::class)],
            'parent_id' => ['nullable', 'exists:categories,id'],
        ];
    }
}
