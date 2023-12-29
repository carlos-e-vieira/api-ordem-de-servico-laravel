<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderOfServiceFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $action = $this->route()->getActionMethod();

        if ($action === 'update' || $action === 'store') {
            return [
                'customer_id' => 'required|', Rule::exists('customers', 'id'),
                'service_id' => 'required|', Rule::exists('services', 'id'),
                'status' => 'required',
            ];
        }

        return $this->onGet();
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'customer_id.exists' => 'O cliente selecionado não existe na base de dados',
            'service_id.exists' => 'O serviço selecionado não existe na base de dados',
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
