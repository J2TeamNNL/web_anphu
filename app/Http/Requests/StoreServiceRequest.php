<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
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
            'name'=> 'required|string|max:255',
            'slogan'=> 'nullable|string|max:255',
            'slug'=> 'nullable|string|unique:services,slug',
            'image'=> 'nullable|file|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'description'=> 'nullable|string',
            'image_public_id'=> 'nullable|string',

            'content_service'=> 'nullable|string',
            'content_price'=> 'nullable|string',

            'title_1' => 'nullable|string|max:255',
            'icon_1' => 'nullable|file|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'icon_1_public_id' => 'nullable|string',
            'content_1' => 'nullable|string',

            'title_2' => 'nullable|string|max:255',
            'icon_2' => 'nullable|file|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'icon_2_public_id' => 'nullable|string',
            'content_2' => 'nullable|string',

            'title_3' => 'nullable|string|max:255',
            'icon_3' => 'nullable|file|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'icon_3_public_id' => 'nullable|string',
            'content_3' => 'nullable|string',

            'title_4' => 'nullable|string|max:255',
            'icon_4' => 'nullable|file|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'icon_4_public_id' => 'nullable|string',
            'content_4' => 'nullable|string',
        ];
    }
}
