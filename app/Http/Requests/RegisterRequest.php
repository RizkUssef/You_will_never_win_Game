<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "name"=>"required|string",
            "email"=>"required|email|unique:users,email",
            "password"=>"required|confirmed|min:10",
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "The name is required.",
            'email.required' => 'The email is required.',
            'email.unique' => 'You used this email before',
            'password.required' => 'The password is required.',
            'password.confirmed' => 'Have you forgotten your password already ???!!',
            'password.min' => 'The password must greater than 10 char',
        ];
    }
}
