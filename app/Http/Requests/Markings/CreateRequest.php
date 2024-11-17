<?php

namespace App\Http\Requests\Markings;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'animal' => 'array',
            'animal.name' => 'string|required',
            'animal.age' => 'integer|required',
            'animal.animal_type' => 'array',
            'animal.animal_type.id' => 'integer|required',
            'animal.tutor' => 'array',
            'animal.tutor.name' => 'string|required',
            'animal.tutor.email' => 'string|required',
            'symptoms' => 'string|required',
            'date' => 'date|required',
            'hour' => 'string|required',
        ];
    }
}
