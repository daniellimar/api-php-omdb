<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieShowRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => [
                'required',
                'integer',
                'min:1',
                'exists:movies,id',
            ],
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'O ID do filme é obrigatório.',
            'id.integer' => 'O ID do filme deve ser um número inteiro.',
            'id.min' => 'O ID do filme deve ser um número positivo.',
            'id.exists' => 'O ID do filme informado não existe.',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('id'),
        ]);
    }
}
