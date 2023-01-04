<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:250',
            'email' => 'required|unique:users|max:250',
            'password' => 'required|min:8'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatorio',
            'unique' => 'Já existe usuario com esse :attribute cadastrado',
            'max' => 'O tamanho maximo para o campo :attribute é 250 caracteres',
            'min' => 'O campo :attribute precisa no minimo de 4 caracteres'
        ];
    }
}
