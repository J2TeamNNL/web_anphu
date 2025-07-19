<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateArticleRequest extends FormRequest
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
        $articleId = $this->route('article');
        if (is_object($articleId)) {
            $articleId = $articleId->id;
        }

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('articles', 'name')->ignore($articleId),
            ],
            'link' => [
                'nullable',
                'string',
                'max:255',
            ],
            'image' => 'nullable|image',
            'description' => 'nullable|string',
            'type' => 'required|in:construction,daily,event',
        ];
    }
}
