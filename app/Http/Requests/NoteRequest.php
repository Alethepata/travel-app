<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
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
            'note' =>['required', 'max:255']
        ];
    }

    public function messages(): array
    {
        return [
            'note.required' => 'Inserire la nota',
            'note.max' => 'Inserire massimo :max caratteri',
        ];
    }
}
