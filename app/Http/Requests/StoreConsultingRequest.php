<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreConsultingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone' => [
                'nullable',
                'string',
                'max:20',
                Rule::requiredIf(function () {
                    return $this->email === null;
                })
            ],
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::requiredIf(function () {
                    return $this->phone === null;
                })
            ]
        ];
    }
}
