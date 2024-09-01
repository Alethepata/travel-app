<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StageRequest extends FormRequest
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

            'title' => ['required', 'max: 50'],
            'place' => ['required']
        ];

        if($_POST['_method'] == 'POST'){

            return [

                'date' => ['required'],
                'time' => ['required']
            ];

        }else if($_POST['_method'] == 'PUT'){
            return [
                'description' => ['max:600'],
                'rating' => ['number','min:0', 'max: 5'],
            ];

        }
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Inserire il titolo',
            'title.max' => 'Inserire massimo :max caratteri',
            'date.required' => 'Inserire la data',
            'place.required' => 'Inserire il luogo',
            'time.required' => 'Inserire l\'orario',
            'description.max' => 'Inserire massimo :max caratteri',
            'rating.number' => 'Inserire un numero',
            'rating.min' => 'Valore minimo di :max ',
            'rating.max' => 'Valore massimo di :max ',
        ];
    }
}
