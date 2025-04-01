<?php

namespace App\Http\Requests;

use App\Enums\TransactionType;
use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
    * Convert type string to TransactionType enum after validation.
    */
    public function validated($key = null, $default = null)
    {
        $validated = parent::validated();

        if (isset($validated['type'])) {
            $validated['type'] = TransactionType::from($validated['type']);
        }

        return $key ? ($validated[$key] ?? $default) : $validated;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'description' => 'required|string|max:255|min:3',
            'category_id' => 'exists:categories,id|nullable',
            'amount' => 'required|numeric',
            'type' => 'required|in:income,expense',
            'date' => 'string|required',
        ];
    }

    public function messages(): array
    {
        return [
            'amount.required' => 'O campo valor é obrigatório.',
            'amount.numeric' => 'O campo valor deve ser numérico.',

            'type.required' => 'O campo tipo é obrigatório.',
            'type.in' => 'O campo tipo deve ser "receita" ou "despesa".',

            'category_id.exists' => 'A categoria selecionada é inválida.',

            'description.required' => 'O campo descrição é obrigatório.',
            'description.string' => 'O campo descrição deve ser uma string.',
            'description.max' => 'O campo descrição não pode exceder :max caracteres.',
            'description.min' => 'O campo descrição não pode ter menos que :min caracteres.',

            'date.string' => 'O campo data deve ser uma string.',
            'date.required' => 'O campo data é obrigatório.',
            ];
    }

}
