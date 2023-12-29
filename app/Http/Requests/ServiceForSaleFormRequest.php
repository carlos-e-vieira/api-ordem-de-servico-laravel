<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServiceForSaleFormRequest extends FormRequest
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
            'title.min' => 'O título deve ter 3 caracteres no minímo',
            'title.max' => 'O título deve ter 50 caracteres no máximo',
            'title.unique' => 'O serviço já existe',
            'price.min' => 'O preço deve ter 2 caracteres',
            'price.max' => 'O preço deve ter 10 caracteres',
        ];
    }

    public function commonRules(): array
    {
        return [
            'price' => 'required|min:3|max:30',
        ];
    }

    private function onPost(): array
    {
        return [
            'title' => 'required|string|min:3|max:50|' . Rule::unique('services_for_sale', 'title'),
        ];
    }

    private function onPut(): array
    {
        return [
            'title' => 'required|string|min:3|max:50|', Rule::unique('services_for_sale', 'title')->ignore($this->id),
        ];
    }

    private function onGet(): array
    {
        return [
            'title' => 'nullable',
            'price' => 'nullable',
        ];
    }
}
