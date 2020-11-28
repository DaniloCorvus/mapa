<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OtroRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'file' => 'required|max:10000',
        ];
    }

    public function messages(): array
    {
        return [
            'file.mimes' => 'Debes elegir un archivo .PDF!',
            'file.max' => 'Archivo demasiado grande',
            'title.required' => 'El titulo es requerido !'
        ];
    }
}
