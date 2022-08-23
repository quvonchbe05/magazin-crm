<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Login extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email|max:255|exists:workers,email',
            'password' => 'required|min:8',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Emailni kiritish majburiy!',
            'email.max' => 'Email 255ta belgidan kamroq bo\'lishi kerak!',
            'email.exists' => 'Email topilmadi!',
            'password.required' => 'Parolni kiritish shart!',
            'password.min' => 'Parol kamida 8ta belgidan iborat bo\'lishi kerak!',
        ];
    }
}
