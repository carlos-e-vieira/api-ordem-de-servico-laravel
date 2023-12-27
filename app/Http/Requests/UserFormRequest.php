<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $action = $this->route()->getActionMethod();

        if ($action === 'update') {
            return array_merge($this->commonRules(), $this->onPut());
        }

        if ($action === 'store') {
            return array_merge($this->commonRules(), $this->onPost());
        }

        return $this->onGet();
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'name.min' => 'O nome deve ter 3 caracteres no minímo',
            'name.max' => 'O nome deve ter 50 caracteres no máximo',
            'email.unique' => 'O Email já existe',
            'email.min' => 'O Email deve ter 5 caracteres',
            'email.max' => 'O Email deve ter 60 caracteres',
            'password.min' => 'A senha deve ter 4 caracteres',
            'password.max' => 'A senha deve ter 20 caracteres'
        ];
    }

    public function commonRules(): array
    {
        return [
            'name' => 'required|string|min:3|max:50',
            'password' => 'required|string|min:4|max:30',
        ];
    }

    private function onPost(): array
    {
        return [
            'email' => 'required|string|email|min:8|max:100|' . Rule::unique('users', 'email'),
        ];
    }

    private function onPut(): array
    {
        return [
            'email' => 'required|string|email|min:8|max:100|', Rule::unique('users', 'email')->ignore($this->id),
        ];
    }

    private function onGet(): array
    {
        return [
            'name' => 'nullable',
            'email' => 'nullable',
            'password' => 'nullable',
        ];
    }
}
