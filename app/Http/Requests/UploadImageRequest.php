<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UploadImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'image' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif,webp',
                'max:5120', // 5MB
                'dimensions:max_width=4000,max_height=4000'
            ],
            
            'table' => [
                'sometimes',
                'string',
                'in:articles,portfolios,partners'
            ],

            'file' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,webp',
                'max:5120',
                'dimensions:max_width=4000,max_height=4000'
            ],
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'image.required' => 'Vui lòng chọn ảnh để tải lên.',
            'image.image' => 'File phải là định dạng ảnh.',
            'image.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif, webp.',
            'image.max' => 'Kích thước ảnh không được vượt quá 5MB.',
            'image.dimensions' => 'Kích thước ảnh không được vượt quá 4000x4000 pixels.',
            'table.in' => 'Loại bảng không hợp lệ.'
        ];
    }
}
