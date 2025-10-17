<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:8',
            'email' => 'email|unique:contacts|required',
            'jiris' => 'array|nullable',
            'roles' => 'array|nullable',
            'avatar' => 'mimes:jpg|nullable'
        ];
    }
}
