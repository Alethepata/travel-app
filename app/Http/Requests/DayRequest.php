<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DayRequest extends FormRequest
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
            'start_date' => ['required'],
            'ending_date' => ['required'],
        ];
    }
    public function messages(): array
    {
        return [
            'start_date.required' => 'Inserire la data',
            'ending_date.required' => 'Inserire la data',
        ];
    }
}
