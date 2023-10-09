<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestRequest extends FormRequest
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
            'fio' => 'required|regex:/(\w{1,}\s){2}\w{1,}/u',
            'group' => 'required',
            'question1' => 'required',
            'question2' => 'required',
            'question3' => 'required|regex:/(\w{1,}[\s.,]{1,}){35}/u',
        ];
    }
    
}
