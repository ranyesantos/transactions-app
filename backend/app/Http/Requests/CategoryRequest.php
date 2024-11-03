<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string|min:3|max:255|unique:categories,name',
            'id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'Por favor, insira um nome de categoria válido',
            'name.min' => 'A categoria deve ter pelo menos :min caracteres.',
            'name.max' => 'A categoria não pode ter mais de :max caracteres.',
            'name.unique' => 'Já existe uma categoria com esse nome.',
        ];
    }
}
