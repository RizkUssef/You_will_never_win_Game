<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class AnswerRequest extends FormRequest
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
            "answer"=>"required"
        ];
    }

    public function messages()
    {
        return [
            'answer.required' => 'ما تنطق يا بنى ؟',
        ];
    }

    // protected function failedValidation(Validator $validator)
    // {
    //     $errors = $validator->errors();
    //     $response = response()->json([
    //         'error' => $errors->messages(),
    //     ], 422);
    //     throw new HttpResponseException($response);
    // }
}
