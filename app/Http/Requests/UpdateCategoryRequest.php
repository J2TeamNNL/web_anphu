<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\CategoryType;

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
            'name' => 'required|string|max:255',
            'type' => ['required', Rule::in(CategoryType::values())],
            'parent_id' => [
                'nullable',
                'exists:categories,id',

                function ($attribute, $value, $fail) {
                    if ($value == $this->route('category')->id) {
                        $fail('Danh mục không được làm cha của chính nó.');
                    }
                },
            ],
        ];
    }
}
