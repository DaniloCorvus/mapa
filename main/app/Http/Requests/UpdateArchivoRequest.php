<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArchivoRequest extends FormRequest
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
        if (request()->hasFile('pdf')) {
            return [
                'title' => 'required|max:255',
                'pdf' => 'mimes:pdf|max:10000',
            ];
        }
        return [
            'title' => 'required|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'pdf.mimes' => 'Debes elegir un archivo .PDF!',
            'pdf.max' => 'Archivo demasiado grande',
            'title.required' => 'El titulo es requerido !'
        ];
    }
}
