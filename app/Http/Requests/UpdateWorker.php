<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWorker extends FormRequest
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
            'fish' => 'required|string|max:255',
            'phone1' => 'required|numeric',
            't_sana' => 'required|date',
            'role' => 'required|integer',
            'email' => 'required|email'
        ];
    }

    public function messages()
    {
        return [
            'fish.required' => 'F.I.SH kiritilishi shart!',
            'fish.string' => 'F.I.SH so\'z shaklida bo\'lishi kerak!',
            'fish.max' => 'F.I.SH so\'zni 255 belgidan kam bo\'lishi kerak!',
            'phone1.required' => 'Telefon raqamini kiritilish shart!',
            'phone1.numeric' => 'Telefon raqami raqam shaklida bo\'lishi kerak!',
            'phone1.max' => 'Telefon raqami 20 belgidan kam bo\'lishi kerak!',
            't_sana.required' => 'Tug\'ilgan sana kiritilishi shart!',
            't_sana.date' => 'Tug\'ilgan sana kun sanasi shaklida bo\'lishi kerak!',
            'role.required' => 'Lavozimni tanlang!',
            'email.required' => "Email kiritilishi shart!",
        ];
    }
}
