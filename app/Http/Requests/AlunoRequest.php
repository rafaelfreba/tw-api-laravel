<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlunoRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nome' => ['required','string','between:2,100'],
            'nascimento' => ['required', 'date'],
            'genero' => ['required', 'size:1'],
            'turma_id' => ['required', 'int', 'exists:turmas,id']
        ];
    }

    public function attributes()
    {
        return [
            'nome' => 'NOME',
            'nascimento' => 'DATA DE NASCIMENTO',
            'genero' => 'GÊNERO',
            'turma_id' => 'TURMA'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'between' => 'O campo :attribute deve possuir de 2 até 100 caracteres.',
            'date' => 'O campo :attribute não é uma data válida.',
            'size' => 'O campo :attribute aceita apenas 1 caracter.'            
        ];
    }
}
