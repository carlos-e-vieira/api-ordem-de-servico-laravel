<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerFormRequest extends FormRequest
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
            'name.min' => 'O Nome deve ter 3 caracteres no minímo',
            'name.max' => 'O Nome deve ter 50 caracteres no máximo',
            'document_number.unique' => 'O Documento já existe',
            'document_number.min' => 'O Documento deve ter no mínimo 11 caracteres',
            'document_number.max' => 'O Documento deve ter no máximo 14 caracteres',
            'email.unique' => 'O Email já existe',
            'email.min' => 'O Email deve ter 5 caracteres',
            'email.max' => 'O Email deve ter 60 caracteres',
            'phone.min' => 'O Telefone deve ter 11 números',
            'phone.max' => 'O Telefone deve ter 11 números',
            'company_name.min' => 'O Nome da Empresa deve ter 3 caracteres no minímo',
            'company_name.max' => 'O Nome da Empresa deve ter 50 caracteres no máximo',
        ];
    }

    public function commonRules(): array
    {
        return [
            'name' => 'required|string|min:3|max:50',
            'document_type' => 'required|in:cpf,cnpj',
            'phone' => 'required|integer|digits:11',
            'company_name' => 'required|string|min:3|max:50',
        ];
    }

    private function onPost(): array
    {
        return [
            'document_number' => 'required|string|min:11|max:14|' . Rule::unique('customers', 'document_number'),
            'email' => 'required|string|email|min:8|max:100|' . Rule::unique('customers', 'email'),
        ];
    }

    private function onPut(): array
    {
        return [
            'document_number' => 'required|string|min:11|max:14|', Rule::unique('customers', 'document_number')->ignore($this->id),
            'email' => 'required|string|email|min:8|max:100|', Rule::unique('customers', 'email')->ignore($this->id),
        ];
    }

    private function onGet(): array
    {
        return [
            'name' => 'nullable',
            'document_type' => 'nullable',
            'document_number' => 'nullable',
            'email' => 'nullable',
            'phone' => 'nullable',
            'company_name' => 'nullable',
        ];
    }
}
