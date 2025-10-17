<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJiriRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'description' => 'max:255|nullable',
            'date' => 'date_format:Y-m-d H:i:s',
            'contacts' => 'array|nullable',
            'roles' => 'nullable|array',
            'projects' => 'nullable|array'
        ];
    }
}
