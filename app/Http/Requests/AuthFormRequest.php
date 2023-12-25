<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Esse campo de email é obrigatório',
            'email.email' => 'Esse campo tem que ter um email válido',
            'password.required' => 'Esse campo é obrigatório'
        ];
    }
}
