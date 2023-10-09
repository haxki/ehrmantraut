<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'phone' => 'required|regex:/\+[37]\d{9,10}/u',
            'birthdate' => 'required',
            'gender' => 'required',
            'age' => 'required',
            'email' => 'required|email',
            'message' => 'required',	
        ];
    }
}
