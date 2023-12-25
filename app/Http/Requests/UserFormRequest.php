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
            return $this->onPut();
        }

        if ($action === 'store') {
            return $this->onPost();
        }

        return $this->onGet();
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'name.min' => 'O nome deve ter 3 caracteres no minímo',
            'name.max' => 'O nome deve ter 30 caracteres no máximo',
            'email.unique' => 'O Email já existe',
            'email.min' => 'O Email deve ter 5 caracteres',
            'email.max' => 'O Email deve ter 60 caracteres',
            'password.min' => 'A senha deve ter 4 caracteres',
            'password.max' => 'A senha deve ter 20 caracteres'
        ];
    }

    private function onPost(): array
    {
        return [
            'name' => 'required|min:3|max:30',
            'email' => 'required|min:5|max:60|' . Rule::unique('users', 'email'),
            'password' => 'required|min:4|max:30'
        ];
    }

    private function onPut(): array
    {
        return [
            'name' => 'required|min:3|max:30',
            'email' => 'required|min:5|max:60|' . Rule::unique('users', 'email')->ignore($this->id),
            'password' => 'required|min:4|max:30'
        ];
    }

    private function onGet(): array
    {
        return [
            'name' => 'nullable',
            'email' => 'nullable',
            'password' => 'nullable'
        ];
    }
}
