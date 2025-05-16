<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservaRequest extends FormRequest
{
    public function rules()
    {
        return [
            'rname' => 'required|string|max:255',
            'rphone' => 'required|regex:/^9\d{8}$/',
            'rdate' => 'required|date|after:today',
            'rtime' => 'required',
            'rparty-size' => 'required|integer|min:1|max:250',
            'payment_method_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'rphone.regex' => 'El teléfono debe tener 9 dígitos y comenzar con 9'
        ];
    }
}