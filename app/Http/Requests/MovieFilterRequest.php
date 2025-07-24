<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieFilterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'sometimes|string|max:255',
            'year' => 'sometimes|integer|digits:4|min:1800|max:' . date('Y'),
            'director' => 'sometimes|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'year.digits' => 'O ano deve conter 4 dígitos.',
            'year.integer' => 'O ano deve ser um número inteiro.',
            'year.min' => 'O ano mínimo válido é 1800.',
            'year.max' => 'O ano máximo válido é o ano atual.',
        ];
    }
}
